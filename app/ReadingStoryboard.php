<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadingStoryboard extends Model
{
    protected $fillable = ['title', 'body', 'limit'];

    function formatted()
    {
        $this->body = preg_replace('/\r\n|\r|\n/', '<br />', $this->body);
        return $this;
    }
}
