@extends('layouts.master')

@section('content')
    @if(empty($checkups))
        <h1> No Check Ups</h1>
    @else
    <div class="container">
         <div class="row">
            <!-- <div class="col-md-6 col-md-offset-3"> -->
                   <h4>Profile</h4><hr>
                     @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <input type="text" name="query" />
                <input type="submit" class="btn btn-sm btn-primary" value="Search" />
            </form>
                   <table class="table table-hover">
                      <thead>
                       
                        <th>Customer ID</th>
                        <th>Pet ID</th>
                        <th>Pet Name</th>
                        <th>Disease</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Payment</th>
                   
                      </thead>
                      <tbody>
                        @foreach ($checkups as $checkup)
                         <tr>
                          
                            <td>{{$checkup->pet->customer_id}}</td>
                            <td>{{$checkup->pet->id}}</td>
                            <td>{{$checkup->pet->name}}</td>
                            <td>{{$checkup->disease}}</td>
                            <td>{{$checkup->comments}}</td>
                            <td>{{$checkup->status}}</td>
                            <td>1000.00</td>
                            
                         </tr>
                        @endforeach
                      </tbody>
                   </table>               

            </div>
         </div>
    </div>
    @endif
@endsection