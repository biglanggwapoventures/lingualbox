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
            $past = ReadingResult::where('user_id', $user->id)->orderBy('datetime_started', 'DESC');

            if($past->exists()){

                $exam = $past->first();
                $story = Story::orderBy('created_at', 'DESC')->first();

                $now = Carbon::now('Asia/Manila');
                $pastExamDate = Carbon::createFromFormat('Y-m-d H:i:s', $exam->datetime_started, 'Asia/Manila');

                $allowance = $pastExamDate->copy()->addMinutes($story->limit);
                if($allowance->gt($now)){
                    return response()->json(['a' => $allowance]);
                    return $next($request);
                }

                $cooldown = $pastExamDate->copy()->addMonths(6);
                if($cooldown->lt($now)){
                    return $next($request);
                }   
                

                return redirect()->route('profile');
                
            }

            return $next($request);
        }
        
    }
}
