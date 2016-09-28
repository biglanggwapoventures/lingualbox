<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NeededTeacher extends Model
{
    //

    protected $fillable = ['morning', 'afternoon', 'evening', 'midnight'];
}
