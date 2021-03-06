<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;
use App\PasswordReset;
use Carbon\Carbon;
use App\User;
use Auth;

class ForgotPasswordController extends Controller
{
    function index()
    {
        return view('blocks.forgot-password');
    }

    function sendRecoveryEmail(Request $request)
    {
        $this->validate($request, [
            'email_address' =>  'required|exists:users,email_address'
        ]);

        $token = uniqid('LB', true);
        $user = User::where(['email_address' => $request->input('email_address')])->first();

        $reset = PasswordReset::create([
            'email' => $request->input('email_address'),
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Mail::send('blocks.email-templates.password-recovery', ['user' => $user->firstname, 'token' => $token], function ($m) USE ($user){
            $m->from('support@lingualbox.com', 'LingualBox');
            $m->to($user->email_address, $user->firstname)->subject('Reset your LingualBox password');
        });

        return redirect()->route('password.forgot.page');
        // return redirect()->intended();
    }

    function showRecoveryPage($token)
    {
        $reset = PasswordReset::where('token', $token)->first();
        $now = Carbon::now();
        $tokenDate = Carbon::createFromFormat('Y-m-d H:i:s', $reset->created_at, 'Asia/Manila');
        if($now->diffInHours($tokenDate) < 24){
            return view('blocks.reset-password', compact('token')); 
        }else{
            abort(404);
        }
        
    }

    function resetPassword($token, Request $request)
    {
        $reset = PasswordReset::where('token', $token)->first();
        $now = Carbon::now();
        $tokenDate = Carbon::createFromFormat('Y-m-d H:i:s', $reset->created_at, 'Asia/Manila');
        if($now->diffInHours($tokenDate) < 24){

            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);

            $user = User::where('email_address', $reset->email)->first();
            $user->password = bcrypt($request->input('password'));
            $user->save();

            Auth::loginUsingId($user->id);
            
            session()->flash('password_reset', 'Password has been successfuly reset!');
            return redirect()->route('profile');

        }else{
            abort(404);
        }
    }

}
