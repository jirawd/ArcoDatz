@extends('layouts.master')

@section('content')
    
    <div class="container">
         <div class="row">
            <!-- <div class="col-md-6 col-md-offset-3"> -->
                   <h4>Profile</h4><hr>
                     @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
                   <table class="table table-hover">
                      <thead>
                       
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                   
                      </thead>
                      <tbody>
                         <tr>
                          
                            <td>{{Auth::user()->name}}</td>
                            <td>{{Auth::user()->email}}</td>
                            <td>{{Auth::user()->role}}</td>
                            
                         </tr>
                      </tbody>
                   </table>               
<div style="text-align:center;" id="navigation">
<ul>
<button class="button" style="vertical-align:middle"><a href="/customers"><span>Customer CRUD</span></button><p></p>
<button class="button" style="vertical-align:middle"><a href="/pets"><span>Pets CRUD</span></button><p></p>
<button class="button" style="vertical-align:middle"><a href="/employees"><span>Employees CRUD</span></button><p></p>
<button class="button" style="vertical-align:middle"><a href="/groomings"><span>Grooming CRUD</span></button><p></p>
<button class="button" style="vertical-align:middle"><a href="/deleteddata"><span>Deleted Data</span></button><p></p>
<button class="button" style="vertical-align:middle"><a href="/roles"><span>Employee Role</span></button><p></p>


</ul>
</div>
            </div>
         </div>
    </div>
@endsection