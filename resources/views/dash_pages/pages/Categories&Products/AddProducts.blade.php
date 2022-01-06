@extends('layouts.dashboard.master')
@section('content')
<div class="content-wrapper">
<form action="post" enctype="multipart/form-data">
    <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control "name="name" required autocomplete="name" autofocus>

        </div>
              <label >image1</label>
              <input type="file" class="form-control-file"  name="image1" >
            </div>
            <label >image2</label>
            <input type="file" class="form-control-file"  name="image2" >
          </div>
          <label >image3</label>
          <input type="file" class="form-control-file"  name="image3" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div> 
@endsection