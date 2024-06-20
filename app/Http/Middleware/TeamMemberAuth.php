<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class TeamMemberAuth
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
      if (Auth::check()) {
        if (Auth::user()->user_type == 3) {
          return $next($request);
        } else {
          return redirect()->route('access-denied');
        }
      } else {
        return redirect()->route('teamMember_login');
      }
    }
}
