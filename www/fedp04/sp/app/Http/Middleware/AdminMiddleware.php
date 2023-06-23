<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->is_admin == '1')
            {
                return $next($request);
            }
            else
            {
                return redirect('/home')->with('status','Access Denied! as you are not an admin');
            }
        }
        else
        {
            return redirect('/home')->with('status','Please Login First');
        }
    }
}
