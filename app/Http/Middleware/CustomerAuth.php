<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
      if(Auth::check()) {
        if(Auth::user()->status <> 0){
          if (Auth::user()->user_type == 2) {
            return $next($request);
          } else {
            return redirect()->route('access-denied');
          }
        } else {
          Auth::logout();
          return redirect()->route('customer_login');
        }
        
      } else {
        return redirect()->route('customer_login');
      }
    }
}
