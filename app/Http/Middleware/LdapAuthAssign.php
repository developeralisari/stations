<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LdapAuthAssign
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        // Ldap Login Catch To Session Assign
        if ((!Session::get('ldap_logged') || Session::get('ldap_logged') != true) && Cookie::get('ldap_token')) {
            $jwt = Cookie::get('ldap_token');

            if (isset($jwt) && $jwt != null) {
                $secretKey = env('JWT_SECRET');

                try {
                    $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));
                    $userData = json_decode($decoded->user_data);
                    $userData->profile_img = $decoded->profile_img;

                    Session::put('ldap_logged', true);
                    Session::put('ldap_user', $userData);
                } catch (\Exception $e) {
                    // JWT süresi dolmuş veya geçerli değil
                    // Burada yapılacak işlemi belirleyin, örneğin kullanıcıyı oturumdan çıkartabilirsiniz.
                    // Örneğin:
                    Session::flush(); // Oturumu temizle
                    // Diğer işlemler...
                }
            }
        }
        // Ldap Login Catch To Session Assign

        return $next($request);
    }
}
