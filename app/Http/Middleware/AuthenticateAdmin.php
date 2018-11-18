<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 17/11/2018
 * Time: 16:08
 */

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('admin.login');
        }

        if(!Auth::user()->isAdmin()){
            return redirect()->route('index');
        }

        return $next($request);
    }
}
