<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class VerifyIfCandidate
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
        $candidateUser = Session::get('userEmail');
        // || !isset($employerUser) 
        if (!isset($candidateUser)) {
            // echo 'varify candidate';
            // exit;
            return redirect()->route('homepage');
            // return route('signin.index');
           
        }
        // else{
        //     // return response(redirect(url('/'));   
        //     return response()->view('homepage');
        // }
        return $next($request);
    }
}
