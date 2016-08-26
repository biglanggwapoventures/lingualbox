<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Http\Requests;

use App\User;
use Auth;

class RegistrationController extends Controller
{
    function partOne()
    {
        $user = Auth::check() ? Auth::user() :  new User;
        return view('blocks.registration.first', compact('user'));
    }

    function partTwo()
    {
        return view('blocks.registration.second');
    }

    function savePartOne(Request $request)
    {
        $isGuest = !Auth::check();

        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required|in:MALE,FEMALE',
            'birthdate' => 'required|date_format:Y-n-j',
            'marital_status' => 'required|in:SINGLE,SEPARATED,MARRIED,DIVORCED,SEPARATED',
            'mobile_number' => 'required',
            'email_address' => "required|email|unique:users,email_address,{$user->id}",
            'skype_account' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required', 
        ];

        if($isGuest){
            $rules['password'] = 'required|min:4|confirmed';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
        }else{

            $input = $request->only(['firstname', 'lastname', 'gender', 'marital_status', 'mobile_number', 'email_address', 'skype_account', 'street_address', 'city', 'province', 'country']);
            $input['birthdate'] = date_create_immutable_from_format('Y-n-j', $request->input('birthdate'))->format('Y-m-d');
            $input['password'] = bcrypt($request->input('password'));

            if($isGuest){
                $user = User::create($input);
                Auth::loginUsingId($user->id);
            }else{
                User::where('id', $user->id)->update($input);
            }
            
            return response()->json([
               'result' => TRUE,
           ]);
        }
    }
}
