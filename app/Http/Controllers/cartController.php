<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;
use App\Checkout;
use App\Product;
use App\Http\Controllers\Auth;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()){
            $products = Cart::where('user_id',auth()->user()->id)->get();
            return view('Webpages.cart',compact('products'));
        }else{
            return redirect('login');
        }
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
    
        if(\Auth::check()){
        $input = $request->all();
        $oldcart = Cart::where('product_id',($input['productID']))->where('user_id',\Auth::id())->first();
        if(!isset($input['quantity'])){
            $input['quantity'] = 1 ;
        }

        if($input['productID'] == $oldcart['product_id']){
            $oldcart['user_id'] = \Auth::id();
            $oldcart['qauntity'] =  $oldcart['qauntity'] + $input['quantity'];
            $oldcart ->save();            
        }else{
            $cart = new Cart();
            $product = Product::find($input['productID']);
            $cart['qauntity'] = $input['quantity'];
            $cart['image'] = $product->image1;
            $cart['name'] = $product->name;
            $cart['price'] = $product->price;
            $cart['product_id'] = $product->id;
            $cart['user_id'] = \Auth::id();
            $cart -> save();
        }

        // checkouts

        $input = $request->all();
        $oldcartt = Checkout::where('product_id',($input['productID']))->where('user_id',\Auth::id())->first();
        if(!isset($input['quantity'])){
            $input['quantity'] = 1 ;
        }

        if($input['productID'] == $oldcartt['product_id']){
            $oldcartt['user_id'] = \Auth::id();
            $oldcartt['qauntity'] =  $oldcartt['qauntity'] + $input['quantity'];
            $oldcartt ->save();            
        }else{
            $cartt = new Checkout();
            $product = Product::find($input['productID']);
            $cartt['qauntity'] = $input['quantity'];
            $cartt['image'] = $product->image1;
            $cartt['name'] = $product->name;
            $cartt['price'] = $product->price;
            $cartt['product_id'] = $product->id;
            $cartt['user_id'] = \Auth::id();
            $cartt -> save();
        }
        return  back();;
    }else{
    return redirect('login');
}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    $input = $request->all();
     $cart = Cart::findOrFail($id);
     $cart['qauntity'] = $input['quantity'];
     $cart ->save();
     return back(); 

     $cartt = Checkout::findOrFail($id);
     $cartt['qauntity'] = $input['quantity'];
     $cart ->save();
     return back();  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::where('product_id',$id)->delete();
        Checkout::where('product_id',$id)->delete();
        return back();
   
    }
}
