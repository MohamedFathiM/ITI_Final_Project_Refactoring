@extends('layouts.dashboard.master')
 @section('content')
 
 <div class="content-wrapper">
    @if (count($errors) > 0)

    <div class="alert alert-danger">
   
        <strong>Whoops!</strong> There were some problems with your input.
   
        <ul>
   
            @foreach ($errors->all() as $error)
   
                <li>{{ $error }}</li>
   
            @endforeach
   
        </ul>
   
    </div>
   
   @endif
   @if(Session::get('sucess'))
   <div class="alert alert-success">
   <strong>
   {{Session::get('sucess')}}
   </strong>
   </div>
   @endif
 <div class="content-wrapper" style=" margin-right:100px;">
  
 <form action="{{route('UpdateProducts',$products->id)}}" method="post" enctype="multipart/form-data" >
          @csrf
          @method('put')
         <input type="hidden" name="id" value="{{$products->id}}" >
         <div class="form-group">
            <label for="cc-name" class="control-label mb-1">Name</label>
            <input id="cc-name"  type="text" class="form-control name" aria-required="true" aria-invalid="false" name="name" value="{{$products->name}}">
        </div>
        <div class="form-group ">
            <label for="cc-name" class="control-label mb-1">description</label>
            <textarea id="cc-description"  type="text" class="form-control " name="description"  >
            {{$products->description}}
            </textarea>
        </div>
         <div class="form-group">
                     <img src="/img/product-img/{{$products->image1}}" width=200px hight=200px>

            <input id="cc-number"   type="file" name="image1" value="{{$products->image1}}" >
        </div>
        <div class="form-group">
                    <img src="/img/product-img/{{$products->image2}}" width=200px hight=200px>

                <input id="cc-number"   type="file" name="image2" value="{{$products->image2}}" >
            </div>
            <div class="form-group">
                        <img src="/img/product-img/{{$products->image3}}" width=200px hight=200px>

                    <input id="cc-number"   type="file" name="image3" value="{{$products->image3}}" >
                </div>
        <div class="form-group">
                <label for="cc-number" class="control-label mb-1">price</label><br>
                <input id="cc-number"  type="text" name="price" value="{{$products->price}}" >
            </div>

            <div class="form-group">
                <label for="color" class="control-label mb-1">Color</label><br>
                <input id="color"  type="color" name="color" value="{{$products->color}}" >
            </div>

            <div class="form-group">
                    <label for="user">select User</label>
                    <select class="form-control" id="user" name="user" >
                      @foreach (App\User::get() as $user)
                        
                         <option value="{{$user->id}}">{{$user -> name}}</option>

                      @endforeach
                    </select>
            </div> 
    
    <div class="form-group">
                    <label for="category">select Category</label>
                    <select class="form-control" id="category" name="category" >
                      @foreach (App\Category::get() as $cat)
                        @if($cat -> status == 1){
                         <option value="{{$cat->id}}">{{$cat -> name}}</option>
                        }
                        @endif
                      @endforeach
                    </select>
    </div> 
        <input type="submit" class="btn btn-primary" value="Update"> 
      </form>

 </div>   
@endsection
