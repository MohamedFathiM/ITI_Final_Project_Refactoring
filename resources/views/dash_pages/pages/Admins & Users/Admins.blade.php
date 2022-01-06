@extends('layouts.dashboard.master')
@section('content')
<div class="content-wrapper">
 
    
      <section class="content">
          <div class="container-fluid">
        <h2>Select Number Of Admins</h2>

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
              <th>Email</th>
              <th>role</th>
              <th>Image</th>
              <th>Control</th></tr>
            @foreach ($Admins as $admin)           
            <tr>
              <td>{{$admin->id}}</td>
              <td>{{$admin->name}}</td>
              <td>{{$admin->email}}</td>
              <td>{{$admin->role}}</td>
              <td><img src="/img/users-img/{{$admin->image}}" width=100 height=80 alt="" ></td>
              <td class="d-flex">
              <?php 
                //to hide element
                $divStyle='display:none;'; 
                ?>
              
                  <a style="width:70px;<?php if($admin->id == 1){echo $divStyle;} ?>" href="{{route('EditeUsers' ,$admin->id)}}" class="btn btn-primary">Edit</a>
                  &nbsp;
                <form method="POST" action="{{route('users.destroy' ,[$admin->id])}}">
                  {{ @csrf_field() }}
                  {{ method_field('DELETE') }}
                    <button style="width:70px;<?php if($admin->id == 1){echo $divStyle;} ?>"  type="submit" class="btn btn-danger">Delete</button> </form>

              </td>
            </tr>
            @endforeach
      
      </table>
          </div></section>
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