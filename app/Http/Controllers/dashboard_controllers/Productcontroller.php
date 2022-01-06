<?php

namespace App\Http\Controllers\dashboard_controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::All();
        return view('dash_pages.pages.Categories&Products.Products' , compact('products'));
    }


    public function image($file){
            
        $extention = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $filename  = time().'_'.$sha1.'.'.$extention;
        $file->move('img/product-img/',$filename);
        return $filename;
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product ,$id)
    {
        $products=Product::find($id);
        return view('dash_pages.pages.Categories&Products.editeProduct' , compact('products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:5|max:10000',
            'image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $oldPro = Product::find($id);
        
        $products=Product::find($id);
        $products['name'] = request('name');
        $products['description'] = request('description');
           
      
            if( request('image1')){
                $products['image1'] = $this::image($request['image1']);
               }else{
                   $products['image1'] = $oldPro['image1'];
               }

               if( request('image2')){
                $products['image2'] = $this::image($request['image2']);
               }else{
                   $products['image2'] = $oldPro['image2'];
               }

               if( request('image3')){
                $products['image3'] = $this::image($request['image3']);
               }else{
                   $products['image3'] = $oldPro['image3'];
               }
            
           $products['price'] = request('price');
           $products['rating'] = $oldPro['rating'];
           $products['color'] =request('color'); 
           $products['user_id'] =request('user'); 
           $products['category_id'] =request('category'); 
            $products -> save();
    
       return redirect('dashboard/Products')
       ->with('message',' Successfully Edit ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product ,$id)
    {
        $products = Product::findOrFail($id);
       $products->delete();
        return back();
    }
    }

