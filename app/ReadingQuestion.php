<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes; 


class ReadingQuestion extends Model
{

    use SoftDeletes;
    //

    protected $fillable = ['body', 'correct_answers', 'wrong_answers'];

    public $choices;
    public $num_correct;

    protected $casts = [
        'correct_answers' => 'array',
        'wrong_answers' => 'array',
    ];

}
