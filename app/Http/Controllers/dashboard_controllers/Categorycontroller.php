<?php

namespace App\Http\Controllers\dashboard_controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;


class Categorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories=Category::All();
        return view('dash_pages.pages.Categories&Products.Categories' , compact('Categories'));
        
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
        $input = $request -> all();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

       ]);
        $category=new Category();
        $category['name']=request('name');
        $category['description']=request('description');
        $category['status']=request('status');
        if(\Auth::check()){
        $category['user_id']=\Auth::id();
        }else{
            $category['user_id'] = 1 ;
        }
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move('img/category-img/',$filename);
            $category->image=$filename;
    
        }else{
            return $request;
            $category->image='';
        }
        $category->save();
        return back()->with('sucess','data updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category , $id)
    {
        $category=Category::find($id);
        return view('dash_pages.pages.Categories&Products.editeCategory' , compact('category' , $category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category ,$id)
    {
         $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'status' => 'required',
   ]);
    $category=Category::find($id);
    $category['name']=request('name');
    $category['description']=request('description');
    $category['status']=request('status');
    if($request->hasfile('image')){
        $file=$request->file('image');
        $extention=$file->getClientOriginalExtension();
        $filename=time().'.'.$extention;
        $file->move('img/category-img/',$filename);
        $category->image=$filename;
    }
    $category->save();
    return redirect('dashboard/Categories')->with('sucess','data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category , $id)
    {
        $category = Category::find($id);
        $category->delete();
         return back();
    }


    
}
