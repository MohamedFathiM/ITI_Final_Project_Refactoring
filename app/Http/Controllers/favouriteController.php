<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
class favouriteController extends Controller
{
   public function index(){
        $products = Product::where('rating','>=','4')->get();
        return view('Webpages.favourite',['products'=>$products]);
       
    }
}
