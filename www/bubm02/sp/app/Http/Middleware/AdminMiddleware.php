<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == 'admin')
        {
            return $next($request)->with(['status'=>'Access Denied! as you are not as admin']);
        }
        else
        {
            return redirect('/home')->with('status','Access Denied! as you are not as admin');
        }
    }

}
