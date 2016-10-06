<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; 
class NeededTeachersFullfillment extends Model
{
    //
     use SoftDeletes;

    protected $fillable = ['morning', 'afternoon', 'evening', 'midnight', 'created_by', 'date_fulfilled', 'request_id'];

    function fulfilledBy()
    {
        return $this->belongsTo('App\User', 'created_by')->select(['id', 'firstname', 'lastname']);
    }

    function getDateFulfilledAttribute($date)
    {
        return date_create_immutable($date)->format('M d, Y');
    }
}
