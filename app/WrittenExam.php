<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WrittenExam extends Model
{
    protected $fillable = ['body', 'limit'];

   function formattedBody()
    {
        return preg_replace('/\r\n|\r|\n/', '<br />', $this->body);
    }

}
