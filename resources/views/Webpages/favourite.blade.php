
       @extends('layouts.master')
       @section('style')
        <style>
            .single-product-wrapper:nth-child(odd){
                margin-left:15px;
            }
            p{
                text-align:center;
                margin-left:125px;
            }
        </style>
       @endsection
       @section('content')
       <div class="amado_product_area section-padding-100">
        <div class="container-fluid">
        <h3>The high rated products according to users opinions</h3>
        <br>
        <hr>
            <div class="row">

                    <!-- Single Product Area -->
                @if(count($products) > 0)
                    @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6 full" >
                        <div class="single-product-wrapper"  >
                            <!-- Product Image -->
                            <div class="product-img">
                            <img src="{{asset('img/product-img/'.$product ->image1)}}"style="width:300px;height:300px;" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img zoom" src="{{asset('img/product-img/'.$product -> image2)}}" style="width:300px;height:300;"alt="">
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



                    
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
    @endsection

