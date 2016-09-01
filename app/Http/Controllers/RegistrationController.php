<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Http\Requests;

use App\User;
use Auth;
use App\UserExperience AS Experience;
use App\UserPreference AS Preference;
use DB;

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

        $experiences = Auth::user()->experiences()->get();

        foreach($experiences AS $row){
            if($row->experience_type === 'ESL'){
                    $eslExp[] = $row;
            }else{
                $ccExp[] = $row;
            }
        }

        return view('blocks.registration.second', compact(['eslExp', 'ccExp']));
    }

    function partThree()
    {
        $preference = Auth::user()->preference()->first();
        return view('blocks.registration.third', compact('preference'));
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
        $input['account_type'] = User::ACCOUNT_TYPE_TEACHER;

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

    function savePartThree(Request $request)
    {

        // ini_set('post_max_size', '2GB'); 

        $user = Auth::user();
        // return response()->json($request->all());

        $validator = Validator::make($request->all(), [
            'work_schedule' => 'required|in:MORNING,AFTERNOON,EVENING,MIDNIGHT',
            'demo_day' => 'required|in:MON,TUE,WED,THU,FRI,SAT,SUN',
            'demo_time' => 'required|max:20',
            'certifications' => 'image|max:2048',
            'display_photo' => 'required|image|max:2048',
            'internet_speed_screenshot' => 'required|image|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => FALSE,
                'errors' => $validator->errors()
            ]);
        }else{

            $data = $request->only(['work_schedule', 'demo_day', 'demo_time']);
            $uploads = [];

            // if($request->hasFile('certifications')){
            //     foreach($request->file('certifications') AS $file){
            //         $certificatesFilename = uniqid().'.'.$file->getClientOriginalExtension();
            //         $uploads['certifications'][] = $certificatesFilename;
            //         $file->move("public/img/{$user->id}/certifications", $certificatesFilename);
            //     }
            //     $data['certificates_filename'] = json_encode($uploads['certifications']);
            // }

            if($request->hasFile('display_photo')){
                $dp = $request->file('display_photo');
                $dpFilename = uniqid().'.'.$dp->getClientOriginalExtension();
                $uploads['display_photo'][] = $dpFilename;
                $dp->move("uploads/{$user->id}/display", $dpFilename);
                $data['display_photo_filename'] = $dpFilename;
            }

            if($request->hasFile('internet_speed_screenshot')){
                $speedtest = $request->file('internet_speed_screenshot');
                $speedtestFilename = uniqid().'.'.$speedtest->getClientOriginalExtension();
                $uploads['internet_speed_screenshot'][] = $speedtestFilename;
                $speedtest->move("uploads/{$user->id}/speedtest", $speedtestFilename);
                $data['internet_speed_screenshot_filename'] = $speedtestFilename;
            }

            if($user->preference()->exists()){
                $user->preference()->update($data);
            }else{
                $user->preference()->save(new Preference($data));
            }

             return response()->json([
                'result' => TRUE,
                'data' => $data
            ]);

        }

    }
}
