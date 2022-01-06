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
 {{-- add products to dashboard  --}}
 <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">
   Add Products
  </button>


 <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('AddProducts')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Name of Product</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter name" >
                </div>
                <div class="form-group">
                  <label for="tectarea">Description</label>
                  <textarea class="form-control" id="textarea" rows="3" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="image1">Upload image </label>
                    <input type="file" class="form-control-file" id="image1" name="image1">
                  </div>
                <div class="form-group">
                    <label for="image2">Upload image </label>
                    <input type="file" class="form-control-file" id="image2" name="image2">
                </div>
                <div class="form-group">
                    <label for="image3">Upload image </label>
                    <input type="file" class="form-control-file" id="image3" name="image3">
                </div>
                <div class="form-group">
                    <label for="price">Price </label><br>
                    <input type="text"  name="price">
                    <small id="price" class="form-text text-muted">from 5 to 100</small>
                </div>
                <div class="form-group">
                    <label for="color">Color </label>
                    <input type="color"  name="color" value="#ffffff">
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
                <input type="submit" class="btn btn-primary">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </form>


        </div>

      </div>
    </div>
  </div>
  
 {{-- add products to dashboard  --}}


  <h2>Select Number Of Products</h2>
  <div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
    <select class  ="form-control" name="state" id="maxRows">
      <option value="5000">Show ALL Rows</option>
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="15">15</option>
      <option value="20">20</option>
      <option value="50">50</option>
      <option value="70">70</option>
      <option value="100">100</option>
     </select>
    
   </div>

<table class="table table-striped table-class" id= "table-id">
<tr>
  <th>Id</th>
  <th>Name</th>
  <th>Description</th>
  <th>img1</th>
  <th>Img2</th>
  <th>Img3</th>
  <th>Price</th>
  <th>Color</th>
  <th>Control</th>


  </tr>
@foreach ($products as $prods)
<tr>
  <td>{{$prods->id}}</td>
  <td>{{$prods->name}}</td>
  <td style="width:300px;">{{$prods->description}}</td>
  <td><img src="{{asset('img/product-img/'.$prods->image1)}}" height=80px width=100px/></td>
  <td><img src="{{asset('img/product-img/'.$prods->image2)}}" height=80px width=100px/></td>
  <td><img src="{{asset('img/product-img/'.$prods->image3)}}" height=80px width=100px/></td>
  <td>$ {{ceil($prods->price)}}</td>
  <td><div style="background:{{$prods->color}};width:50px;height:50px;"></div></td>
  <td  class="d-flex" >
      <a href="{{route('EditeProducts',$prods->id)}}" style="width:70px;" class="btn btn-primary">Edit</a>
      &nbsp;

      <form method="POST" action="{{route('product.destroy' ,$prods->id)}}">
          {{ @csrf_field() }}
          {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-danger" style="width:70px;" value="Delete "></form>
  </td>

</tr>
@endforeach

</table>

<!--		Start Pagination -->


<div class='pagination-container'>
    <nav style="text-align:center">
      <ul class="pagination justify-content-center">
        
        <li data-page="prev" class="page-item">
                 <span class="page-link"> < <span class="sr-only">(current)</span></span>
                </li>
       <!--	Here the JS Function Will Add the Rows -->
    <li data-page="next" id="prev">
                   <span class="page-link"> > <span class="sr-only">(current)</span></span>
                </li>
      </ul>
    </nav>
  </div>

</div> <!-- 		End of Container -->



<!--  Developed By Yasser Mas -->
@endsection
@section('script')
getPagination('#table-id');
//getPagination('.table-class');
//getPagination('table');

/*					PAGINATION 
- on change max rows select options fade out all rows gt option value mx = 5
- append pagination list as per numbers of rows / max rows option (20row/5= 4pages )
- each pagination li on click -> fade out all tr gt max rows * li num and (5*pagenum 2 = 10 rows)
- fade out all tr lt max rows * li num - max rows ((5*pagenum 2 = 10) - 5)
- fade in all tr between (maxRows*PageNum) and (maxRows*pageNum)- MaxRows 
*/

function getPagination (table){

var lastPage = 1 ; 

$('#maxRows').on('change',function(evt){
//$('.paginationprev').html('');						// reset pagination 


lastPage = 1 ; 
$('.pagination').find("li").slice(1, -1).remove();
var trnum = 0 ;									// reset tr counter 
var maxRows = parseInt($(this).val());			// get Max Rows from select option

if(maxRows == 5000 ){

$('.pagination').hide();
}else {

$('.pagination').show();
}

var totalRows = $(table+' tbody tr').length;		// numbers of rows 
$(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
trnum++;									// Start Counter 
if (trnum > maxRows ){						// if tr number gt maxRows

$(this).hide();							// fade it out 
}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
});											//  was fade out to fade it in 
if (totalRows > maxRows){						// if tr total rows gt max rows option
var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
                   //	numbers of pages 
for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
$('.pagination #prev').before('<li data-page="'+i+'" class="page-item">\
          <span class="page-link">'+ i++ +'<span class="sr-only">(current)</span></span>\
        </li>').show();
}											// end for i 
} 												// end if row count > max rows
$('.pagination [data-page="1"]').addClass('active'); // add active class to the first li 
$('.pagination li').on('click',function(evt){		// on click each page
evt.stopImmediatePropagation();
evt.preventDefault();
var pageNum = $(this).attr('data-page');	// get it's number

var maxRows = parseInt($('#maxRows').val());			// get Max Rows from select option

if(pageNum == "prev" ){
if(lastPage == 1 ){return;}
pageNum  = --lastPage ; 
}
if(pageNum == "next" ){
if(lastPage == ($('.pagination li').length -2) ){return;}
pageNum  = ++lastPage ; 
}

lastPage = pageNum ;
var trIndex = 0 ;							// reset tr counter
$('.pagination li').removeClass('active');	// remove active class from all li 
$('.pagination [data-page="'+lastPage+'"]').addClass('active');// add active class to the clicked 
// $(this).addClass('active');					// add active class to the clicked 
$(table+' tr:gt(0)').each(function(){		// each tr in table not the header
trIndex++;								// tr index counter 
// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
 $(this).hide();		
}else {$(this).show();} 				//else fade in 
}); 										// end of for each tr in table
});										// end of on click pagination list

}).val(5).change();

            // end of on select change 



    // END OF PAGINATION 
}	








@endsection