<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use App\WrittenExamResult;

use Validator;


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
            'demo' => [
                'done' => $user->demoClass()->exists() && $user->demoClass->didPass(),
                'percent' => 20
            ],
        ];

        $readingExamStatus = 'W';
        $hasTakenReadingExam = $user->readingExamResult()->exists();
        if($hasTakenReadingExam){
            if($user->latestReadingExamResult()->didPassed()){
                $readingExamStatus = 'P';
            }else{
                $now = Carbon::now('Asia/Manila');
                $nextReadingExam = Carbon::createFromFormat('F d, Y', $user->nextReadingExam(), 'Asia/Manila');
                $readingExamStatus = $nextReadingExam > $now ? 'F' : 'W';
            }
            
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
                if($user->latestWrittenExamResult()->didPassed()){
                    $writtenExamStatus= 'P';
                }else{
                     $now = Carbon::now('Asia/Manila');
                    $nextWrittenExam = Carbon::createFromFormat('F d, Y', $user->nextWrittenExam(), 'Asia/Manila');
                    $writtenExamStatus = $nextWrittenExam > $now ? 'F' : '';
                }
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
        $session =  in_array($input, $schedules) ? $input : FALSE;

        $query = DB::table('written_exam_results AS w')
            ->select(DB::raw('w.id, CONCAT(u.firstname, " ", u.lastname) AS applicant, MAX(w.datetime_started) AS date, u.gender, up.demo_day, up.demo_time, up.work_schedule'))
            ->join('users AS u', 'u.id', '=', 'w.user_id')
            ->join('user_preferences AS up', 'up.user_id', '=', 'u.id');

        if($session){
            $query->where('up.work_schedule', $session);
        }
            
       $items = $query->whereNull('w.result')
            ->groupBy('w.user_id')
            ->get();

        return view('blocks.check-written-exams', compact('items', 'session'));
    }

    function reviewWrittenExam($id)
    {
        $exam = WrittenExamResult::findOrFail($id);
         return view('blocks.view-written-exam-answer', compact('exam'));
    }

    function checkWrittenExam($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'result' => 'required|in:PASSED,FAILED',
            'content' => 'required_if:mark,PASSED',
            'reason' => 'sometimes|array|required_if:mark,FAILED',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => FALSE,
                'errors' => $validator->errors()
            ]);
        }

        $input = $request->only(['result', 'content', 'reason']);
        
        $exam = WrittenExamResult::findOrFail($id);

        $exam->fill([
            'result' => $input['result'],
            'checked_by' => Auth::user()->id
        ]);

        if($input['result'] === 'PASSED'){
            $exam->user->prepareForDemoClass($input['content']);
        }else{
            $exam->user->setAsFailed();
            $exam->fail_reason = $input['reason'] ? array_diff($input['reason'], ['OTHERS']) : NULL;
        }

        $exam->save();

        return response()->json([
            'result' => TRUE,
            'next_url' => route('written.exam.list')
        ]);
        
    }

    function view($id)
    {
        $user = User::find($id);
        return view('blocks.view-profile', compact('user'));
    }

    
}
