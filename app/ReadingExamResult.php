<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadingExamResult extends Model
{
    protected $fillable = ['datetime_started', 'user_id', 'reading_storyboard_id'];

    public $timestamps = FALSE;
}
