<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Authenticate
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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                $open_id = Cookie::get('openid');
                if($open_id) {
                    $user = \DB::table('user')->where('openid', $open_id)->first();
                    if(empty($user)) {
                        return redirect()->guest('login');
                    }
                    return $next($request);
                } else {
                    
                }

            }
        }

        return $next($request);
    }
}
