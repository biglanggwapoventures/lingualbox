<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\NeededTeacher As Demand;

use Validator;
use Auth;

class NeededTeachersController extends Controller
{
    function show()
    {
        $demand = Demand::orderBy('id', 'DESC')->first() ?: new Demand;
        if(Auth::user()->isAdmin()){
            return view('blocks.reports.needed-teachers', compact('demand'));
        }
        return view('blocks.reports.needed-teachers-view-only', compact('demand'));
    }

    function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'morning' => 'numeric',
            'afternoon' => 'numeric',
            'evening' => 'numeric',
            'midnight' => 'numeric'
        ]);

        if($validator->fails()){
            return response()->json([
                'result' => false,
                'errors' => $validator->errors()
            ]);
        }

        Demand::create($request->only(['morning', 'afternoon', 'evening', 'midnight']));

        return response()->json([
            'result' => true
        ]);
    }

    function fulfill()
    {
        $demand = new Demand;
        $demand->fulfilled = TRUE;
        $demand->save();
        
        return response()->json([
            'result' => true
        ]);
    }
}
