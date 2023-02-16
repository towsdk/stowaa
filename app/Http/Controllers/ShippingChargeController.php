<?php

namespace App\Http\Controllers;

use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function index(){
        $shippings = ShippingCharge::all();
        return view('backend.shipping_charge.index', compact('shippings'));
    }

    public function store(Request $request){
        $request->validate([
            'location' => 'required',
            'charge' => 'required|integer',
        ]);

        ShippingCharge::create([
            "location" => $request->location,
            "charge" => $request->charge,
        ]);

        return back()->with('success', 'Shipping address added');
    }
}


