<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware( ['role:super-admin|admin']);
    }
    //
    function dashboardIndex(){
        return view('backend.dashboard');
    }
}
