<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class WrittenExamResult extends Model
{
    protected $fillable = ['datetime_started', 'user_id', 'written_exam_id'];

    public $timestamps = FALSE;

    function getDatetimeEndedAttribute($val)
    {
        if($val === '0000-00-00 00:00:00'){
            return NULL;
        }
        return $val;
    }

    function essay()
    {
        return $this->belongsTo('App\WrittenExam', 'written_exam_id', 'id');
    }

    function didPassed()
    {
        return $this->result === 'PASSED';
    }

    function isPending()
    {
         return !$this->result;
    }

    function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->select(['id', 'firstname', 'lastname', 'gender', 'email_address']);
    }

    function userPreference()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->with('preference')->select(['id', 'firstname', 'lastname']);
    }

    function datetimeStartedFormatted()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->datetime_started)->format('F d, Y h:i A');
    }

    function datetimeFinishedFormatted()
    {
        return $this->datetime_ended ? Carbon::createFromFormat('Y-m-d H:i:s', $this->datetime_ended)->format('F d, Y h:i A') : '';
    }

    function formattedAnswer()
    {
        return preg_replace('/\r\n|\r|\n/', '<br />', $this->answer);
    }

    function formattedDemoInstructions()
    {
        return preg_replace('/\r\n|\r|\n/', '<br />', $this->demo_instructions);
    }
}
