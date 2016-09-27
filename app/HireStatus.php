<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Validator;

use App\UserHireStatus AS Hired;

class HireStatus extends Model
{
    protected $table = 'hired_status';
    protected $fillable = ['user_id', 'status', 'hired_at', 'failed_at'];
    protected $casts = [
        'work_days' => 'array'
    ];

    public $timestamps = FALSE;

    function user()
    {
        return $this->belongsTo('App\User');
    }

    

    


}

