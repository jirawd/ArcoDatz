@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">          
                    <h4>Customer Transactions</h4>       
                </div>
                <form action="{{ route('searchservice') }}" method="POST">
                @csrf
                <input type="text" name="query" />
                <input type="submit" class="btn btn-sm btn-primary" value="Search" />
            </form>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <td>Service ID</td>
                               <td>Service Date</td>
                               <td>Customer Name</td>
                                <td>Status</td> 
                                <td>Edit</td>
                                <td>Check</td>
            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trans as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->sdate}}</td>
                                
                                <td>{{$item->fname}}</td>
                        
                                <td>{{$item->status}}</td>
                                <td><a href="{{url('/updateService/'.$item->id)}}" class="btn btn-primary btn-sm">Paid</a>
                                <td><a href="{{url('/checkService/'.$item->id)}}" class="btn btn-primary btn-sm">Check</a>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div>
    </div>

@endsection
       