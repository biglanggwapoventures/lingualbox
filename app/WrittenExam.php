<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; 

class WrittenExam extends Model
{
    use SoftDeletes;

    protected $fillable = ['body', 'limit'];
    

   function formattedBody()
    {
        return preg_replace('/\r\n|\r|\n/', '<br />', $this->body);
    }

}
