@extends('layouts.base')
@section('content')
<div class="card">
  <div class="card-header">Pet Details</div><a href="{{ url('/pets') }}" class="btn btn-danger float-end">BACK</a>

        <div class="card-body">
        <h1 class="card-title">ID : {{ $pet->id }}</h1>
        <h4 class="card-title"><img src="{{ asset('storage/images/pets/'.$pet->img_path) }}" width="200px" height="250px" alt="Image"></h4>
        <h2 class="card-title">Name : {{ $pet->name }}</h2>

        <p class="card-text">Type : {{ $pet->type }}</p>
        <p class="card-text">Breed : {{ $pet->breed }}</p>
       </div>
  </div>
</div>