<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadingQuestion extends Model
{
    //

    protected $fillable = ['body', 'correct_answers', 'wrong_answers'];

    public $choices;

    protected $casts = [
        'correct_answers' => 'array',
        'wrong_answers' => 'array',
    ];

}
