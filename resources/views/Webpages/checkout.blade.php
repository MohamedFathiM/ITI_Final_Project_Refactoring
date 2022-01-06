
        @extends('layouts.master')
        @section('content')
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
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
                @if(Session::get('OrderMessage'))
                    <div class="alert alert-success">
                    <strong>
                        {{Session::get('OrderMessage')}}
                    </strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>

                        <form action="{{route('addcheckout')}}" method="post">
                            @csrf
                            @method('Post')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="first_name" value="" placeholder="First Name" required name="fname">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="last_name" value="" placeholder="Last Name" required name="lname">
                                    </div>
                        
                                    <div class="col-12 mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email" value="" name="email">
                                    </div>

                                    @php
                                    $all = 0 ;
                                    $delv = 0;
                                    @endphp
                                    @foreach (App\Cart::where('user_id',auth()->user()->id)->get() as $item)
                                        
                                     @php
                                        $FinalPrice =  $item->price * $item->qauntity;
                                     $all += $FinalPrice;
                                    @endphp
                                    @endforeach
                                
                                    <div class="col-12 mb-3">
                                        <select class="w-100" id="country" name="city">
                                        <option value="Egypt">Egypt</option>
                                        <option value="Saudi">Saudi Arabia</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Yemen">Yemen</option>
                                    </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control mb-3" id="street_address" placeholder="Address" value="" name="address">
                                    </div>
                                    <div class="col-12 mb-3">
                                    <input type="hidden" class="form-control mb-3" placeholder="totalprice" value="{{$all}}" name="totalprice" >
                                        </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="zipCode" placeholder="Zip Code" value="" name="zipCode">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="phone_number" min="0" placeholder="Phone No" value="" name="phoneNumber">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Leave a comment about your order" name="comment">
                                    </div>

                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox d-block mb-2">
                                           
                                        </div>
                                        <div class="custom-control custom-checkbox d-block">
                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> 
                                    
                                    <span>$ {{$all}}</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>$ {{$all}}</span></li>
                            </ul>

                            <div class="payment-method">
                                <!-- Cash on delivery -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="cod" checked>
                                    <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                </div>
                                <!-- Paypal -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    
                                </div>
                            </div>

                            <div class="cart-btn mt-100">
                                    <input type="submit" class="form-control btn-info"   value="checkout" >
                            </div>
                        </div>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
   @endsection