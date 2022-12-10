@extends('layouts.master')
@section('content')
    <div class="row">
        <!-- <div class="col-md-4 col-md-offset-4"> -->
            <h1>Create Employee</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
             <form method="POST" action="{{url('signupE')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-3" id="inputfacultyModal">
          <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Email</label>
            <input type="text"  class="form-control validate" name="email">
          

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Password</label>
            <input type="password"  class="form-control validate" name="password">
         <br>

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Title</label>
            <select name="title">
              <option value="Mr">Mr.</option>
              <option value="Mrs">Mrs.</option>
              <option value="Ms">Ms.</option>
            </select>
            <br>
            <br>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Role</label>
            <select name="role">
             
              <option value="Groomer">Groomer</option>
              <option value="Veterinarian">Veterinarian</option>
            </select>
          <br>
          <br>
          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">First Name</label>
            <input type="text"  class="form-control validate" name="fname">
         

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Last Name</label>
            <input type="text"  class="form-control validate" name="lname">
      

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Addressline</label>
            <input type="text"  class="form-control validate" name="addressline">
         

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Town</label>
            <input type="text"  class="form-control validate" name="town">
         

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Zipcode</label>
            <input type="text"  class="form-control validate" name="zipcode">
       

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Phone Number</label>
            <input type="text"  class="form-control validate" name="phonenumber">

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 500px; ">Select Image to Upload</label>
            <input type="file"  class="form-control validate" name="img_path">
          </div>

<div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-light" data-dismiss="modal"> <i class="fas fa-paper-plane-o ml-1">Cancel</i></button>
          </div>
        </form>
        <!-- </div> -->
    </div>
@endsection
