<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\UserExperience AS Experience;
use App\UserPreference AS Preference;
use App\ReadingExamResult AS ReadingResult;
use App\ReadingStoryboard AS Story;
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
        'firstname', 'lastname', 'email_address', 'birthdate', 'gender', 'marital_status', 'mobile_number', 'skype_account', 'street_address', 'city', 'province', 'country', 'password', 'confirmation_code'
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
        return "{$this->firstname} {$this->lastname}";
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

    function displayPhoto()
    {
        $displayPhoto = asset('images/display-photo-placeholder.png');
        if(!empty($this->preference)){
            $displayPhoto = asset("uploads/{$this->id}/display/{$this->preference->display_photo_filename}");
        }
        return $displayPhoto;
    }

}