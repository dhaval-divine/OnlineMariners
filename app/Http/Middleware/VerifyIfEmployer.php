<?php

namespace App\Http\Middleware;
use Closure;
use Session;

class VerifyIfEmployer
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
        
        $employerUser = Session::get('employerEmail');
        // echo 'varify employer';
        //     exit;
        if (!isset($employerUser)) {
            
            return redirect()->route('homepage');
           
        }
        
        return $next($request);
    }
}
