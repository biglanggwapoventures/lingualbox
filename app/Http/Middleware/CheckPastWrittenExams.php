<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class CheckPastWrittenExams
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
        if(Auth::check()){

            $user = Auth::user();

            if($user->canTakeWrittenExam()){
                return $next($request);
            }

            return redirect()->route('profile');
            
        }

        return redirect()->route('home');
    }
}
