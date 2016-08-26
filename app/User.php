<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email_address', 'birthdate', 'gender', 'marital_status', 'mobile_number', 'skype_account', 'street_address', 'city', 'province', 'country', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function getBirth($part){

        $parts = ['month' => 'm', 'year' => 'Y', 'day' => 'd'];

        if(!in_array($part, array_keys($parts)) || !$this->birthdate){
            return NULL;
        }

        $birthdate  = date_create_immutable($this->birthdate);

        return $birthdate->format($parts[$part]);
    }

}
