<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ReadingStoryboard extends Model
{
    protected $fillable = ['title', 'body', 'limit', 'passing_score'];

    function formatted()
    {
        $this->body = preg_replace('/\r\n|\r|\n/', '<br />', $this->body);
        return $this;
    }

    function latest()
    {
        return $this->orderBy('created_at', 'DESC')->first();
    }

}
