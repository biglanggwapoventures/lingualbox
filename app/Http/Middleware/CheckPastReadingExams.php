<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\ReadingExamResult AS ReadingResult;
use App\ReadingStoryboard AS Story;
use Carbon\Carbon;

class CheckPastReadingExams
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

            if(!$user->isAccountVerified()){
                session()->flash('email_verification_notice', 'You need to verify you email address before you are able to take the reading exam.');
            }else if($user->canTakeReadingExam()){
                 return $next($request);
            }

            return redirect()->route('profile');
            
        }

        return redirect()->route('home');
        
    }
}
