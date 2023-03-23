<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(){
        return view('frontend.userdashboard.dashboard');
    }

    public function userOrder(){
        return view('frontend.userdashboard.orders');
    }
}
