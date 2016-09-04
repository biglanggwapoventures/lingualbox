<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadingStoryboard extends Model
{
    protected $fillable = ['title', 'body', 'limit'];
}
