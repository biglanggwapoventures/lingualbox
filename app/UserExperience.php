<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    protected $fillable = ['name', 'location', 'position', 'years', 'months', 'experience_type'];
}
