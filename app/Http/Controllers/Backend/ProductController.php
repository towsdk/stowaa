<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.create', compact('categories'));
   
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
            'title'=>'required',
            'category_id'=>'required',
            'sku_code'=>'required',
            'short_description'=> 'required',
            'price'=>'required|integer',
            'sale_price'=> 'nullable|integer',
            'description'=> 'nullable',
            'add_info'=> 'nullable',
            'image'=> 'required|mimes:png,jpg,jpeg',
            'currency'=> 'required',
        ]);

        if($request->file('image')){
                $image_name = Str::uuid().'.'.$request->image->extension();
                Image::make($request->image)->crop(800, 609)->save(public_path('storage/product/'.$image_name, 90));
    
           $products = Product::create([
                'title'=>$request->title,
                'slug'=>Str::slug($request->title),
                'user_id'=>auth()->user()->id,
                'sku_code'=>$request->sku_code,
                'short_description'=>$request->short_description,
                'price'=>$request->price,
                'sale_price'=>$request->sale_price,
                'description'=>$request->description,
                'add_info'=> $request->add_info,
                'image'=> $image_name,
                'currency'=> $request->currency,
            ]);

            $products->categories()->attach($request->category_id);
            return back()->with('success', 'Product upload successfully');
        }else{
            return back()->with('error', 'Product not uploaded');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
