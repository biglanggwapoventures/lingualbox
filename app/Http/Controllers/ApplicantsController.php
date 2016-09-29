<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

use App\User;
use App\UserDemoClass AS DemoClass;
use App\UserOrientation AS Orientation;
use App\UserRequirement AS Requirement;
use App\HireStatus;



class ApplicantsController extends Controller
{
    function summary()
    {
        $applicants = User::teacher()->orderBy('id', 'DESC')->get();
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

        $status = $user->phaseStatus();

        $hireStatus = $status['OVERALL'] === 'HIRED' ? 'ACTIVE' : $status['OVERALL'];
        

        if(in_array($hireStatus, ['ACTIVE', 'FAILED'])){

            // $now = date('Y-m-d H:i:s');
            $hiredAt = $hireStatus === 'ACTIVE' ? NULL : 0;
            $failedAt = $hireStatus === 'FAILED' ? NULL : 0;

            $data = [
                'status' => $hireStatus,
                'hired_at' => $hiredAt,
                'failed_at' => $failedAt
            ];

            if($user->hireStatus()->exists()){
                $user->hireStatus->fill($data);
                $user->hireStatus->save();
            }else{
                $user->hireStatus()->save(new HireStatus($data));
            }
        }

        return [
            'result' => TRUE,
            'errors' => $validator->errors()
        ];
    }
}
