<?php

namespace App\Http\Controllers\dashboard_controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardrouts extends Controller
{
    
    /* View the index page */
    public function index()
    {
        return  view('dash_pages.index');        
    }


    /* View the errors pages */

    public function page404()
    {
        return view('dash_pages.pages.Extra.404');
    }
    public function page500()
    {
        return view('dash_pages.pages.Extra.500');
    }
   

    public function login()
    {
        return view('dash_pages.index');
    }
    
   
}
