<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

use App\User;
use App\UserDemoClass AS DemoClass;
use App\UserOrientation AS Orientation;
use App\UserRequirement AS Requirement;



class ApplicantsController extends Controller
{
    function summary()
    {
        $applicants = User::teacher()->with(['latestReadingExam', 'latestWrittenExam', 'demoClass', 'orientation', 'requirement'])->get();
        return view('blocks.applicants.summary', compact('applicants'));
    }

    function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phase' => 'required|in:DEMO,ORIENTATION,REQUIREMENTS',
            'status' => 'required|in:PASSED,FAILED,PENDING'
        ]);

        if($validator->fails()){
            return [
                'result' => FALSE,
                'errors' => $validator->errors()
            ];
        }

        $user = User::findOrFail($id);
        $status = $request->input('status');
        if($request->input('phase') === 'DEMO'){

            if($user->demoClass()->exists()){
                $user->demoClass->status = $status;
                $user->demoClass->save();
            }else{
                $user->demoClass()->save(new DemoClass([
                    'status' =>  $status
                ]));
            }

        }elseif($request->input('phase') === 'ORIENTATION'){

            if($user->orientation()->exists()){
                $user->orientation->status = $status;
                $user->orientation->save();
            }else{
                $user->orientation()->save(new Orientation([
                    'status' =>  $status
                ]));
            }
        }else{

            if($user->requirement()->exists()){
                $user->requirement->status = $status;
                $user->requirement->save();
            }else{
                $user->requirement()->save(new Requirement([
                    'status' =>  $status
                ]));
            }
        }

        return [
            'result' => TRUE,
            'errors' => $validator->errors()
        ];
    }
}
