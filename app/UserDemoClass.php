<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDemoClass extends Model
{

    const STATUS_PASSED = 'PASSED';
    const STATUS_FAILED = 'FAILED';

    protected $fillable = ['user_id', 'instructions', 'instructions_sent_at', 'status'];

    public $timestamps = FALSE;

    function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->select(['id', 'firstname', 'lastname', 'gender', 'email_address']);;
    }

    function didPass()
    {
        return $this->status == self::STATUS_PASSED;
    }
}
