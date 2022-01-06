<?php

namespace App\Http\Controllers\dashboard_controllers;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Addproductscontroller extends Controller
{
    //name , description,image1,image2,image3,price,color,category
    public function image($file){
            
            $extention = $file->getClientOriginalExtension();
            $sha1 = sha1($file->getClientOriginalName());
            $filename  = time().'_'.$sha1.'.'.$extention;
            $file->move('img/product-img/',$filename);
            return $filename;
    }

    public function store(Request $request)
    {
        $input = $request -> all();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:5',
        ]);
       
       $products = new Product();
       $products['name'] = $input['name'];
       $products['description'] = $input['description'];
       $products['image1'] = $this::image($input['image1']);
       $products['image2'] = $this::image($input['image2']);
       $products['image3'] = $this::image($input['image3']);
       $products['price'] = $input['price'];
       $products['color'] =$input['color'];
       $products['user_id'] = '1';
       $products['rating'] = '0.00';

       $products['category_id'] = $input['category']; 
       $products -> save();
       return back()
       ->with('message',' Successfully added');
    
    }
}
