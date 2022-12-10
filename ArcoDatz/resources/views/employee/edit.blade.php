@extends('layouts.base')
@section('body')
 <div class="container">
      <h2>Edit employee</h2><br/>
      {{ Form::model($employee,['route' => ['employee.update',$employee->id],'method'=>'PUT']) }}
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Title:</label>
           {!! Form::text('title',$employee->title,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">First Name:</label>
           {!! Form::text('fname',$employee->fname,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Last Name:</label>
           {!! Form::text('lname',$employee->lname,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Addressline:</label>
           {!! Form::text('addressline',$employee->addressline,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Town:</label>
           {!! Form::text('town',$employee->town,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Zipcode:</label>
           {!! Form::text('zipcode',$employee->zipcode,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Phone Number:</label>
           {!! Form::text('phonenumber',$employee->phonenumber,array('class' => 'form-control')) !!}
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