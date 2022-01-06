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
   @if(Session::get('message'))
   <div class="alert alert-success">
   <strong>
   {{Session::get('message')}}
   </strong>
   </div>
   @endif
 <div class="content-wrapper" style=" margin-right:100px;">
  
 <form action="{{route('UpdateUsers',$User->id)}}" method="post" enctype="multipart/form-data" >
          @csrf
          @method('put')
         <input type="hidden" name="id" value="{{$User->id}}" >
         <div class="form-group">
            <label for="cc-name" class="control-label mb-1">Name</label>
            <input id="cc-name"  type="text" class="form-control name" aria-required="true" aria-invalid="false" name="name" value="{{$User->name}}">
        </div>
        <div class="form-group ">
            <label for="cc-name" class="control-label mb-1">Email</label>
            <input id="cc-email"  type="email" class="form-control cc-name valid email"name="email" value="{{$User->email}}" >
        </div>
         <div class="form-group">
            <label for="cc-number" class="control-label mb-1">password</label>
            <input id="cc-number"  type="password" class="form-control "name="password" value="{{$User->password}}" >
        </div>
        <div class="form-group">
        <label for="cc-name" class="control-label mb-1">role</label>
        <input id="cc-name"  type="text" class="form-control " name="role" value="{{$User->role}}">
    </div>
    <div class="form-group">
        <img src="/img/users-img/{{$User->image}}" alt="UserImage" width=200px height=200px />
       <input id="cc-name"  type="file" class="form-control " name="image" value="{{$User->image}}">
   </div>
        <input type="submit" class="btn btn-primary" value="Update"> 
      </form>

 </div>   
@endsection
