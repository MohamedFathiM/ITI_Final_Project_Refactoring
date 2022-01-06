@extends('layouts.dashboard.master')
 @section('content')
 <div class="content-wrapper"> 
 
   <section class="content">
       <div class="container-fluid">
  <h2>Select Number Of Subscribers</h2>
      <div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
         <select class="form-control" name="state" id="maxRows">
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
<tr scope="row">
  <th>Id</th>
  
  <th>Email</th>
 
</tr>

@foreach($subscribes as $Subscriber)

<tr scope="row">

    <td>{{$Subscriber->id}}</td> 
    <td>{{$Subscriber->email}}</td>

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




@endsection
@section('script')


@endsection