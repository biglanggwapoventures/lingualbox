<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AboutUsController extends Controller
{
    function index()
    {
        return view('blocks.about-us');
    }
}
