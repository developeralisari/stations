<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Ldap\Account;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserInfo;
use App\Models\Role;
use App\Models\UserRole;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function index(Request $r)
    {
        if(Auth::check())
        {
            return redirect('admin');
        }
        return view("login")->with("request", $r->all());
    }

    public function create()
    {
        $new = new User;
        $new->name = "Ali SARI";
        $new->email = "ali.sari@memorial.com.tr";
        $new->password = Hash::make(1);
        $new->role_id = 1;
        $new->is_ldap = 0;
        $new->save();
    }

    public function login(Request $req)
    {


        $MatchOne = env('LDAP_MATCH_1');
        $MatchTwo = env('LDAP_MATCH_2');
        $MatchThree = env('LDAP_MATCH_3');


        $validator = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
            'security' => 'required|numeric'
        ], [
            'email.required' => 'Email adresi giriniz',
            'email.email' => 'Email formatı uygun değil',
            'password.required' => 'Şifre giriniz',
            'security.required' => 'Güvenlik sorusunu giriniz',
            'security.numeric' => 'Güvenlik sorusu bir toplama işlemidir, sayı olarak giriniz'
        ]);

        if (isset($req->security)) {
            $sessionKey = $req->session()->get('security');
            if ($sessionKey != $req->security) {
                $validator = [
                    'Güvenlik sorusunu kontrol ediniz.'
                ];
                return redirect()->back()->withErrors($validator)->withInput();
                //return "no";
            }
        }



        $IsAccount = User::where("email", $req->email)->count();

        if ($IsAccount == 0) {
            return view("noneuser");
        }

        $IsActive = User::where("email", $req->email)->where("status", 1)->count();

        if ($IsActive == 0) {
            return view("undefined");
        }

        $IsLdap = User::where('email', $req->email)->where("is_ldap", 1)->count();

        if ($IsLdap == 1) {
            if (strpos($req->email, $MatchOne) > -1) {
                $email = mb_convert_case($req->email, MB_CASE_LOWER, "UTF-8");
                $username = substr($email, 0, strrpos($email, '@'));
                $IsUser = Account::Memorial($username, $req->password);

                if ($IsUser == TRUE) {
                    $user = User::where('email', $email)->first();
                    Auth::login($user);
                    return redirect('/admin');
                } else {
                    return view("unauthorized");
                }
            }

            if (strpos($req->email, $MatchTwo) > -1) {
                $email = mb_convert_case($req->email, MB_CASE_LOWER, "UTF-8");
                $username = substr($email, 0, strrpos($email, '@'));
                $IsUser = Account::Hizmet($username, $req->password);

                if ($IsUser == TRUE) {
                    $user = User::where('email', $email)->first();
                    Auth::login($user);
                    return redirect('/admin');
                } else {
                    return view("unauthorized");
                }
            }
        } else {

            if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
                return redirect('/admin');
            } else {
                return view("unauthorized");
            }
        }
    }


    public function save(Request $req)
    {

        $validator = $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password'
        ], [
            'name.required' => 'Ad ve soyad giriniz',
            'email.required' => 'Email adresi giriniz',
            'email.email' => 'Email formatı uygun değil',
            'password.required' => 'Şifre giriniz',
            'password.confirmed' => 'Şifreler eşleşmedi',
            'password_confirmation.required' => 'Doğrulama şifresini giriniz',
            'password_confirmation.same' => 'Şifreleri eşleştiriniz',
        ]);


        $countEmail = User::where("email", $req->email)->count();

        if ($countEmail > 0) {
            return "no";
        }

        $data = $req->all();

        try {
            DB::beginTransaction();

            $new = new User;
            $new->fill($data);
            $new->password = Hash::make($req->password);
            $new->save();

            $newRole = new UserRole;
            $newRole->user_id = $new->id;
            $newRole->role_id = $req->role_id;
            $newRole->save();

            DB::commit();

            try {

                if (isset($req->is_ldap)) {
                    $password = "Bilgisayarınızın açılış şifresi";
                } else {
                    $password = $req->password;
                }

                $details = [
                    'password' => $password,
                    'email' => $req->email,
                    'fullname' => $req->name
                ];
                $result = Mail::to($req->email)->send(new UserInfo($details));
            } catch (Exception $e) {
                return $e->getMessage();
            }

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return "error";
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function users(Request $r)
    {
        $users = User::orderBy("name","asc");

        if(isset($r->name))
        {
            $users = $users->where("name","LIKE", "%" . $r->name . "%");
        }

        if(isset($r->role_id))
        {
            $users = $users->where("role_id",$r->role_id);
        }

        $users = $users->paginate(9);

        $roles = Role::all();
        return view("admin.users.index")->with(["users" => $users, "roles" => $roles, "r"=>$r]);
    }

    public function unauthorized()
    {
        return view("unauthorized");
    }

    public function noentry()
    {
        return view("noentry");
    }

    public function add()
    {
        $roles = Role::all();
        return view("admin.users.add")->with(["roles" => $roles]);
    }

    public function edit(Request $req)
    {
        $users = User::where("id", $req->id)->get();
        $roles = Role::all();
        return view("admin.users.edit")->with(["id" => $req->id, "users" => $users, "roles" => $roles]);
    }


    public function update($id, Request $req)
    {
        $validator = $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',
            'password_confirmation' => 'same:password'
        ], [
            'name.required' => 'Ad ve soyad giriniz',
            'email.required' => 'Email adresi giriniz',
            'email.email' => 'Email formatı uygun değil',
            'password.required' => 'Şifre giriniz',
            'password.confirmed' => 'Şifreler eşleşmedi',
            'password_confirmation.same' => 'Şifreleri eşleştiriniz',
        ]);

        try {
            DB::beginTransaction();

            $data = $req->all();
            $up = User::find($id);
            $up->fill($data);
            if (strlen($req->password) > 0) {
                $up->password = Hash::make($req->password);
            }
            $up->save();

            UserRole::where('user_id', $id)->update(['role_id' => $req->role_id]);

            DB::commit();
            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return "no";
        }
    }

    public function authenticate(Request $req)
    {
        
        $referrer = $req->headers->get('referer');
        
        if(env('APP_ENV') != 'local' && $referrer != env('AUTH_API_URL')) redirect()->away(env('AUTH_API_URL'));
        
        if($req->sap_id && $req->token){
            //Cookie::queue('ldap_token', $req->token,60 * 4);
            $host = env('APP_ENV') != 'local' ? '.memorial.com.tr' : 'localhost';
            setcookie("ldap_token", $req->token, time() + 31536000, '/', $host);
            return redirect('/');
        }
        redirect()->away(env('AUTH_API_URL'));
        
    }

    public function ldap_logout(Request $request){
        //Cookie::queue('ldap_token', null,60 * 4);
        $host = env('APP_ENV') != 'local' ? '.memorial.com.tr' : 'localhost';
        setcookie("ldap_token", null, time() - 31536000, '/', $host);
        $request->session()->flush();
        return redirect('/');
    }

}
