<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Http\Requests;

use App\User;
use Auth;
use App\UserExperience AS Experience;

class RegistrationController extends Controller
{
    function partOne(Request $request)
    {
        $user = Auth::check() ? Auth::user() :  new User;
        return view('blocks.registration.first', compact('user'));
    }

    function partTwo()
    {
        $eslExp = [];
        $ccExp = [];
        
        if(Auth::check()){
            $experiences = Auth::user()->experiences()->get();

            foreach($experiences AS $row){
                if($row->experience_type === 'ESL'){
                     $eslExp[] = $row;
                }else{
                    $ccExp[] = $row;
                }
            }
        }

        return view('blocks.registration.second', compact(['eslExp', 'ccExp']));
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
            'email_address' => "required|email|unique:users,email_address",
            'skype_account' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required', 
        ];

        if($isGuest){
            $rules['password'] = 'required|min:4|confirmed';
        }else{
            $rules['email_adress'] .= ",{$user->id}";
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
        }

        $input = $request->only(['firstname', 'lastname', 'gender', 'marital_status', 'mobile_number', 'email_address', 'skype_account', 'street_address', 'city', 'province', 'country']);
        $input['birthdate'] = date_create_immutable_from_format('Y-n-j', $request->input('birthdate'))->format('Y-m-d');
        $input['password'] = bcrypt($request->input('password'));

        if($isGuest){
            $user = User::create($input);
            Auth::loginUsingId($user->id);
        }else{
            User::where('id', Auth::user()->id)->update($input);
        }

        return response()->json([
            'result' => TRUE,
        ]);
        
    }

    function savePartTwo(Request $request)
    {

        $user = Auth::user();

        $rules = [
            'exp.*.name' => 'required_if:exp.*.experience_type,ESL',
            'exp.*.position' => 'required_if:exp.*.experience_type,ESL',
            'exp.*.location' => 'required_if:exp.*.experience_type,ESL',
            'exp.*.years' => 'numeric|required_if:exp.*.experience_type,ESL',
            'exp.*.months' => 'numeric|required_if:exp.*.experience_type,ESL',
            'exp.*.experience_type' => 'required_with:exp.*.position,exp.*.location,exp.*.years,exp.*.name|in:ESL,CC',
            'exp.*.id' => 'exists:user_experiences,id,user_id,'.Auth::user()->id
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'result' => FALSE,
                'errors' => $validator->errors()
            ]);
        }

        $input = $request->input('exp');
        
        $updated = [];
        $new = [];

        foreach($input AS $row){
            if(isset($row['name']) && trim($row['name'])){
                $temp = array_only($row, ['name', 'location', 'position', 'years', 'months', 'experience_type']);
                if(isset($row['id'])){
                    $updated[$row['id']] = $temp;
                }else{
                    $new[] = new Experience($temp);
                }
            }
        }

        if(count($updated)){
            $user->experiences()->whereNotIn('id', array_keys($updated))->delete();
            foreach($updated AS $id => $data){
                $exp = Experience::find($id);
                $exp->update($data);
            }
        }else{
            $user->experiences()->delete();
        }

        if(count($new)){
            $user->experiences()->saveMany($new);
        }

        return response()->json([
            'result' => TRUE,
        ]);
    }
}
