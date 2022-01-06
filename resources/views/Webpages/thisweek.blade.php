@extends('layouts.master')
@section('content')
<div class="amado_product_area section-padding-100">
        <div class="container-fluid">
<h3>The New in  This Week</h3>
<br>
<hr>
            <div class="row">
                
{{-- this the beginnig of the products which display with ajax  --}}

                <!-- Single Product Area -->
            @if(count($pro) > 0)
                @foreach($pro as $product)
                <div class="col-12 col-sm-6 col-md-12 col-xl-6 full" >
                    <div class="single-product-wrapper list" >
                        <!-- Product Image -->
                        <div class="product-img">
                        <img src="{{asset('img/product-img/'.$product ->image1)}}" style="width:500px;height:300px;" alt="">
                            <!-- Hover Thumb -->
                            <img class="hover-img zoom"style="width:500px;height:500px;" src="{{asset('img/product-img/'.$product -> image2)}}" alt="">
                        </div>

                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            
                        
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">${{$product -> price}}</p>
                            <a href="..\product\{{$product->id}}">
                                    <h6>{{$product -> name}}</h6>
                                </a>
                            </div>
                            <!-- Ratings & Cart -->
                            <div class="ratings-cart text-right">
                                <div class="ratings">
                                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $product->averageRating }}" data-size="xs" disabled="">

                                </div>
                                <div class="cart">
                                      <form  action="{{route('product',$product->id)}}" method="get">
                                         @csrf
                                        <button type="submit" name="addtocart"  data-placement="left" title="More Info" class="btn btn-success">More</button>
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                    <div class="single-product-wrapper">
                        <p>Adding Products Soon</p>
                    </div>
                </div>
                @endif



                {{-- <div class="col-12">
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination justify-content-end mt-50">
                            {{$pro->links()}}
                        </ul>
                    </nav>
                </div> --}}
        </div>
    </div>
</div>
@endsection