<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //

    public function index()
    {
        // toastr()->info('Welcome Your Profile');
        return view('frontend.dashboard.dashboard');
    }
}
