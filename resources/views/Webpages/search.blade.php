@extends('layouts.master')
@section('style')
<style>
    a{
        color:blue;
        font-size:15px;
    }
    a:hover{
        font-size:15px;
        color:black;
    }
</style>
@endsection
    @section('content')
   

 @if(isset($productName))
   

 <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">
                    <table class="table table-stripe" >
                    <p> The Search results for your query <b> {{ $query }} </b> are :</p>

                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                        </thead>
                        <tbody>
                        @foreach($productName as $product)
                            <tr>
                            <!-----------------------To highlight the search results --------------------------->
                            <?php
                                   $replace = '<span style="background-color:yellow;">' . $query. '</span>';
                                    $product ->name = str_replace( $query, $replace, $product ->name );
                                    $product ->description = str_replace( $query, $replace, $product ->description );
                                    
                            ?>
                            <!-----------------------To highlight the search results --------------------------->

                                <td><a href="..\product\{{$product->id}}" title="Click To Browse" >{!!$product->name!!}</a></td>
                                <td style="width:500px">{!!$product ->description!!}</td>
                                <td>$ {{ $product -> price}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                        </table>
                        </div>
            </div>
            

    @else
        
        <p>{{$message}}</p>
    @endif
    
</div>

    @endsection