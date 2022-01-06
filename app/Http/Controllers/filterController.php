<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class filterController extends Controller
{
     //Filterations Categories 
     public function sort( Request $request,$id){
        $input = $request -> all();

            /*Display products by view  */
            /*switch on request which has values 12 , 24 , 48 and 96 */
        switch(@$input['select']){
            case 12 :
                $value = 12 ;
                break;
            case 24 :
                $value = 24 ;
                break;
            case 48 :
                $value = 48;
                break;
            case 96 :
                $value = 96 ;
                break;
            default :
                $value = 12;
        }

        //Test the values of price 
        if(isset($input['min'])){
            $minPrice = @$input['min'] ; 
            $maxPrice = @$input['max'] ;
        }else{
            $minPrice = 10 ; 
            $maxPrice =1000 ;
        }

        //Test the values of color 
        if(isset($input['color'])){
            $color= $input['color'];
        }else{
            $color = '%';
        }
    
                 /*Display products by view  and sort by */
            /*switch on request which has values date ,newest and popular */
                
            switch (@$input['sortSelect']){
                    //if user select Date 
                    case 'Date' :
                        $SortedValue = 'Date';
                        $product = Product::where('category_id',$id)->where('price','>=',$minPrice)->where('price','<=',$maxPrice)->where('color','LIKE',$color)->orderBy('id','asc')->paginate(@$value);
                        return view('Webpages.shop',['id'=>Category::findOrFail($id),'products'=>@$product , 'SortedValue'=>@$SortedValue,'value'=>@$value,'minPrice'=>$minPrice,'maxPrice'=>$maxPrice,'color'=>$color]);
                        break;

                    //if user select Newest 
                    case 'Newest' :
                        $SortedValue = 'Newest';
                        $product = Product::where('category_id',$id)->where('price','>=',$minPrice)->where('price','<=',$maxPrice)->where('color','LIKE',$color)->orderBy('id','desc')->paginate(@$value);
                        return view('Webpages.shop',['id'=>Category::findOrFail($id),'products'=>@$product , 'SortedValue'=>@$SortedValue,'value'=>@$value,'minPrice'=>$minPrice,'maxPrice'=>$maxPrice,'color'=>$color]);
                        break;

                    //if user select Popular                     
                    case 'Popular' :
                        $SortedValue = 'Popular';
                        $product = Product::where('category_id',$id)->where('price','>=',$minPrice)->where('price','<=',$maxPrice)->where('color','LIKE',$color)->orderBy('rating','desc')->paginate(@$value);
                        return view('Webpages.shop',['id'=>Category::findOrFail($id),'products'=>@$product , 'SortedValue'=>@$SortedValue,'value'=>@$value,'minPrice'=>$minPrice,'maxPrice'=>$maxPrice,'color'=>$color]);
                        break; 
                    
                    //The default page or 'select All' button
                    default:
                        $product = Product::where('category_id',$id)->where('price','>=',10)->where('price','<=',1000)->orderBy('id','asc')->paginate(12);
                        return view('Webpages.shop',['id'=>Category::findOrFail($id),'products'=>@$product , 'SortedValue'=>'Date','value'=>12 ,'minPrice'=>$minPrice,'maxPrice'=>$maxPrice]);
                
                    }
        
                
    }
}
