<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Auth;

class ProfileController extends Controller
{
    function showProfile()
    {
        $user = Auth::user();

        $profileProgress = $user->getProfileProgress();
        
        $preference = $user->preference();

        $displayPhoto = asset('images/display-photo-placeholder.png');

        if($preference->exists()){
            $displayPhoto = asset("uploads/{$user->id}/display/{$preference->first()->display_photo_filename}");
        }

        return view('profile', compact(['user', 'profileProgress', 'displayPhoto']));
    }
}
