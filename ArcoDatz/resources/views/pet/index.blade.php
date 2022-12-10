@extends('layouts.master')
@section('content')
  <div class="container">
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
     

    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#petModal">Add new pet</button>

    <br />
    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#emailModal">Contact Us
    </button>
<div class="modal" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myemailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold">Contact Us</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{url('#')}}">
        {{csrf_field()}}
        <div class="modal-body mx-3" id="mailModal">
          <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
width: 150px; ">Send Email</label>
            <input type="text" id="sender" class="form-control validate" name="sender" placeholder="your name">
            <input type="text" id="title" class="form-control validate" name="title" placeholder="title">
            <textarea class="form-control validate" name="body" placeholder="Your message"></textarea>
          </div>
<div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Send </button>
            <button class="btn btn-light" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
          
  </div>
  </div>
  <div >
    <div class="col-xs-6">
      <form method="post" enctype="multipart/form-data" action="{{ url('/pet/import') }}">
         @csrf
       <input type="file" id="uploadName" name="Pet_upload" required>
       
   </div>
 @error('pet_upload')
     <small>{{ $message }}</small>
   @enderror
        <button type="submit" class="btn btn-info btn-primary " >Import Excel File</button>
        </form> 
 </div>
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
  </div>

  </div>
  <div class="modal " id="petModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
  <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold">Add New pet</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form method="POST" action="{{url('pet')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-3" id="inputfacultyModal">
          <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Name</label>
            <input type="text"  class="form-control validate" name="name">
     
           <div class="form-group"> 
                        <label for="id">Owner's Name</label>
                        <select name="customer_id"  class="form-select">
                        @foreach($customer as $customer)
                          <option value="{{$customer->id}}">{{$customer->title}}. {{$customer->lname}}, {{$customer->fname}}</option>
                        @endforeach
                        </select>
          </div>

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Type</label>
            <input type="text"  class="form-control validate" name="type">
         

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Breed</label>
            <input type="text"  class="form-control validate" name="breed">
            

          <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 500px; ">Select Image to Upload</label>
            <input type="file"  class="form-control validate" name="img_path">
          </div>

<div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-light" data-dismiss="modal"> <i class="fas fa-paper-plane-o ml-1">Cancel</i></button>
          </div>
        </form>
 </div>
    </div>
    
  </div>
  @push('scripts')
    {{$dataTable->scripts()}}
  @endpush
@endsection