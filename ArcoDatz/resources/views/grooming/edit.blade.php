@extends('layouts.base')
@section('body')
 <div class="container">
      <h2>Edit grooming</h2><br/>
      {{ Form::model($grooming,['route' => ['grooming.update',$grooming->id],'method'=>'PUT']) }}
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Name:</label>
           {!! Form::text('name',$grooming->name,array('class' => 'form-control')) !!}
          </div>
        </div>

     
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Description:</label>
           {!! Form::text('description',$grooming->description,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Price:</label>
           {!! Form::number('price',$grooming->price,array('class' => 'form-control')) !!}
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