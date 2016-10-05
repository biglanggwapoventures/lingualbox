<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\UserExperience AS Experience;
use App\UserPreference AS Preference;
use App\ReadingExamResult AS ReadingResult;
use App\ReadingStoryboard AS Story;
use App\UserDemoClass AS DemoClass;
use App\HireStatus AS Hire;
use Carbon\Carbon;
use Auth;
use Mail;
use DB;

class User extends Authenticatable
{

    const ACCOUNT_TYPE_TEACHER = 'TEACHER';
    const ACCOUNT_TYPE_HR = 'HR';
    const ACCOUNT_TYPE_ADMIN = 'ADMIN';

    const ERR_PREFERENCE_LACKING = 'PREFERENCE_LACKING';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'middleinitial', 'suffix', 'email_address', 'birthdate', 'gender', 'marital_status', 'mobile_number', 'skype_account', 'street_address', 'city', 'province', 'password', 'confirmation_code'
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    function scopeTeacher($query)
    {
        return $query->where('account_type', self::ACCOUNT_TYPE_TEACHER);
    }

    function getBirth($part){

        $parts = ['month' => 'm', 'year' => 'Y', 'day' => 'd'];

        if(!in_array($part, array_keys($parts)) || !$this->birthdate){
            return NULL;
        }

        $birthdate  = date_create_immutable($this->birthdate);

        return $birthdate->format($parts[$part]);
    }

    function experiences()
    {
        return $this->hasMany('App\UserExperience');
    }

    function preference()
    {
        return $this->hasOne('App\UserPreference');
    }

    

    function readingExamResult()
    {
        return $this->hasMany('App\ReadingExamResult');
    }

    function latestReadingExam()
    {
        return $this->hasOne('App\ReadingExamResult')->orderBy('datetime_started', 'DESC');
    }

    function latestWrittenExam()
    {
        return $this->hasOne('App\WrittenExamResult')->orderBy('datetime_started', 'DESC');
    }

    function demoClass()
    {
        return $this->hasOne('App\UserDemoClass')->orderBy('id', 'DESC');
    }

    function orientation()
    {
        return $this->hasOne('App\UserOrientation')->orderBy('id', 'DESC');
    }

    function requirement()
    {
        return $this->hasOne('App\UserRequirement')->orderBy('id', 'DESC');
    }

    function hireStatus()
    {
        return $this->hasOne('App\HireStatus')->orderBy('id', 'DESC');
    }
    

    
    function writtenExamResult()
    {
        return $this->hasMany('App\WrittenExamResult');
    }

    function latestReadingExamResult()
    {
        return $this->readingExamResult()->orderBy('datetime_started', 'DESC')->first();
    }

    function latestWrittenExamResult()
    {
        return $this->writtenExamResult()->orderBy('datetime_started', 'DESC')->first();
    }

    function nextReadingExam()
    {
        $now = Carbon::now('Asia/Manila');
        if($this->latestReadingExam()->exists()){
            $lastReadingExam = Carbon::createFromFormat('Y-m-d H:i:s', $this->latestReadingExam->datetime_started, 'Asia/Manila');
            $next = $lastReadingExam->addMonths(6);
            return $next->format('F d, Y');
        }
        return $now->format('F d, Y');;
    }

    function nextWrittenExam()
    {
        $now = Carbon::now('Asia/Manila');
        if($this->latestWrittenExam()->exists() && $this->latestWrittenExam->result === 'FAILED'){
            $lastReadingExam = Carbon::createFromFormat('Y-m-d H:i:s', $this->latestWrittenExam->datetime_started, 'Asia/Manila');
            $next = $lastReadingExam->addMonths(6);
            return $next->format('F d, Y');
        }
        return $now->format('F d, Y');;
    }

    function canTakeReadingExam()
    {

        if(!$this->preference()->exists()){
            return FALSE;
        }

        $pastExams = $this->readingExamResult();
        if($pastExams->exists()){

            $exam = $this->latestReadingExamResult();

            $story = Story::find($exam->reading_storyboard_id);

            $now = Carbon::now();
            $pastExamDate = Carbon::createFromFormat('Y-m-d H:i:s', $exam->datetime_started);

            $allowance = $pastExamDate->copy()->addMinutes($story->limit);
            if(!$exam->datetime_ended && $allowance->gt($now)){
                return TRUE;
            }

            $cooldown = $pastExamDate->copy()->addMonths(6);
            if($cooldown->lt($now)){
                return TRUE;
            } 

            return FALSE;
        }
        return TRUE;
    }
    

    function canTakeWrittenExam()
    {
        // check if user has already took an exam
        if(!$this->readingExamResult()->exists()){
            return FALSE;
        }

        // user already took the exam, determine if passed
        if(!$this->latestReadingExamResult()->didPassed()){
            return FALSE;
        }

        if(!$this->writtenExamResult()->exists()){
            return TRUE;
        }

        $exam = $this->latestWrittenExamResult();
        $now = Carbon::now();
        $examDate = Carbon::createFromFormat('Y-m-d H:i:s', $exam->datetime_started);

        $allowance = $examDate->copy()->addMinutes($exam->essay->limit);
        if(!$exam->datetime_ended && $allowance->gt($now)){
            return TRUE;
        }

        $cooldown = $examDate->copy()->addMonths(6);
        if($cooldown->lt($now)){
            return TRUE;
        } 

        return FALSE;

        
    }

   

    function canFillExperience()
    {
        return Auth::check();
    }

     function canFillPreference()
    {
        return $this->experiences()->exists();
    }


    function getRemainingReadingExamTime()
    {
        $exam = $this->latestReadingExamResult();
        // return response()->json($exam);
        $story = Story::find($exam->reading_storyboard_id);

        $deadline = Carbon::createFromFormat('Y-m-d H:i:s', $exam->datetime_started)->addMinutes($story->limit);
        $now = Carbon::now();
        
        $diff = $deadline->diffInSeconds($now);

        return $diff;
    }

    function getRemainingWrittenExamTime()
    {
        $exam = $this->latestWrittenExamResult();
        $now = Carbon::now();
        $deadline = Carbon::createFromFormat('Y-m-d H:i:s', $exam->datetime_started)->addMinutes($exam->essay->limit);
        return $deadline->diffInSeconds($now);
    }

    function hasOngoingReadingExam()
    {
        $past = $this->readingExamResult();

        if(!$past->exists()){
            return FALSE;
        }

        $exam = $this->latestReadingExamResult();

        // return response()->json($exam);

        $story = Story::find($exam->reading_storyboard_id);

        $now = Carbon::now();
        $examDate = Carbon::createFromFormat('Y-m-d H:i:s', $exam->datetime_started);

        $diff = $now->diffInSeconds($examDate);

        $remaining = $story->limit - ($diff / 60);

        return $remaining > 0;
    }

    function hasOngoingWrittenExam()
    {
        if(!$this->writtenExamResult()->exists()){
            return FALSE;
        }

        $exam = $this->latestWrittenExamResult();

        $now = Carbon::now();
        $examDate = Carbon::createFromFormat('Y-m-d H:i:s', $exam->datetime_started);

        $diff = $now->diffInSeconds($examDate);

        $remaining = $exam->essay->limit - ($diff / 60);

        return $remaining > 0;
    }

    function pendingWrittenExam()
    {
        return $this->hasMany('App\WrittenExam')
            ->whereIsNull('result')
            ->orderBy('datetime_started', 'DESC')->first();
    }

    function fullname()
    {
        return "{$this->firstname} {$this->middleinitial} {$this->lastname}";
    }

    function getProfileProgress()
    {
        $experiences = $this->experiences()->where('experience_type', Experience::EXPERIENCE_TYPE_ESL)->exists();
        if(!$experiences){
            return 20;
        }
        $preferences = $this->preference()->exists();
        if(!$preferences){
            return 40;
        }
        return 50;
    }
    

    function isAdmin()
    {
        return $this->account_type === self::ACCOUNT_TYPE_ADMIN;
    }

    function isTeacher()
    {
        return $this->account_type === self::ACCOUNT_TYPE_TEACHER;
    }

    function isHR()
    {
        return $this->account_type === self::ACCOUNT_TYPE_HR;
    }

    function isAccountVerified()
    {
        return $this->confirmed_at !== '0000-00-00 00:00:00';
    }

    function sendVerificationLink()
    {
        $this->confirmation_code = uniqid('LB');
        $this->save();
        
        Mail::send('blocks.mail', ['user' => $this->firstname, 'code' => $this->confirmation_code], function ($m){
            $m->from('support@lingualbox.com', 'LingualBox');
            $m->to($this->email_address, $this->firstname)->subject('Verify your LingualBox account');
        });
    }

    function prepareForDemoClass($instructions, $status = 'PENDING')
    {
        $demo = new DemoClass([
            'instructions' => $instructions,
            'instructions_sent_at' => NULL,
            'status' => $status
        ]);

        $this->demoClass()->save($demo);

        Mail::send('blocks.email-templates.demo-class-details', ['user' => $this->firstname, 'content' => $demo->getFormattedInstructions()], function ($m){
            $m->from('support@lingualbox.com', 'LingualBox');
            $m->to($this->email_address, $this->firstname)->subject('Congratulations on passing your written exam!');
        });

        return $this;
    }

    function displayPhoto()
    {
        $displayPhoto = asset('images/display-photo-placeholder.png');
        if(!empty($this->preference)){
            $displayPhoto = asset("uploads/{$this->id}/display/{$this->preference->display_photo_filename}");
        }
        return $displayPhoto;
    }

    function readingExamStatus()
    {
        if($this->latestReadingExam()->exists()){
            return $this->latestReadingExam->didPassed() ? 'P' : 'F';
        }
        return 'NA';
    }

    function writtenExamStatus()
    {
        if($this->latestWrittenExam()->exists()){
            $result = $this->latestWrittenExam->result;
            switch($result){
                case 'PASSED': return 'P';
                case 'FAILED': return 'F';
                default: return 'R';
            }
        }
        return 'NA';
    }

    function demoClassStatus()
    {
        if($this->demoClass()->exists()){
            $result = $this->demoClass->status;
            switch($result){
                case 'PASSED': return 'P';
                case 'FAILED': return 'F';
                default: return 'R';
            }
        }
        return 'R';
    }

    function orientationStatus()
    {
        if($this->orientation()->exists()){
            $result = $this->orientation->status;
            switch($result){
                case 'PASSED': return 'P';
                case 'FAILED': return 'F';
                default: return 'R';
            }
        }
        return 'R';
    }

    function requirementsStatus()
    {
        if($this->requirement()->exists()){
            $result = $this->requirement->status;
            switch($result){
                case 'PASSED': return 'P';
                case 'FAILED': return 'F';
                default: return 'R';
            }
        }
        return 'R';
    }

    function phaseStatus()
    {
        $status = [];

        $readingExamStatus = $this->readingExamStatus();
        if(in_array($readingExamStatus, ['F', 'NA'])){
            $status += array_fill_keys(['WRITTEN', 'DEMO', 'ORIENTATION', 'REQUIREMENTS'], '-');
            switch($readingExamStatus){
                case 'F': 
                    $status['READING'] = 'FAILED';
                    $status['OVERALL'] = 'FAILED';
                    break;
                case 'NA':
                    $status['READING'] = '-';
                    $status['OVERALL'] = 'INC';
                    break;
            }
            return $status;
        }
        $status['READING'] = 'PASSED';

        $writtenExamStatus = $this->writtenExamStatus();
        if(in_array($writtenExamStatus, ['F', 'R', 'NA'])){
            $status += array_fill_keys(['DEMO', 'ORIENTATION', 'REQUIREMENTS'], '-');
            switch($writtenExamStatus){
                case 'F': 
                    $status['WRITTEN'] = 'FAILED';
                    $status['OVERALL'] = 'FAILED';
                    break;
                case 'R': 
                    $status['WRITTEN'] = 'PENDING';
                    $status['OVERALL'] = 'INC';
                    break;
                case 'NA':
                    $status['WRITTEN'] = '-';
                    $status['OVERALL'] = 'INC';
                    break;
            }
            return $status;
        }
        $status['WRITTEN'] = 'PASSED';

        $demoClassStatus = $this->demoClassStatus();
        if(in_array($demoClassStatus, ['F', 'R'])){
            $status += array_fill_keys(['ORIENTATION', 'REQUIREMENTS'], '-');
            switch($demoClassStatus){
                case 'F': 
                    $status['DEMO'] = 'FAILED';
                    $status['OVERALL'] = 'FAILED';
                    break;
                case 'R': 
                    $status['DEMO'] = 'PENDING';
                    $status['OVERALL'] = 'INC';
                    break;
            }
            return $status;
        }
        $status['DEMO'] = 'PASSED';

        $orientationStatus = $this->orientationStatus();
        if(in_array($orientationStatus, ['F', 'R'])){
            $status += array_fill_keys(['REQUIREMENTS'], '-');
            switch($orientationStatus){
                case 'F': 
                    $status['ORIENTATION'] = 'FAILED';
                    $status['OVERALL'] = 'FAILED';
                    break;
                case 'R': 
                    $status['ORIENTATION'] = 'PENDING';
                    $status['OVERALL'] = 'INC';
                    break;
            }
            return $status;
        }
        $status['ORIENTATION'] = 'PASSED';

        $requirementsStatus = $this->requirementsStatus();
        if(in_array($requirementsStatus, ['F', 'R'])){
            switch($requirementsStatus){
                case 'F': 
                    $status['REQUIREMENTS'] = 'FAILED';
                    $status['OVERALL'] = 'FAILED';
                    break;
                case 'R': 
                    $status['REQUIREMENTS'] = 'PENDING';
                    $status['OVERALL'] = 'INC';
                    break;
            }
            return $status;
        }
        $status['REQUIREMENTS'] = 'PASSED';

        $status['OVERALL'] = 'HIRED';
        return $status;

    }

    function setAsHired()
    {
       $data = [
            'status' => 'ACTIVE',
            'hired_at' => NULL
        ];

        if($this->hireStatus()->exists()){
            $this->hireStatus->fill($data);
            $this->hireStatus->save();
        }else{
            $this->hireStatus()->save(new Hire($data));
        }
    }

    function setAsFailed()
    {
        $data = [
            'status' => 'FAILED',
            'failed_at' => NULL
        ];

        if($this->hireStatus()->exists()){
            $this->hireStatus->fill($data);
            $this->hireStatus->save();
        }else{
            $this->hireStatus()->save(new Hire($data));
        }
    }


}