<?php

namespace App\Http\Controllers;
use App\Subscribe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribController extends Controller
{

    public function index(){
        if(\Auth::check() && \Auth::user()->role==0){
            $subscribes=Subscribe::all();
            return view('dash_pages.pages.Subscribers' , compact('subscribes'));
        }else{
            return redirect()->route('login');
        }
    }



    public function store(Request $request){
        $validatedData = $request->validate([
            'email' => 'required'
        ]);
        $input = $request->all();
        $subscribe = new Subscribe();
       if( $subscribe['email']=$request->input('email')){
        return back()->with('message' , 'You are realy subscribed');
       }else{

        $subscribe['email']=$request->input('email');
        $subscribe->save();
        return back()->with('message' , 'Thank for Subscribe we will send you any offers soon');
    }

    }
}
