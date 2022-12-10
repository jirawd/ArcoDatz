@extends('layouts.base')
@section('content')
<div class="card">
  <div class="card-header">Haircut Details</div><a href="{{ url('/groomings') }}" class="btn btn-danger float-end">BACK</a>

        <div class="card-body">
        <h1 class="card-title">ID : {{ $grooming->id }}</h1>
        
        <p class="card-title">Name : {{ $grooming->name }}</p>
        <p class="card-text">Description : {{ $grooming->description }}</p>
        <p class="card-text">Price : {{ $grooming->price }}</p>
        <div class="col-md-4">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
        @foreach($images as $grooming)
         <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
          <img class="d-block w-100" src="{{ asset('storage/images/groomings/'.$grooming->img_path) }}" width="200px" height="250px" alt="Image">>
         </div>
        @endforeach  
        </div>
             <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
                
        
       </div>
  </div>
</div>
