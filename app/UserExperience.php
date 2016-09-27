<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class UserExperience extends Model
{

    const EXPERIENCE_TYPE_ESL = 'ESL';
    const EXPERIENCE_TYPE_CALL_CENTER = 'CC';

    protected $fillable = ['name', 'location', 'position', 'start', 'end', 'experience_type'];

    // protected $dates = ['start', 'end'];

    function getStartAttribute($value)
    {
        $date = new Carbon($value, 'Asia/Manila');
        return $date->format('m/d/Y');
    }

    function setStartAttribute($value)
    {
        $date = Carbon::createFromFormat('m/d/Y', $value, 'Asia/Manila');
        $this->attributes['start'] = $date->toDateString();
    }

    function getEndAttribute($value)
    {
        $date = new Carbon($value, 'Asia/Manila');
        return $date->format('m/d/Y');
    }

    function setEndAttribute($value)
    {
        $date = Carbon::createFromFormat('m/d/Y', $value, 'Asia/Manila');
        $this->attributes['end'] = $date->toDateString();
    }
}
