<?php

namespace TransferenciaCripto\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if(auth()->guest()){
            return redirect('/');
        }
        if(!auth()->user()->admin){
            return redirect('/');
        }
        return $next($request);
    }
}
