<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $products = Product::select('id','slug', 'title', 'short_description', 'price', 'sale_price', 'image')->orderBy('id', 'desc')->paginate(30);
        return view('frontend.shop.index', compact('products'));
    }
    public function shopDetails($slug){
        $product = Product::with('galleries', 'inventories.size', 'inventories.color')->where('slug', $slug)->firstOrfail();
        return view('frontend.shop.details', compact('product'));
    }
    public function shopColor(Request $request){
        $inventories = Inventory::where('product_id', $request->product_id)->where('size_id', $request->size_id)->get();
        $ex_color = $inventories->pluck('color_id')->toArray();
        $colors = Color::whereIn('id', $ex_color)->get();

        $options = [];
        foreach($colors as $color){
            $options[] = "<option value='".$color->id."'>".$color->name ."</option>";
        }  
        return response()->json($options);
    }
}
