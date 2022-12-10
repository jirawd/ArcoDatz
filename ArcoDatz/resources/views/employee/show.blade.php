@extends('layouts.base')
@section('content')
<div class="card">
  <div class="card-header">Employee Details</div><a href="{{ url('/employees') }}" class="btn btn-danger float-end">BACK</a>

        <div class="card-body">
        <h4 class="card-title">ID : {{ $employee->id }}</h4>
        <h4 class="card-title"><img src="{{ asset('storage/images/employees/'.$employee->img_path) }}" width="200px" height="250px" alt="Image"></h4>
        

        
        <h3 class="card-title">Name : {{ $employee->title }}. {{ $employee->lname }},{{ $employee->fname }}</h3>
       
         <div class="column">
        <p class="card-text">Address : {{ $employee->addressline }}</p>
        <p class="card-text">Town : {{ $employee->town }}</p>
        <p class="card-text">Zipcode : {{ $employee->zipcode }}</p>
        <p class="card-text">Phone : {{ $employee->phonenumber }}</p>
       </div>
  </div>
</div>