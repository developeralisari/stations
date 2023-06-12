<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Admin
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
        if(session()->has('ldap_user'))
        {
            $mail = session()->get('ldap_user')->mail;
            $check = User::where("email",$mail)->count();
            if($check > 0)
            {
                return $next($request);
            }else{
                return "Yetkisiz Giriş";
            }
        }else{
            return "Giriş Yapınız";
        }
    }
}
