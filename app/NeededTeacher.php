<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; 

use DB;

use App\NeededTeachersFullfillment AS FulFillment;

class NeededTeacher extends Model
{
    //

    use SoftDeletes;

    protected $fillable = ['morning', 'afternoon', 'evening', 'midnight', 'created_by', 'date_requested'];

    function requestor()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    function getDateRequestedAttribute($date)
    {
        return date_create_immutable($date)->format('M d, Y');
    }

    function fulfillments()
    {
        return $this->hasMany(FulFillment::class, 'request_id', 'id')->orderBy('id', 'DESC');
    }

    function getUnfulfilled()
    {
        return DB::table(DB::raw('needed_teachers AS request'))
            ->select(DB::raw('request.id, request.date_requested, (request.morning + request.afternoon + request.evening + request.midnight) AS needed, IFNULL(SUM(fulfill.morning + fulfill.afternoon + fulfill.evening + fulfill.midnight), 0) AS fulfilled'))
            ->leftJoin(DB::raw('needed_teachers_fullfillments AS fulfill'), function($join){
                $join->on('request.id', '=', 'fulfill.request_id')->whereNull('fulfill.deleted_at');
            })
            ->whereNull('request.deleted_at')
            ->groupBy('request.id')
            ->orderBy('date_requested', 'DESC')
            ->havingRaw('needed > fulfilled')
            ->get();
    }

    function isFulfilled()
    {
        $fulfillments = FulFillment::select(['morning', 'evening', 'afternoon', 'midnight'])->where('request_id', $this->id)->get(); 
        $totalFulfilled = $fulfillments->sum(function($item){
            return array_sum(array_values($item->toArray()));
        });
        $request = $this->morning + $this->afternoon + $this->evening + $this->midnight;
        return $request <= $totalFulfilled;
    }

}
