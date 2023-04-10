<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(){
        return view('frontend.userdashboard.dashboard');
    }

    public function userOrder(){
        return view('frontend.userdashboard.orders');
    }

    public function downloadInvoice($id){
        $order = Order::with('invoice')->find($id);
        return response()->download(public_path('storage/invoice/'). $order->invoice->invoice);
    }
}
