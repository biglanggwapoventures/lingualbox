<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\HireStatus As Hired;

use Validator;

class HiredController extends Controller
{
    function summary()
    {
        $users = Hired::where('status', '!=', 'FAILED')->with('user.preference')->get();
        return view('blocks.hired.summary', compact('users'));
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|in:shift,work_days,time_schedule,rate,status',
            'pk' => 'required|exists:hired_status,user_id',
        ]);

        if($validator->fails()){
            return response()->json([
                'result' => false,
                'errors' => $validator->errors()
            ]);
        }

        $attr = $request->input('name');
        $user = Hired::where('user_id', $request->input('pk'))->firstOrFail();
        $user->$attr = $request->input('value');
        $user->save();

        return response()->json([
            'result' => TRUE
        ]);

    }

    
}
