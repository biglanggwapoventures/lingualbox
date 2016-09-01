<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    
    protected $fillable = ['work_schedule', 'demo_day', 'demo_time', 'display_photo_filename', 'certificates_filename', 'internet_speed_screenshot_filename'];

}
