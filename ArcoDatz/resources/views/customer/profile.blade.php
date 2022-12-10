@extends('layouts.master')

@section('content')
    
    <div class="container">
         <div class="row">
            <!-- <div class="col-md-6 col-md-offset-3"> -->
                <p></p>
                   <h4>Customer Profile</h4>
                     @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
                   <table class="table table-hover">
                      <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                   
                      </thead>
                      <tbody>
                         <tr>
                            <td><img src="{{ asset('storage/images/customers/'.$customer->img_path) }}" width="100px" height="125px" alt="Image"></td>
                            <td>{{Auth::user()->name}}</td>
                            <td>{{Auth::user()->email}}</td>
                            <td>{{Auth::user()->role}}</td>                  
                            
                         </tr>
                      </tbody>
                   </table>  

                   <p>Addressline: {{$customer->addressline}}</p>
                   <p>Town: {{$customer->town}}</p> 
                   <p>Zipcode: {{$customer->zipcode}}</p> 
                   <p>Contact: {{$customer->phonenumber}}</p> 
            </div>
            <button><a href="{{ url('/edit-customer/'.$customer->id) }}">Edit Profile</a></button>
            <div class="row">
            <h4>Customer's Pet</h4>
             <a href="{{ url('/add-pet/'.$customer->id) }}" class="btn btn-info float-end">Add Pet</a>
             <table class="table table-hover">
                      <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Breed</th>
                        <th>Action</th>
                   
                      </thead>
                      <tbody>
                        @foreach ($pets as $pet)
                         <tr>
                            <td><img src="{{ asset('storage/images/pets/'.$pet->img_path) }}" width="100px" height="125px" alt="Image"></td>
                            <td>{{$pet->name}}</td>
                            <td>{{$pet->type}}</td>
                            <td>{{$pet->breed}}</td> 
                            <td><form action="{{ url('checkup-pet/'.$pet->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success btn-sm">Check Up</button></form></td>                   
                         </tr>
                         @endforeach
                      </tbody>
                   </table>  
               </div>
         </div>
@endsection