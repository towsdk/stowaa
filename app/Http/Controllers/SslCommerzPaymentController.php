<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\UserInfo;
use App\Models\Inventory;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use App\Models\InventoryOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function index(Request $request)
    {

     
        $request->validate([
            "billing_phone" => 'required',
            "billing_address_1" => 'required',
            "billing_city" => 'required',
            "billing_postcode" => 'nullable',
            "billing_notes" => 'nullable'
            
        ]);

        UserInfo::updateOrCreate([
            'user_id' => auth()->user()->id,
        ],[
            'user_id' => auth()->user()->id,
            "phone" => $request->billing_phone,
            "address" => $request->billing_address_1,
            "city" => $request->billing_city,
            "zip" => $request->billing_postcode,
            "notes" => $request->billing_notes,

            // "phone" => $request->get("billing_phone"),
            // "address" => $request->get("billing_address_1"),
            // "city" => $request->get("billing_city"),
            // "zip" => $request->get("billing_postcode"),
            // "notes" => $request->get("billing_notes"),
        ]);

          //carts information
          $carts = Cart::where('user_id', auth()->user()->id)->get();
          $sub_total = 0;
          foreach($carts as $cart){
  
              if($cart->cart_quantity > $cart->inventory->quantity){
                  return back()->with('error', "stock out");
              }
              $price = (($cart->inventory->product->sale_price ?? $cart->inventory->product->price) + $cart->inventory->additional_price ?? 0 ) * $cart->cart_quantity;

              $sub_total += $price;
          }
                if (Session::has('shipping_charge') && Session::has('coupon')) {
                    $grand_total = $sub_total + Session::get('shipping_charge') - Session::get('coupon')['amount'];
                } else {
                    $grand_total = $carts->sum('sub_total') + Session::get('shipping_charge');
                }
                

        // return back()->with('success', "Shipping Insert successful");

        $post_data = array();
        $post_data['total_amount'] = $grand_total;
        $post_data['currency'] = "USD";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

      
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = auth()->user()->name;
        $post_data['cus_email'] = auth()->user()->email;
        $post_data['cus_add1'] = auth()->user()->user_info->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = auth()->user()->user_info->city;
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = auth()->user()->user_info->zip ?? '';
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = auth()->user()->user_info->phone ?? '';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        // inserting order table
        $insert_order = Order::create([
            'user_id' => auth()->user()->id,
            'transaction_id' => $post_data['tran_id'],
            'coupon_name' => Session::get('coupon')['name'] ?? null,
            'coupon_amount' => Session::get('coupon')['amount'] ?? 0,
            'shipping_charge' => Session::get('shipping_charge'),
            'total' => $post_data['total_amount'],
            'order_note' => $request->billing_notes,
            'order_status' => 'Pending',
            'payment_status' => 'Unpaid',
        ]);

        if ($insert_order) {
            foreach ($carts as $cart) {
                InventoryOrder::create([
                    'order_id' => $insert_order->id,
                    'inventory_id' => $cart->inventory_id,
                    'order_quantity' => $cart->cart_quantity,
                    'order_amount' => ($cart->inventory->product->sale_price ?? $cart->inventory->product->price) + $cart->inventory->additional_price ?? 0,
                    'additional_amount' => $cart->inventory->additional_price ?? null,
                ]);
            }
        }
       
            if ($request->ship_to_different_address && $insert_order) {
                    $request->validate([
                        "shipping_name" => 'required',
                        "shipping_phone" => 'required',
                        "shipping_address" => 'required',
                        "shipping_address" => 'required',
                        "shipping_city" => 'required',
                        "shipping_postcode" => 'nullable',
                        "shipping_notes" => 'nullable'
                    ]);
                    ShippingInfo::create([
                        "user_id" => auth()->user()->id,
                        "order_id" => $insert_order->id,
                        "name" => $request->shipping_name,
                        "phone" => $request->shipping_phone,
                        "address" => $request->shipping_address,
                        "city" => $request->shipping_city,
                        "zip" => $request->shipping_postcode,
                        "notes" => $request->shipping_notes,
                    ]);
              }

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
        // return back()->with('success', "Shipping Insert successful");

    }


    public function success(Request $request)
    {
    
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = Order::where('transaction_id', $tran_id)
            ->select('id', 'transaction_id', 'order_status', 'total', 'payment_status','created_at', 'coupon_name', 'coupon_amount', 'shipping_charge')->first();
        $orderInventories = InventoryOrder::where('order_id', $order_details->id)->get();        

        if ($order_details->order_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount);

            if ($validation) {

                $order_details->update([
                    'order_status' => 'Processing',
                    'payment_status' => 'Paid'
                ]);
                
                foreach ($orderInventories as $orderInventory) {
                    Inventory::where('id', $orderInventory->inventory_id)->decrement('quantity',$orderInventory->order_quantity);

                    Cart::where('inventory_id',$orderInventory->inventory_id)
                    ->where('user_id', auth()->user()->id)->delete();
                }
                $request->session()->forget([ 'coupon', 'shipping_charge' ]);

                $pdf = Pdf::loadView('invoice.orderinvoice', compact('order_details', 'orderInventories'));
                $pdf->save(public_path('storage/invoice/'. $order_details->id."_invoice.pdf"));
                $pdf_path= url('/') . '/storage/invoice/' . $order_details->id . "_invoice.pdf";
                /* return $pdf->download('invoice.pdf'); */
                Invoice::create([
                    'order_id'=> $order_details->id,
                    'invoice_path'=> $pdf_path ,
                    'invoice'=> $order_details->id . "_invoice.pdf",
                ]);

                return redirect(route('frontend.shop.index'))->with('success', 'Transaction Successful!');
            }
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
            return redirect(route('frontend.shop.index'))->with('success', 'Transaction Successful!');
        } else {

            return back()->with('error', 'Invalid Transaction');
        }

        
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');


        $order_details = Order::where('transaction_id', $tran_id)
            ->select('id', 'transaction_id', 'order_status', 'total', 'payment_status')->first();


        if ($order_details->order_status == 'Pending') {            

                $order_details->update([
                    'order_status' => 'Failed',
                ]);
                $request->session()->forget([
                    'coupon', 'shipping_charge'
                ]);
                return redirect(route('frontend.shop.index'))->with('error', 'Transaction Failed!');
            
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
            return redirect(route('frontend.shop.index'))->with('success', 'Transaction Successful!');
        } else {

            return back()->with('error', 'Invalid Transaction');
        }


    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order_details = Order::where('transaction_id', $tran_id)
            ->select('id', 'transaction_id', 'order_status', 'total', 'payment_status')->first();


        if ($order_details->order_status == 'Pending') {



            $order_details->update([
                'order_status' => 'Canceled',
            ]);
            $order_details = Order::where('transaction_id', $tran_id)->first();
            InventoryOrder::where('order_id', $order_details->id)->delete();
            $order_details->delete();
            
            $request->session()->forget([
                'coupon', 'shipping_charge'
            ]);
            return redirect(route('frontend.shop.index'))->with('error', 'Transaction Canceled!');
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
            return redirect(route('frontend.shop.index'))->with('success', 'Transaction Successful!');
        } else {

            return back()->with('error', 'Invalid Transaction');
        }


    }

    public function ipn(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');

        $sslc = new SslCommerzNotification();


        $order_details = Order::where('transaction_id', $tran_id)
            ->select('id', 'transaction_id', 'order_status', 'total', 'payment_status')->first();
        $orderInventories = InventoryOrder::where('order_id', $order_details->id)->get();


        if ($order_details->order_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount);

            if ($validation) {

                $order_details->update([
                    'order_status' => 'Processing',
                    'payment_status' => 'Paid'
                ]);

                foreach ($orderInventories as $orderInventory) {
                    Inventory::where('id', $orderInventory->inventory_id)->decrement('quantity', $orderInventory->order_quantity);

                    Cart::where('inventory_id', $orderInventory->inventory_id)
                        ->where('user_id', Auth::user()->id)
                        ->delete();
                }
                $request->session()->forget([
                    'coupon', 'shipping_charge'
                ]);
                return redirect(route('frontend.shop.index'))->with('success', 'Transaction Successful!');
            }
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
            return redirect(route('frontend.shop.index'))->with('success', 'Transaction Successful!');
        } else {

            return back()->with('error', 'Invalid Transaction');
        }
    }

}
