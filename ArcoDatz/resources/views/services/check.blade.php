@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <h4>Customer Transactions</h4>       
                                  
                    <a href="{{ url('/servicetransactions') }}" class="btn btn-primary float-end">Back</a>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <td>Pet Name</td>
                               <td>Grooming Name</td>
                               <td>Description</td>
                                <td>Price</td> 
                           
            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service as $item)
                            <tr>
                                <td>{{$item->pname}}</td>
                                <td>{{$item->gname}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->price}}</td>
                        
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div>
    </div>

@endsection
       