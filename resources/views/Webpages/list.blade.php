@if(count($products) > 0)
@foreach($products as $product)


    <div class="col-md-12">
        <!-- Product Image -->
        <div class="product-img">
        <img src="{{$product -> image1}}" alt="">
            <!-- Hover Thumb -->
            <img class="hover-img zoom" src="{{$product -> image1}}" alt="">
        </div>

        <!-- Product Description -->
        <div class="product-description d-flex align-items-center justify-content-between">
            <!-- Product Meta Data -->
            <div class="product-meta-data">
                <div class="line"></div>
                <p class="product-price">${{$product -> price}}</p>
                <a href="product-details.html">
                    <h6>{{$product -> name}}</h6>
                </a>
            </div>
            <!-- Ratings & Cart -->
            <div class="ratings-cart text-right">
                <div class="ratings">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <div class="cart">
                    <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="/img/core-img/cart.png" alt=""></a>
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