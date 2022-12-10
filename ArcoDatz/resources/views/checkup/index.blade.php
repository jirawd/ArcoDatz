@extends('layouts.master')

@section('content')
    @if(empty($checkups))
        <h1> No Check Ups</h1>
    @else
    <div class="container">
         <div class="row">
            <!-- <div class="col-md-6 col-md-offset-3"> -->
                   <h2>Check up</h2>
                     @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
                   <table class="table table-hover">
                      <thead>
                       
                        <th>Checkup ID</th>
                        <th>Pet ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                   
                      </thead>
                      <tbody>
                        @foreach ($checkups as $checkup)
                         <tr>
                          
                            <td>{{$checkup->id}}</td>
                            <td>{{$checkup->pet_id}}</td>
                            <td>{{$checkup->pet->name}}</td>
                           
                            <td>{{$checkup->status}}</td>
                            <td> <a href="{{ url('/check/'.$checkup->id) }}" class="btn btn-primary btn-sm">Check Up</a></td>
                            
                         </tr>
                        @endforeach
                      </tbody>
                   </table>               

            </div>
         </div>
    @endif

<div  class="col-sm-6 col-md-6">
    <h2>Pet Disease chart</h2>
    @if(empty($petDiseaseChart))
        <div id="app2"></div>
    @else
    
        <div class="row">
            {!! $petDiseaseChart->container() !!}
        </div>
       
             {!! $petDiseaseChart->script() !!}
        
     @endif
     </div>   
@endsection