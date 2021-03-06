<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    
    protected $fillable = ['work_schedule', 'demo_day', 'demo_time', 'remarks', 'display_photo_filename', 'tesol_certificate_filename', 'tefl_certificate_filename', 'internet_speed_screenshot_filename', 'major', 'other_major', 'remarks'];
}

