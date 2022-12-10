<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <nav>
  
  @include('layouts.navi')

  </nav>
  <title>Pet Clinic</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

</head>
<body>
  <div class="container"> 
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
    @include('layouts.header')
<div class="container">
 <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deleted Customers
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <td>ID</td>
                               <td>Name</td>
                               <td>Email</td>
                               <td>Role</td>
                               <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->role}}</td>
                                
                                <td>
                                    <a href="{{ url('/changerole/'.$item->id) }}" class="btn btn-primary btn-sm">Change Role</a>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>