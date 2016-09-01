<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{

    const EXPERIENCE_TYPE_ESL = 'ESL';
    const EXPERIENCE_TYPE_CALL_CENTER = 'CC';

    protected $fillable = ['name', 'location', 'position', 'years', 'months', 'experience_type'];
}
