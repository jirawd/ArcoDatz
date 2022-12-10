@extends('layouts.base')
@section('body')
 <div class="container">
      <h2>Edit customer</h2><br/>
      {{ Form::model($customer,['route' => ['customer.update',$customer->id],'method'=>'PUT']) }}
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Title:</label>
           {!! Form::text('title',$customer->title,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">First Name:</label>
           {!! Form::text('fname',$customer->fname,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Last Name:</label>
           {!! Form::text('lname',$customer->lname,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Addressline:</label>
           {!! Form::text('addressline',$customer->addressline,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Town:</label>
           {!! Form::text('town',$customer->town,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Zipcode:</label>
           {!! Form::text('zipcode',$customer->zipcode,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Phone Number:</label>
           {!! Form::text('phonenumber',$customer->phonenumber,array('class' => 'form-control')) !!}
          </div>
        </div>
</div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
     {!! Form::close() !!}
    </div>
@endsection