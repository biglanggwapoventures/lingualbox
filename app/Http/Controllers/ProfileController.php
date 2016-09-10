<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Auth;
use DB;

use App\WrittenExamResult;
class ProfileController extends Controller
{
    function showProfile()
    {

        $user = Auth::user();

        if($user->isAdmin()){
            return view('blocks.admin-dashboard');
        }else if($user->isHR()){
             return view('blocks.hr-dashboard');
        }

        $profileProgress = 20;
        $profile = [
            'experiences' => [
                'done' => $user->experiences()->exists(),
                'percent' => 20
            ],
            'requirements' => [
                'done' => $user->preference()->exists(),
                'percent' => 10
            ],
        ];

        $readingExamStatus = 'W';
        $hasTakenReadingExam = $user->readingExamResult()->exists();
        if($hasTakenReadingExam){
            $readingExamStatus = $user->latestReadingExamResult()->didPassed() ? 'P' : 'F';
        }
        $profile['reading']['done'] = $readingExamStatus !== 'W';
        $profile['reading']['status'] = $readingExamStatus;
        $profile['reading']['percent'] = 20;

        $writtenExamStatus = '';
        $hasTakenWrittenExam = $user->writtenExamResult()->exists();
        if($hasTakenWrittenExam){
            if($user->latestWrittenExamResult()->isPending()){
                $writtenExamStatus = 'W';
            }else{
                $writtenExamStatus = $user->latestWrittenExamResult()->didPassed() ? 'P' : 'F';
            }
            
        }
        $profile['written']['done'] = $writtenExamStatus !== '';
        $profile['written']['status'] = $writtenExamStatus;
        $profile['written']['percent'] = 10;

        foreach($profile AS $row){
            if($row['done']){
                $profileProgress += $row['percent'];
            }
        }

        return view('blocks.application-progress', compact(['profileProgress', 'profile']));
    }

    function checkWrittenExams(Request $request)
    {
        $input = $request->input('schedule');
        $schedules = ['MORNING', 'AFTERNOON', 'EVENING', 'MIDNIGHT'];
        $session = in_array($input, $schedules) ? $input : $schedules[0];

        $items = DB::table('written_exam_results AS w')
            ->select(DB::raw('w.id, CONCAT(u.firstname, " ", u.lastname) AS applicant, MAX(w.datetime_started) AS date, u.gender, up.demo_day, up.demo_time'))
            ->join('users AS u', 'u.id', '=', 'w.user_id')
            ->join('user_preferences AS up', 'up.user_id', '=', 'u.id')
            ->where([
                ['up.work_schedule', '=', $session]
            ])
            ->whereNull('w.result')
            ->groupBy('w.user_id')
            ->get();

        return view('blocks.check-written-exams', compact('items'));
    }

    function reviewWrittenExam($id)
    {
        $exam = WrittenExamResult::findOrFail($id);
         return view('blocks.view-written-exam-answer', compact('exam'));
    }
}
