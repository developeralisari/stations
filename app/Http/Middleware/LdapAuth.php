<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cookie;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;

class LdapAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        //return $next($request);

        //$site = 'https://foods.memorial.com.tr/';
        $site = env('APP_ENV') == 'local' 
        ? 'http://localhost/KR_YazilimStations/public' 
        : 'https://stations.memorial.com.tr/';

        //dd(Cookie::get());

        if(!Session::get('ldap_logged') || Session::get('ldap_logged') != true || !Cookie::get('ldap_token')){
            if(!Cookie::get('ldap_token')){
                //return redirect()->away(env('AUTH_API_URL').'qr-app/public/login/'.base64_encode($site)) ;
                return redirect()->away(env('AUTH_API_URL').'/login/'.base64_encode($site)) ;
            }

            try{
                $jwt = Cookie::get('ldap_token');
                $secretKey = env('JWT_SECRET');
                $decoded = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

                Session::put('ldap_logged',true);
                $userData = json_decode($decoded->user_data);
                $userData->profile_img = $decoded->profile_img;

                Session::put('ldap_user',$userData);
                //$request->headers->set('location_id',2);
                return $next($request);
            } catch (ExpiredException $e) {
                //return redirect()->away(env('AUTH_API_URL').'qr-app/public/login/'.base64_encode($site)) ;
                return redirect()->away(env('AUTH_API_URL').'/login/'.base64_encode($site)) ;
    
            } catch (\Exception $e) {
                //return redirect()->away(env('AUTH_API_URL').'qr-app/public/login/'.base64_encode($site)) ;
                return redirect()->away(env('AUTH_API_URL').'/login/'.base64_encode($site)) ;
            }

        }else{
            return $next($request);
        }
        
    }
}
