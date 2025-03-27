<?php

namespace App\Http\Middleware;

use Closure;

class redirection
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
      if($request->session()->has('user_name')){
        return redirect('dashboard');
      }
        return $next($request);
    }
}
