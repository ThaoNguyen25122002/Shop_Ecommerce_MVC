<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(Auth::user()->level===0){
        //     return $next($request);
        // }
        // return redirect()->back();
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level == 1) {
                return redirect()->back();
            }
        }
        return $next($request);
    }
}
