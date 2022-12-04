<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function login(){
        return view('userauth.userauth');
    }
    public function registation(){
        return view('userauth.userauth');
    }
}
