<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\UserExperience AS Experience;
use App\UserPreference AS Preference;

class User extends Authenticatable
{

    const ACCOUNT_TYPE_TEACHER = 'TEACHER';
    const ACCOUNT_TYPE_HR = 'HR';
    const ACCOUNT_TYPE_ADMIN = 'ADMIN';

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

    function experiences()
    {
        return $this->hasMany('App\UserExperience');
    }

    function preference()
    {
        return $this->hasOne('App\UserPreference');
    }

    function fullname()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    function getProfileProgress()
    {
        $experiences = $this->experiences()->where('experience_type', Experience::EXPERIENCE_TYPE_ESL)->exists();
        if(!$experiences){
            return 20;
        }
        $preferences = $this->preference()->exists();
        if(!$preferences){
            return 40;
        }
        return 50;
    }

    function isAdmin()
    {
        return $this->account_type === self::ACCOUNT_TYPE_ADMIN;
    }

    function isTeacher()
    {
        return $this->account_type === self::ACCOUNT_TYPE_TEACHER;
    }

    function isHR()
    {
        return $this->account_type === self::ACCOUNT_TYPE_HR;
    }

}
