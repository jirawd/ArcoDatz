@extends('layouts.base')
@section('content')
<div class="card">
  <div class="card-header">checkup Details</div><a href="{{ url('/checkups') }}" class="btn btn-danger float-end">BACK</a>

        <div class="card-body">
        <h1 class="card-title">Check Up ID : {{ $checkup->id }}</h1>
      
        <h2 class="card-title">Pet ID : {{ $checkup->pet_id }}</h2>

        <p class="card-text">Employee ID : {{ $checkup->employee_id }}</p>
        <p class="card-text">Disease : {{ $checkup->disease }}</p>
        <p class="card-text">Comments : {{ $checkup->comments }}</p>
        <p class="card-text">Checkup Date : {{ $checkup->checkupdate }}</p>
        <p class="card-text">Status : {{ $checkup->status }}</p>
       </div>
  </div>
</div>