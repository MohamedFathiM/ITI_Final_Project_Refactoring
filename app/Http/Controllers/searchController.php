<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class searchController extends Controller
{
     //Function For Search Button 
     public function mysearch(Request $request){
        $q=$request->get('q');
        $productName = DB::table('products')->where('name','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->get();
   
        if(count($productName) > 0)
        {
            return view('Webpages.search')->with('productName',$productName)->withQuery($q);
        }
        else 
        {
            return view ('Webpages.search')->withMessage('No Details found. Try to search again !');
        
        }
    
    }

}
