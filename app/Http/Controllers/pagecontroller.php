<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Category;
use App\Product;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class pagecontroller extends Controller
{
    //Select All Categories for index page 
    public function index(){
        $cats = DB::table('categories') ->get();
        return view('Webpages.index',compact('cats'));
    }



    //View the checkout page 
    public function checkout(){
        if(\Auth::check()){
             return view('Webpages.checkout');
        }else{
             return redirect('login');
        }
    }


    //View the productDetails and its comments 
    public function product($id){
        $comments = Comment::where('product_id',$id )->paginate(3);
        $product = Product::findOrFail($id);
        return view('Webpages.product-details',compact('id' ,'product' , 'comments'));
    }

  
        //Function for Rating Start System
    public function RateFun(Request $request){
        if(isset($request['rateBtn'])){
            if(\Auth::check() && $request -> rate){
                
                $product = Product::find($request->id);
                $product ->rating = $request ->rate;
                $product -> save();
                //package for ratings 
                $rating = new \willvincent\Rateable\Rating;
                $rating->rating = $request->rate;
                $rating->user_id = auth()->user()->id;
                $product->ratings()->save($rating);
                return redirect()->route("product",$request->id);

            }else{
                    return redirect("login");
            }
        }else{
            return redirect()->route("product",$request->id);
        }
    }



    //store the users comments 
    public function storeComment(Request $request){
        if(\Auth::check()){
            $validatedData = $request->validate([
                'description' => 'required'
            ]);
            $product = Product::find($request->id);
            $comments=new Comment();
            $comments['description']=$request->input('description');
            $comments['status']=1;
            $comments['product_id']=$request->input('product_id');
            $comments['user_id']= \Auth::id();
            $comments->save();
            return back();
        }else{
            return redirect("login");

        }

    } 

 
}
