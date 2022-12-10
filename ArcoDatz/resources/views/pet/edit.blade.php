@extends('layouts.base')
@section('body')
 <div class="container">
      <h2>Edit pet</h2><br/>
      {{ Form::model($pet,['route' => ['pet.update',$pet->id],'method'=>'PUT']) }}
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Name:</label>
           {!! Form::text('name',$pet->name,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4"> 
        <label for="customer_id">Owner's Name</label>
        <select name="customer_id" id="customer_id" class="form-select">
        @foreach($customers as $customer)
          <option value="{{$customer->id}}">{{$customer->title}}. {{$customer->lname}}, {{$customer->fname}}</option>
        @endforeach
        </select>
        </div>
        </div>
                        

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Type:</label>
           {!! Form::text('type',$pet->type,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Breed:</label>
           {!! Form::text('breed',$pet->breed,array('class' => 'form-control')) !!}
          </div>
        </div>

        <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4"> 
            <label for="">Pet Image</label>
            <input type="file" name="img_path" class="form-control">
            <img src="{{ asset('storage/images/pets/'.$pet->img_path) }}" width="70px" height="70px" alt="Image">
        </div></div></div>


        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
     {!! Form::close() !!}
    </div>
@endsection