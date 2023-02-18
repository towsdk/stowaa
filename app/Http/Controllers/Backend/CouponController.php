<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view('backend.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|unique:coupons,name',
            "discount" => 'required|integer',
            "limit" => 'required|integer',
            "expiry_date" => 'required|date',
        ]);

        Coupon::create([
            "name" => $request->name,
            "discount" => $request->discount,
            "limit" => $request->limit,
            "expiry_date" => $request->expiry_date,
        ]);

        return back()->with('success', 'Coupon add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
    public function applyCoupon(Request $request)
    {
        $carts = Cart::where('user_id', auth()->user()->id);
        $coupon = Coupon::where('status', 1)->where('name', $request->coupon)->first();
        
        if($coupon->expiry_date < now()){
            return back()->with('warning', 'Coupon date expired');
        }else if($carts->sum('sub_total') < (int) $coupon->limit){
            return back()->with('warning', 'Cart not applicable for this amount');
        }else{
            $coupon = [
                'couponName'=> $coupon->name,
                'amount'=> $coupon->discount,
            ];

            Session::put('coupon', $coupon);
            return back();
        }
    }
}
