@extends('layouts.dashboard.master')

@section('content')
<section class="content">
        <div class="content-wrapper">
        
                <div class="row justify-content-center">
                        <div class="col-12 col-lg-7">
                            
                                    <div class="col-8" >
                                            
                                            <div class="card mb-3">
        <img src="/img/product-img/{{$comments ->Product->image1}}"   class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title"><strong>Product name : </strong><a href="{{route('product',$comments->Product->id)}}">{{$comments->Product->name}}</h5></a><br>
        <p class="card-text text-justify"><Strong>Comment : </strong>{{$comments->description}}</p>
        <a href="{{route('users')}}" ><p class="card-text"><strong class="text-muted">Comment With : </strong></p>{{$comments->User->name}}</a>
        <p class="card-text"><small class="text-muted">Created at : {{$comments->created_at}}</small></p>
        </div>
        </div>
       
    
                                                    
                                        </div>
                                                
                                 </div>
                                        
                         </div>
                </div>
                                      
        </div>
</section>
@endsection