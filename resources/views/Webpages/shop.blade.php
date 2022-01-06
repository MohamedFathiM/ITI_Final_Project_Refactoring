
       @extends('layouts.master')
       @section('style')
       <style>
       .custom-control-label{width:100px;height:23px;border:1px solid black;}
       </style>
       @endsection
       @section('content')
        <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Catagories</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                    <!-- App\Category::where('status',1)->get() -->
                        @foreach(App\Category::all() as $cats)
                       @if(count(App\Product::where('category_id',$cats->id)->get())>0) 
                    <li class="{{Request::is('shop/'.$cats->id) ? 'active' : ''}}"><a href={{$cats->id}}>{{$cats->name}}</a></li>
                        @endif
                       @endforeach
                      
                        {{-- <li class="{{Request::is('shop/2') ? 'active' : ''}}"><a href="2">Beds</a></li>
                        <li class="{{Request::is('shop/3') ? 'active' : ''}}"><a  href="3">Accesories</a></li>
                        <li class="{{Request::is('shop/4') ? 'active' : ''}}"><a  href="4">Furniture</a></li>
                        <li class="{{Request::is('shop/5') ? 'active' : ''}}"><a  href="5">Home Deco</a></li>
                        <li class="{{Request::is('shop/6') ? 'active' : ''}}"><a  href="6">Dressings</a></li>
                        <li class="{{Request::is('shop/7') ? 'act ive' : ''}}"><a  href="7">Tables</a></li>
                        <li class="{{Request::is('shop/8') ? 'active' : ''}}"><a  href="8">Night Stands</a></li> --}}
                    </ul>
                </div>
            </div>



            <!-- ##### Single Widget ##### -->
            <div class="widget color mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Color</h6>

                <div class="widget-desc">
                <form action="{{route('sortCategory' ,$id)}}" method="get" id="filterForm">
                                            @csrf
                    <div class="custom-control custom-radio">
                        <a href="{{route('sortCategory' ,$id)}}" class="color1">Select All </a>
                    </div>

                    <div class="custom-control custom-radio">
                        <input name="color" value="silver" @if( @$color == 'silver') checked="true" @endif type="radio" class="custom-control-input" id="customCheck2">
                        <label class="custom-control-label color2" for="customCheck2" ></label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input name="color" value="white" type="radio" @if( @$color == 'white') checked="true" @endif class="custom-control-input" id="customCheck3">
                        <label class="custom-control-label color3" for="customCheck3" ></label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input name="color" value="fuchsia" type="radio"  @if( @$color == 'fuchsia') checked="true" @endif class="custom-control-input" id="customCheck4">
                        <label class="custom-control-label color4" for="customCheck4" ></label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input name="color" value="aqua" type="radio" @if( @$color == 'aqua') checked="true" @endif class="custom-control-input" id="customCheck5">
                        <label class="custom-control-label color5" for="customCheck5" ></label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input name="color" value="black" type="radio" @if( @$color == 'black') checked="true" @endif class="custom-control-input" id="customCheck6">
                        <label class="custom-control-label color6" for="customCheck6" ></label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input name="color" value="blue" type="radio" @if( @$color == 'blue') checked="true" @endif class="custom-control-input" id="customCheck7">
                        <label class="custom-control-label color7" for="customCheck7" ></label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input name="color" value="purple" type="radio" @if( @$color == 'purple') checked="true" @endif class="custom-control-input" id="customCheck8">
                        <label class="custom-control-label color8" for="customCheck8" ></label>
                    </div>
                </div>
            </div>

            <!-- ##### Single Widget ##### -->
            <div class="widget price mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Price</h6>

                <div class="widget-desc">
                    <div class="slider-range">
                        <input type="hidden"  name="min" id="hidden_minimum_price" value="{{$minPrice}}">
                        <input type="hidden" name="max" id="hidden_maximum_price" value="{{$maxPrice}}">
                        <div data-min="10" data-max="1000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="{{$minPrice}}" data-value-max="{{$maxPrice}}" data-label-result="">
                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        </div>
                        <div class="range-price">${{$minPrice}}- ${{$maxPrice}}</div>
                        <button type="submit" class="btn btn-success" style="font-size:15px;">Click To Filterate</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                    
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products">
                                   
                     
                       <p><span style="margin-right:30px;">Showing 1-{{@$value}} 0f&nbsp;
                        {{$products->count()}}  </span>
                                <span style="fontsize:15px;"> Price <mark>{{$minPrice}}</mark> to <mark>{{$maxPrice}} <mark> </span>
                                    

                            </p>

                                <div class="view d-flex">
                                    <a href="#" class="active" id="gridBtn"><i class="fa fa-th-large " aria-hidden="true"></i></a>
                                    <a href="#" id="listBtn"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                </div>
                                
                             </div>
                           
                            <!-- Sorting -->
                            <div class="product-sorting d-flex">
                                    <div class="sort-by-date d-flex align-items-center mr-15">
                                        <p>Sort by</p>
                                       
                                            <select name="sortSelect" id="sortBydate" >
                                                <option value="Date"    @if( $SortedValue == "Date")    selected= "selected" @endif>Date</option>
                                                <option value="Newest"  @if( $SortedValue == "Newest")  selected= "selected" @endif>Newest</option>
                                                <option value="Popular" @if( $SortedValue == "Popular") selected= "selected" @endif>Popular</option>
                                            </select>

                                    </div>
                                    
                                <div class="view-product d-flex align-items-center">
                                    <p>View</p>

                                        <select name="select" id="viewProduct">
                                            <option value="12" @if( @$value == 12) selected="selected" @endif >12</option>
                                            <option value="24" @if( @$value == 24) selected="selected" @endif>24</option>
                                            <option value="48" @if( @$value == 48) selected="selected" @endif>48</option>
                                            <option value="96" @if( @$value == 96) selected="selected" @endif>96</option>
                                        </select>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                       
                        $divStyle='style="display:none;"'; //hide div
                        // add condition
                        if(@$color xor @$color == '%'){
                            $divStyle=''; // show div
                        }
                    ?>
                <p <?php echo $divStyle ?> > Filter with color <span  style="background-color:grey;padding:10px;color:{{@$color}}">{{@$color}}</span> </p>
               
                <div class="row">
    {{-- this the beginnig of the products which display with ajax  --}}

                    <!-- Single Product Area -->
                @if(count($products) > 0)
                    @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6 full" >
                        <div class="single-product-wrapper list" >
                            <!-- Product Image -->
                            <div class="product-img">
                            <img src="{{asset('img/product-img/'.$product ->image1)}}" style="width: 335px;height: 416px" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img zoom" src="{{asset('img/product-img/'.$product -> image2)}}" style="width: 335px;height: 416px"  alt="">
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
                                    <form  action="{{route('cartstore')}}" method="post">
                                         @csrf
                                        <input type="hidden" name="productID" value="{{$product->id}}">
                                        <button type="submit" name="addtocart"  data-placement="left" title="Add to Cart"><img src="/img/core-img/cart.png" alt=""></button>
                                     </form>
                                        <!-- <a href="{{route('cartstore')}}" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="/img/core-img/cart.png" alt=""></a> -->
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



                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                {{$products->links()}}
                            </ul>
                        </nav>
                    </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
    @endsection
    @section('script')

<script>
    var select = document.getElementById('viewProduct');
    var sort = document.getElementById('sortBydate');
    select.onchange = function(){
    this.form.submit()
        };

    sort.onchange = function(){
    this.form.submit()
        };

        $('input[type=radio]').click(function(){
            this.form.submit();
        })

    $(function() {
        $('#gridBtn').click(function() {
            $('.list').removeClass('list-view').addClass('single-product-wrapper');
            $('.full').removeClass('full-view');
            $('#listBtn').removeClass('active');
            $(this).addClass('active');
        });

        $('#listBtn').click(function() {
            $('.list').removeClass('single-product-wrapper').addClass('list-view');
            $('.full').addClass('full-view');
            $('#gridBtn').removeClass('active');
            $(this).addClass('active');
        });
       var min =  $('.slider-range-price').slider('values',0)
       var max =  $('.slider-range-price').slider('values',1)

    })
    

</script>





@endsection
