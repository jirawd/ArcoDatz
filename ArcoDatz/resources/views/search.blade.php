@extends('layouts.base')
@section('title')
  {{-- item --}}
@endsection
@section('body')

{{-- {{dd($searchResults->groupByType())}} --}}
<link href="{{ URL::asset('app.css') }}" rel="stylesheet">
<div class = "container">
  <h3><span>{{ $pet->name }}'s Medical History</span></h3>


<div class="table-wrapper">
    
  <tr align ="center">
    <td colspan="2">There are {{ $searchResults->count() }} results.</td>
  </tr>


  @foreach($searchResults->groupByType() as $type => $modelSearchResults)
     
     
          <table class="table table-hover">
                      <thead>
                       
                        <th>Checkup ID</th>
                        <th>Pet ID</th>
                        <th>Employee ID</th>
                        <th>Diseases</th>
                        <th>Comments</th>
                        <th>Status</th>
                        <th>Check Up Date</th>
                   
                      </thead>
                      <tbody>
                       @foreach($modelSearchResults as $searchResult)
                         <tr>
                          
                            <td>{{$searchResult->searchable->id}}</td>
                            <td>{{$searchResult->searchable->pet_id}}</td>
                            <td>{{$searchResult->searchable->employee_id}}</td>
                            <td>{{$searchResult->searchable->disease}}</td>
                            <td>{{$searchResult->searchable->comments}}</td>
                            <td>{{$searchResult->searchable->status}}</td>
                            <td>{{$searchResult->searchable->checkupdate}}</td>
                        
                            
                            
                         </tr>
                        @endforeach
                      </tbody>
                   </table>   
        
     @endforeach

@endsection