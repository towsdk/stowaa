<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Storage;
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
     $products = Product::with(['categories:id,name'])->select('id','title','slug','image','status','created_at')->orderBy('id','desc')->paginate(20);
     $trashedProducts = Product::onlyTrashed()->with(['categories:id,name'])->select('id','title','slug','image','status','created_at')->orderBy('id','desc')->paginate(20);
     return view('backend.product.index', compact('products','trashedProducts'));
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

        $galleries = $request->file('gallery');

        $request->validate([
            'title'=>'required|unique:products,title',
            'category_id'=>'required',
            'sku_code'=>'required',
            'short_description'=> 'required',
            'price'=>'required|integer',
            'sale_price'=> 'nullable|integer',
            'description'=> 'nullable',
            'add_info'=> 'nullable',
            'image'=> 'required|mimes:png,jpg,jpeg,svg,webp',
            'currency'=> 'required',
            'gallery.*'=>'nullable|mimes:jpg,jpeg,png,svg,webp',
        ]);

        if($request->file('image')){
                $image_name = Str::uuid().'.'.$request->image->extension();
                Image::make($request->image)->crop(800, 609)->save(public_path('storage/product/'.$image_name, 90));
    
           $product = Product::create([
                'title'=>$request->title,
                // 'slug'=>Str::slug($request->title),
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

            if($galleries){
                foreach($galleries as $gallery){
                    $gallery_img = Str::uuid().'.'.$gallery->extension();
                    Image::make($gallery)->crop(800, 609)->save(public_path('storage/product/'.$gallery_img));
                    ProductGallery::create([
                        'product_id'=> $product->id,
                        'image'=> $gallery_img,

                    ]);
                }
            }
            $product->categories()->attach($request->category_id);
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
        $categories = Category::all();
        return view('backend.product.edit', compact('categories','product'));
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
        $img = $request->file('image');
        $request->validate([
            'title'=>'required|unique:products,title,'.$product->id,
            'category_id'=>'required',
            'sku_code'=>'required',
            'short_description'=> 'required',
            'price'=>'required|numeric',
            'sale_price'=> 'nullable|numeric',
            'description'=> 'nullable',
            'add_info'=> 'nullable',
            'image'=> 'nullable|mimes:png,jpg,jpeg,svg,webp',
            'currency'=> 'required',
        ]);

        if($img){

            if(file_exists(public_path('storage/product/'.$product->image))){
                Storage::delete('product/'.$product->image);
            }

                $image_name = Str::uuid().'.'.$request->image->extension();
                Image::make($request->image)->crop(800, 609)->save(public_path('storage/product/'.$image_name, 90));
        }else{
            $image_name = $product->image;
        }

           $product->update([
                'title'=>$request->title,
                'sku_code'=>$request->sku_code,
                'short_description'=>$request->short_description,
                'price'=>$request->price,
                'sale_price'=>$request->sale_price,
                'description'=>$request->description,
                'add_info'=> $request->add_info,
                'image'=> $image_name,
                'currency'=> $request->currency,
            ]);

            $product->categories()->sync($request->category_id);

            return back()->with('success', 'Product update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->update([
            'status'=> 0,
        ]);
        $product->delete();
        return back()->with('success', 'product delete successfully');
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->update([
            'status'=> 1,
        ]);
        $product->restore();
        return back()->with('success', 'product restore successfully');
    }
    public function permanentDelete($id)
    {
        $product = Product::onlyTrashed()->find($id);

        if(file_exists(public_path('storage/product/'.$product->image))){
            Storage::delete('product/'. $product->image);
        }

        foreach($product->galleries as $gallery){
            if(file_exists(public_path('storage/product/'.$gallery->image))){
                Storage::delete('product/'. $gallery->image);
            }
        }
        $product->categories()->detach();
        $product->forceDelete();
        return back()->with('success', 'product permanent delete successfully');
    }
}
