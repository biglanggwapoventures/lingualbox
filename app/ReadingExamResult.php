<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use ReadingStoryboard AS Story;

class ReadingExamResult extends Model
{
    protected $fillable = ['datetime_started', 'user_id', 'reading_storyboard_id'];

    public $timestamps = FALSE;

    protected $casts = [
        'answers' => 'array'
    ];

    function getDatetimeEndedAttribute($val)
    {
        if($val === '0000-00-00 00:00:00'){
            return NULL;
        }
        return $val;
    }

    function latest()
    {
        return $this->orderBy('datetime_started', 'DESC');
    }

    function story()
    {
        return $this->belongsTo('App\ReadingStoryboard', 'reading_storyboard_id', 'id');
    }

     function user()
    {
        return $this->belongsTo('App\User');
    }

    function calculateScore()
    {         
         $story = $this->story;
         $questionsAnswered = ReadingQuestion::find(array_keys($this->answers));

         $totalPoints = 0;

         foreach($questionsAnswered AS $q){
             $points = count($q->correct_answers);

             if($points === 1){
                 if(in_array($this->answers[$q->id][0], $q->correct_answers)){
                     $totalPoints++;
                     continue;
                 }
             }
             
            $wrongCount = 0;
            $correctCount = 0;
             foreach($this->answers[$q->id] AS $answer){
                 if(in_array($answer, $q->correct_answers)){
                     $correctCount++;
                 }else{
                     $wrongCount++;
                 }
             }
             $itemPoints = $correctCount - $wrongCount;
             if($itemPoints > 0){
                 $totalPoints += $itemPoints;
             }
         }

         $this->score = $totalPoints;
         $this->datetime_ended = date_create_immutable(null)->format('Y-m-d H:i:s');
         return $this;
    }

    function didPassed()
    {
        return $this->score >= $this->story->passing_score;
    }
}
