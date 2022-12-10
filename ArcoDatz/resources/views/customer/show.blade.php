@extends('layouts.base')
@section('content')
<div class="card">
  <div class="card-header">Constumer Details</div><a href="{{ url('/customers') }}" class="btn btn-danger float-end">BACK</a>

        <div class="card-body">
        <h1 class="card-title">ID : {{ $customer->id }}</h1>
        <div class="row">
          <div class="column">
        <h3 class="card-title"><img src="{{ asset('storage/images/customers/'.$customer->img_path) }}" width="200px" height="250px" alt="Image"></h3>
         </div>
        <h3 class="card-title">Name : {{ $customer->title }}. {{ $customer->lname }},{{ $customer->fname }}</h3>
       
         <div class="column">
        <p class="card-text">Address : {{ $customer->addressline }}</p>
        <p class="card-text">Town : {{ $customer->town }}</p>
        <p class="card-text">Zipcode : {{ $customer->zipcode }}</p>
        <p class="card-text">Phone : {{ $customer->phonenumber }}</p>
        </div>
        </div>
       </div>
  </div>
</div>