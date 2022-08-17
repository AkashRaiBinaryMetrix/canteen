<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
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
        $check=\Session::get('user');
        if ($check) 
        {      
            
        }
        else{
            // $request->session()->flash('error', 'Access Denied');
            // return back();

          return redirect()->route('logincheck');
        }
        return $next($request);
    }
}
