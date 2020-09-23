<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class VerifyIfAdmin
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
        $employerUser = Session::get('employerEmail');

        if (!isset($candidateUser) || !isset($employerUser)) {
            if ($request->wantsJson()) {
                return response()->json(['Message', 'You do not access to this module.'], 403);
            }
            abort(403, 'You do not access to this module.');
        }
        // else if(!isset($employerUser)){
        //      if ($request->wantsJson()) {
        //         return response()->json(['Message', 'You do not access to this module.'], 403);
        //     }
        //     abort(403, 'You do not access to this module.');
        // }
        return $next($request);
    }
}
