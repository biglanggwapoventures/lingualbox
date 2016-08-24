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
        if(Auth::user()){
            $user =  Auth::user();
            $birthdate = date_create_immutable($user->birthdate);
            $user->birthyear = $birthdate->format('Y');
            $user->birthmonth = $birthdate->format('n');
            $user->birthday = $birthdate->format('j');
        }else{
            $user = new User;
            $user->birthyear = '';
            $user->birthmonth = '';
            $user->birthday = '';
        }

        return view('blocks.registration.first', compact('user'));
    }

    function partTwo()
    {
        if(!Auth::user()){
            return redirect()->route('register.first');
        }
        return view('blocks.registration.second');
    }

    function savePartOne(Request $request)
    {
        $user = Auth::user() ?: new User;

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

        if(!$user->id){
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

            if($user->id){
                User::where('id', $user->id)->update($input);
            }else{
                $user = User::create($input);
                Auth::loginUsingId($user->id);
            }
            
            return response()->json([
               'result' => TRUE,
           ]);
        }
    }
}
