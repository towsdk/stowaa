<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $products = Product::select('id','slug', 'title', 'short_description', 'price', 'sale_price', 'image')->orderBy('id', 'desc')->paginate(30);
        return view('frontend.shop.index', compact('products'));
    }
    public function shopDetails($slug){
        $product = Product::with('galleries', 'inventories.size')->where('slug', $slug)->firstOrfail();
        
        $size = Inventory::where('product_id', $product->id)->get();
        $sizeOf = $size->unique(function($item){
            return $item['size_id'];
        });

        $user_order_check = [];
        
        // return auth()->user()->orders;
        $user = User::where('id', auth()->user()->id)->with(['orders' => function($q){
            $q->with('inventory_orders.inventory');
        }])->first();

        // return $user;

        foreach($user->orders as $order){
            $user_order_check = array_merge($user_order_check, $order->inventory_orders->pluck('product_id')->toArray());
        }
       
        // return $user_order_check;
        $user_order_check = array_unique($user_order_check);
        return view('frontend.shop.details', compact('product','sizeOf', 'user_order_check'));
    }
    public function shopColor(Request $request){
        $inventories = Inventory::where('product_id', $request->product_id)->where('size_id', $request->size_id)->get();
        $ex_color = $inventories->pluck('color_id')->toArray();
        $colors = Color::whereIn('id', $ex_color)->get();

        $options = ["<option>Select Color </option>"];
        foreach($colors as $color){
            $options[] = "<option value='".$color->id."'>".$color->name ."</option>";
        }  
        return response()->json($options);
    }

    public function selectSizeColor(Request $request){
        $inventory = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first();
        
        $product = $inventory->product;

        if($product->sale_price != null){
            $original_price = $product->sale_price + $inventory->additional_price;
        }else{
            $original_price = $product->price + $inventory->additional_price;
        }

        $data = [
            "id" => $inventory->id,
            "quantity" => $inventory->quantity,
            "original_price" => $original_price,
        ];
        return response()->json($data);
    }
}
