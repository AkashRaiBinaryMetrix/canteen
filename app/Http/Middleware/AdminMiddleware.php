<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Session;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $guards = [];
    public function handle($request, Closure $next, ...$guards)
    {
        $check=Session::get('admin');
        if ($check) 
        {      
            
        }
        else{
            $request->session()->flash('error', 'Access Denied');
            // return back();
          return redirect()->route('admin.login');
        }
        return $next($request);
        
    }
}
