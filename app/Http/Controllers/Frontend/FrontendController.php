<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //creating a funcion for frontendIndex
    function frontendIndex(){
        return view('frontend.index');
    }
}
