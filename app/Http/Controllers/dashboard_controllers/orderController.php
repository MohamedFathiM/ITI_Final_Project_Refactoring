<?php

namespace App\Http\Controllers\dashboard_controllers;
use App\Order;
use DB;
use App\Product;
use App\User;
use App\Cart;
use App\Checkout;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      $checkout = DB::table('checkouts')->get();
      $orders   = Order::All();
      return view('dash_pages.pages.Comments&Orders.order' , compact('orders' ,'checkout'));
    }

    
    //save the orders 
    public function store(Request $request)
    {
        if(\Auth::check()){
            $products = Cart::where('user_id',auth()->user()->id)->get()->count();
            if($products>0 ){
                $input = $request -> all();
                $validatedData = $request->validate([
                    'fname' => 'required',
                    'lname' => 'required',
                    'address' => 'required',
                    'city' => 'required|max:2048',
                    'zipCode' => 'required|max:2048',
                    'phoneNumber' => 'required|max:2048',
                    'comment'=> 'required|max:2048' ,
                    'email'=> 'required|max:2048' ,
                    'totalprice'=> 'required|max:2048' ,
                ]);

                $orders = new Order();
                $orders['User_id'] = \Auth::id();
                $orders['first_name'] = $input['fname'];
                $orders['second_name'] = $input['lname'];
                $orders['address'] = $input['address'];
                $orders['country'] = $input['city'];
                $orders['zipCode'] = $input['zipCode'];
                $orders['phoneNumber'] =$input['phoneNumber'];
                $orders['comment'] =$input['comment'];
                $orders['email'] =$input['email'];
                $orders['status']=0;
                $orders['totalprice'] =$input['totalprice'];

                $orders -> save();

                Cart::where('User_id' , \Auth::id())->delete();
       

                return back()
                ->with('OrderMessage',' Successfully added');
            }
            else{
                return back()
                ->with('OrderMessage',' Failed added check your Cart');
            }
}}
   

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
        $orders= Order::findOrFail($id);
        $orders['status']=$input['status'];
        $orders->fill($input)->save();
        return back();    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders=Order::find($id);
        $orders->delete();
        return back();
    }
    }

