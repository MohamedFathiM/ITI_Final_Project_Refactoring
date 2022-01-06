       @extends('layouts.master')
       @section('style')
        <style>
            #close{
                float:right;
                transform:rotate(45deg);
                font-size:25px;
                color:red;
                position: absolute;
                left: 574px;
                cursor:pointer;
            }
            #close:hover{
                color:green;
            }
           .imageCart img{
                width:120px;
                height:90px !important;
            }
        </style>
       @endsection
        @section('content')
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <p class="btn-succes"> select quantity then press Enter to apply </p>
                                @php 
                                $all = 0 ;
                                $delv = 0;
                                @endphp
                                @foreach($products as $product)
                                    <tr>
                                        <td class=""><a title="Click to Delete" href="{{route('cartdestroy',$product->product_id)}}"><span id="close">+</span></a>
                                            <a href="#"><img src="{{asset('img/product-img/'.$product->image)}}" alt="Product" width=120px height=150px></a>
                                        </td>
                                        
                                        <td class="cart_product_desc">
                                            <h5>{{$product->name}}</h5>
                                        </td>

                                        <td class="price">
                                        @php
                                            $FinalPrice = $product->price * $product->qauntity;
                                            $all += $FinalPrice;
                                        @endphp
                                            <span>$ {{$product -> price}}</span>
                                        </td>
                                        
                                        <td class="qty">
                                            <div class="qty-btn d-flex">
                                                <p>Qty</p>
                                                <div class="quantity">
                                                    <!-- <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span> -->
                                                    <form action="{{route('cartupdate',$product->id)}}" method="post" >
                                                    @csrf
                                                    {{ method_field('PUT') }}                                                   
                                                     <input type="number" class="qty" title="press enter to activate"  step="1" min="1" max="300" name="quantity" value="{{$product->qauntity}}" >
                                                    </form>
                                                    <!-- <span class="qty-plus " onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span> -->
                                                </div>
                                                
                                            </div>
                                            
                                        </td>
                                        
                                    </tr>
                                    
                                    @endforeach
                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>$ {{$all}}</span></li>
                                <li><span>delivery:</span> <span>{{$delv}}</span></li>
                                <li><span>total:</span> <span>$ {{$all + $delv}}</span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="{{route('checkout')}}" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>

$('.qty').onkeypress(function(){
    $(this).form.submit();
})
</script>
@endsection