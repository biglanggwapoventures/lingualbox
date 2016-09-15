<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequirement extends Model
{
    const STATUS_PASSED = 'PASSED';
    const STATUS_FAILED = 'FAILED';
    public $timestamps = FALSE;
    protected $fillable = ['user_id', 'status'];
    function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->select(['id', 'firstname', 'lastname', 'gender', 'email_address']);;
    }

    function didPass()
    {
        return $this->status == self::STATUS_PASSED;
    }
}
