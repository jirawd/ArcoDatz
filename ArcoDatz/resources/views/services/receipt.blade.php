@extends('services.master')

@section('content')
<p></p>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>ArcoDatz Pet Receipt</h2>
                    
                </div>
                <div class="card-body">
                    <label><h6>Service Date:{{$service[0]->sdate}}</h6> </label><p></p>
                 <label><h4>Customer Name: {{$service[0]->fname}} {{$service[0]->lname}}</h4> </label>  

                
                
                   <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <td>Pet Name</td>
                               <td>Service</td>
                               <td>Price</td>
                            </tr>
                            </thead>
                        <tbody>
                            @foreach($service as $item )
                            <tr>
                                <td>{{$item->pname}}</td>
                                <td>{{$item->hname}}</td>
                                <td>{{$item->price}}</td>
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                          
                        
        <label for="name">Total: {{$total}}</label>
                            
                   

            </div>
        </div>
@endsection
