<?php

namespace App\Http\Controllers;

use App\Ldap\Account;
use App\Ldap\Guest;
use App\Models\CspHRJob;
use App\Models\Driver;
use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index(Request $r)
    {

        try {
            DB::beginTransaction();

            $user = session()->get('ldap_user');
            //dd($user);
            Personel::updateOrCreate(
                [
                    "sap_id" => $user->sap_id
                ],
                [
                    "sap_id" => $user->sap_id,
                    "name" => $user->full_name,
                    "email" => $user->mail,
                    "phone" => $user->phone,
                    "driver_id" => $r->driver_id
                ]
            );

            DB::commit();
            return redirect('/?check=ok')->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect('/?check=no')->withInput();
        }
    }
}
