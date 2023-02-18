<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Session;

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

    public function applyCharge(Request $request){
        $shippingCharge=ShippingCharge::where('id', $request->location_id)->first();
        Session::put('shipping_charge', $shippingCharge->charge);
        return response()->json($shippingCharge);
    }


}


