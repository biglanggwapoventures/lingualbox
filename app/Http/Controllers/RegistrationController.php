<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Http\Requests;

use App\User;
use Auth;
use App\UserExperience AS Experience;
use App\UserPreference AS Preference;
use DB;

use App\ReadingExamResult AS ReadingResult;
use App\ReadingStoryboard AS Story;
use App\ReadingQuestion AS ReadingQuestion;
use App\WrittenExam;
use App\WrittenExamResult;
use Carbon\Carbon;

use Mail;

class RegistrationController extends Controller
{


    function __construct()
    {
        if(Auth::check()){
            $this->user = Auth::user();
        }else{
            $this->user = new User;
        }
    }

    function partOne(Request $request)
    {
        $user = $this->user;
        return view('blocks.registration.first', compact('user'));
    }

    function partTwo()
    {
        $eslExp = [];
        $ccExp = [];

        $experiences = $this->user->experiences()->get();

        foreach($experiences AS $row){
            if($row->experience_type === 'ESL'){
                    $eslExp[] = $row;
            }else{
                $ccExp[] = $row;
            }
        }

        return view('blocks.registration.second', compact(['eslExp', 'ccExp']));
    }

    function partThree()
    {
        if($this->user->getProfileProgress() < 40){
            return redirect()->route('register.second');
        }

        $userPreference = $this->user->preference();
        $preference = $userPreference->exists() ? $userPreference->first() : new Preference;
        return view('blocks.registration.third', compact('preference'));
    }

    function savePartOne(Request $request)
    {
        $isGuest = !Auth::check();

        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'middleinitial' => 'required',
            'gender' => 'required|in:MALE,FEMALE',
            'birthdate' => 'required|date_format:Y-n-j',
            'marital_status' => 'required|in:SINGLE,SEPARATED,MARRIED,DIVORCED,SEPARATED',
            'mobile_number' => 'required|numeric|digits:11',
            'email_address' => "required|email|unique:users,email_address",
            'skype_account' => 'required|string|unique:users,skype_account',
            'street_address' => 'required',
            'city' => 'required',
            'province' => 'required', 
        ];

        if($isGuest){
            $rules['password'] = 'required|min:4|confirmed';

        }else{
            $rules['email_address'] .= (','.Auth::user()->id);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
        }

        $input = $request->only(['firstname', 'middleinitial', 'lastname', 'gender', 'marital_status', 'mobile_number', 'email_address', 'skype_account', 'street_address', 'city', 'province', 'country']);
        $input['birthdate'] = date_create_immutable_from_format('Y-n-j', $request->input('birthdate'))->format('Y-m-d');

        if($request->input('password')){
             $input['password'] = bcrypt($request->input('password'));
        }
       
        $input['account_type'] = User::ACCOUNT_TYPE_TEACHER;

        if($isGuest){

            $user = User::create($input);
            Auth::loginUsingId($user->id);         
            $user->sendVerificationLink();  

        }else{
            User::where('id', Auth::user()->id)->update($input);
        }

        return response()->json([
            'result' => TRUE,
        ]);
        
    }

    function verifyEmail($code)
    {
        $user = User::where(['confirmation_code' => $code])->firstOrFail();
        $user->confirmed_at = NULL;
        $user->save();

        Auth::loginUsingId($user->id);

        session()->flash('email_verification_ok', TRUE);
        return redirect()->route('profile');
    }

    function resendVerification()
    {
        $this->user->sendVerificationLink();
        return redirect()->route('profile');
    }

    function savePartTwo(Request $request)
    {

        $user = Auth::user();

        $rules = [
            'exp.*.name' => 'required_if:exp.*.experience_type,ESL',
            'exp.*.position' => 'required_if:exp.*.experience_type,ESL',
            'exp.*.location' => 'required_if:exp.*.experience_type,ESL',
            'exp.*.start' => 'required_if:exp.*.experience_type,ESL|date_format:m/d/Y',
            'exp.*.end' => 'required_if:exp.*.experience_type,ESL|date_format:m/d/Y',
            'exp.*.experience_type' => 'required_with:exp.*.position,exp.*.location,exp.*.years,exp.*.name|in:ESL,CC',
            'exp.*.id' => 'exists:user_experiences,id,user_id,'.Auth::user()->id
        ];

        $validator = Validator::make($request->all(), $rules, [
            'exp.*.name.required_if' => 'Please fill this up.',
            'exp.*.position.required_if' => 'Please fill this up.',
            'exp.*.location.required_if' => 'Please fill this up.',
            'exp.*.start.required_if' => 'Please fill this up.',
            'exp.*.end.required_if' => 'Please fill this up.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => FALSE,
                'errors' => $validator->errors()
            ]);
        }

        $input = $request->input('exp');
        
        $updated = [];
        $new = [];

        foreach($input AS $row){
            if(isset($row['name']) && trim($row['name'])){
                $temp = array_only($row, ['name', 'location', 'position', 'start', 'end', 'experience_type']);
                if(isset($row['id'])){
                    $updated[$row['id']] = $temp;
                }else{
                    $new[] = new Experience($temp);
                }
            }
        }

        if(count($updated)){
            $user->experiences()->whereNotIn('id', array_keys($updated))->delete();
            foreach($updated AS $id => $data){
                $exp = Experience::find($id);
                $exp->update($data);
            }
        }else{
            $user->experiences()->delete();
        }

        if(count($new)){
            $user->experiences()->saveMany($new);
        }

        return response()->json([
            'result' => TRUE,
        ]);
    }

    function savePartThree(Request $request)
    {

        // ini_set('post_max_size', '2GB'); 

        $user = Auth::user();
        // return response()->json($request->all());

        $rules = [
            'work_schedule' => 'required|in:MORNING,AFTERNOON,EVENING,MIDNIGHT',
            'demo_day' => 'required|in:MON,TUE,WED,THU,FRI,SAT,SUN',
            'demo_time' => 'required|max:20',
            'major' => 'required|in:OTHERS,BSCAE,BASC,BALL',
            'other_major' => 'required_if:major,OTHERS',
            'tesol_certificate' => 'image|max:2048',
            'tefl_certificate' => 'image|max:2048',
        ];

        $hasPreference = $this->user->preference()->exists();

        if(!$hasPreference){
            $rules += [
                'display_photo' => 'required|image|max:2048',
                'internet_speed_screenshot' => 'required|image|max:2048'
            ];
        }

        $validator = Validator::make($request->all(), $rules, ['other_major.required_if' => 'Please fill up this field.']);

        if ($validator->fails()) {
            return response()->json([
                'result' => FALSE,
                'errors' => $validator->errors()
            ]);
        }


        $data = $request->only(['work_schedule', 'demo_day', 'demo_time', 'major', 'remarks']);

        if($data['major'] === 'OTHERS'){
            $data['other_major'] = $request->input('other_major');
        }

        $uploads = [];

        $fileInputs = [
            'display_photo' => 'display', 
            'internet_speed_screenshot' => 'speedtest', 
            'tesol_certificate' => 'certificates', 
            'tefl_certificate' => 'certificates'
        ];

        foreach($fileInputs AS $name => $dir){
            if(!$request->hasFile($name)) continue;
            $file = $request->file($name);
            $fileName = uniqid().'.'.$file->getClientOriginalExtension();
            $uploads[$name][] = $fileName;
            $file->move("uploads/{$user->id}/{$dir}", $fileName);
            $data["{$name}_filename"] = $fileName;
        }

        if($user->preference()->exists()){
            $user->preference()->update($data);
        }else{
            $user->preference()->save(new Preference($data));
        }

        return response()->json([
            'result' => TRUE,
            'data' => $data
        ]);

    }

    function readingExamConfirmation()
    {
        $story = Story::orderBy('id', 'DESC')->first();
        if(!$this->user->canTakeReadingExam()){
            abort(404);   
        }
        if($this->user->hasOngoingReadingExam()){
            return redirect()->route('reading.exam');
        }else{
            return view('blocks.registration.reading-exam-confirmation', [
                'timeLimit' => $story->limit
            ]); 
        }
    }

    function startReadingExam()
    {

        $story = Story::orderBy('created_at', 'DESC')->first()->formatted();
        $questions = ReadingQuestion::all();

        foreach($questions AS &$q){
            $q->choices = array_merge($q->wrong_answers, $q->correct_answers);
            $q->num_correct = count($q->correct_answers);
            shuffle($q->choices);
        }

       
        if($this->user->hasOngoingReadingExam()){

            $story->limit  = $this->user->getRemainingReadingExamTime();

        }else{

            $story->limit *= 60;
            $result = ReadingResult::create([
                'datetime_started' => NULL,
                'user_id' => $this->user->id,
                'reading_storyboard_id' => $story->id
            ]);
        }

        return view('blocks.registration.reading-exam', compact(['story', 'questions']));
    }


    function saveReadingExamResults(Request $request)
    {
         $exam = $this->user->latestReadingExamResult();
         $items = $request->input('item') ?: [];
         $answers = [];

         foreach($items AS $questionId => $choices){
             $answers[$questionId] = $choices['answers'];
         }
         $exam->answers = $answers;
         $exam->save();

         if($request->input('finish')){
             $exam->calculateScore()->save();
             if($exam->didPassed()){
                 session()->flash('reading_exam_result_passed', true);
             }
             return response()->json(['result' => true, 'next_url' => route('profile')]);
         }
    }


    function writtenExamConfirmation()
    {
        if($this->user->hasOngoingWrittenExam()){
            return redirect()->route('written.exam');
        }else{
            return view('blocks.registration.written-exam-confirmation'); 
        }
    }

    function startWrittenExam()
    {
       
        if($this->user->hasOngoingWrittenExam()){

            $exam = $this->user->latestWrittenExamResult();
            $essay = $exam->essay;
            $essay->limit = $this->user->getRemainingWrittenExamTime();

        }else{

            $essay = WrittenExam::inRandomOrder()->first();
            $essay->limit *= 60;
            $exam = new WrittenExamResult([
                'written_exam_id' => $essay->id,
                'datetime_started' => NULL
            ]);
            $this->user->writtenExamResult()->save($exam);

        }

        return view('blocks.registration.written-exam', compact(['essay']));
    }


    function saveWrittenExamResults(Request $request)
    {
         $exam = $this->user->latestWrittenExamResult();
         $exam->answer = $request->input('answer');
         $exam->datetime_ended = NULL;
         $exam->save();
         return response()->json(['result' => TRUE, 'next_url' => route('profile')]);
    }

    



}
