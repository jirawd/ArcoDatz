@extends('layouts.base')
@section('title')
  {{-- item --}}
@endsection
@section('body')

{{-- {{dd($searchResults->groupByType())}} --}}
<link href="{{ URL::asset('app.css') }}" rel="stylesheet">
<div class = "container">
  <h3><span>{{ $customer->fname }}'s Service Transaction History</span></h3>


<div class="table-wrapper">
    
  <tr align ="center">
    <td colspan="2">There are {{ $searchResults->count() }} results.</td>
  </tr>


  @foreach($searchResults->groupByType() as $type => $modelSearchResults)
     
     
          <table class="table table-hover">
                      <thead>
                       
                        <th>Service ID</th>
                        <th>Customer ID</th>
                        <th>Employee ID</th>
                
               
                        <th>Status</th>
                        <th>Service Date</th>
                   
                      </thead>
                      <tbody>
                       @foreach($modelSearchResults as $searchResult)
                         <tr>
                          
                            <td>{{$searchResult->searchable->id}}</td>
                            <td>{{$searchResult->searchable->customer_id}}</td>
                            <td>{{$searchResult->searchable->employee_id}}</td>
                          
                            <td>{{$searchResult->searchable->status}}</td>
                            <td>{{$searchResult->searchable->service_date}}</td>
                        
                            
                            
                         </tr>
                        @endforeach
                      </tbody>
                   </table>   
        
     @endforeach

@endsection