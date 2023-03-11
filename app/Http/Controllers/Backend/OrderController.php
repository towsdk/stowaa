<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->all()) {
            $orders = Order::where(function ($query) use ($request) {
                if ($request->order_id) {
                    $query->where('id', 'LIKE', '%' . $request->order_id . '%');
                }
                if ($request->order_status) {
                    $query->where('order_status',$request->order_status );
                }
                if ($request->payment_status) {
                    $query->where('payment_status',$request->payment_status );
                }
                if ($request->from_date) {
                    $query->whereDate('created_at','>=', Carbon:: createFromFormat('Y-m-d', $request->from_date) );
                    
                }
                if ($request->from_date && $request->to_date) {
                    $query->whereBetween('created_at',[Carbon:: createFromFormat('Y-m-d', $request->from_date), Carbon::createFromFormat('Y-m-d', $request->to_date)] );
                }
            })
                ->orderBy('created_at', 'desc')->select('id', 'total', 'order_status', 'payment_status', 'created_at')
                ->paginate(10)
                ->withQueryString();
        } else {

            $orders = Order::orderBy('created_at', 'desc')->select('id', 'total', 'order_status', 'payment_status', 'created_at')->paginate(10);
        }
        return view('backend.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
       $singleOrder = Order::where('id', $order->id)->with('inventory_orders.inventory.product', 'inventory_orders.inventory.color', 'inventory_orders.inventory.size')->first();
    //    return $singleOrder;
        return view('backend.order.show',compact('singleOrder'));
    }
}
