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
        $displayPhoto = $preference->exists() ? $preference->first()->display_photo_filename : asset('images/display-photo-placeholder.png');

        return view('profile', compact(['user', 'profileProgress', 'displayPhoto']));
    }
}
