<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

use Auth;

class AuthController extends Controller
{
    function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_address' => 'required|email|exists:users,email_address',
            'password' => 'required'
        ], [
            'email_address.exists' => 'The email address you provided does not match with any existing account. If you have not created an account yet, please click <a href="'.route('register.first').'">here</a> to create one.'
        ]);

        if($validator->fails()){

            return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
           
        }else{

            $credentials = $request->only(['email_address', 'password']);

            if(Auth::attempt(['email_address' => $credentials['email_address'], 'password' => $credentials['password']])){
                return response()->json(['result' => TRUE]);  
            }

            return response()->json([
                'result' => FALSE,
                'errors' => ['password' => ['You have entered an incorrect password']]
            ]);
            
        }
    }
}
