<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RegistrationController extends Controller
{
    function partOne()
    {
        return view('blocks.registration.first');
    }

    function savePartOne(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'birthmonth' => 'required|in[]' 
        ]);
    }
}
