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
                               <td>Title</td>
                               <td>Last Name</td>
                               <td>First Name</td>
                               <td>Address </td>
                               <td>Town </td>
                               <td>Zipcode </td>
                               <td>Phone </td>
                               <td>Image</td>
                               <td>Actions</td>
                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->lname}}</td>
                                <td>{{$item->fname}}</td>
                                <td>{{$item->addressline}}</td>
                                <td>{{$item->town}}</td>
                                <td>{{$item->zipcode}}</td>
                                <td>{{$item->phonenumber}}</td>
                                
                                <td>

                                    <img src="{{ asset('storage/images/Customers/'.$item->img_path) }}" width="70px" height="70px" alt="Image">
                                </td>
                                <td>
                                    <a href="{{ url('/customers/restore/one/'.$item->id) }}" class="btn btn-primary btn-sm">Restore</a>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deleted Employee
                     
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <td>ID</td>
                               <td>Title</td>
                               <td>Last Name</td>
                               <td>First Name</td>
                               <td>Address </td>
                               <td>Town </td>
                               <td>Zipcode </td>
                               <td>Phone </td>
                               <td>Image</td>
                               <td>Actions</td>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->lname}}</td>
                                <td>{{$item->fname}}</td>
                                <td>{{$item->addressline}}</td>
                                <td>{{$item->town}}</td>
                                <td>{{$item->zipcode}}</td>
                                <td>{{$item->phonenumber}}</td>
                                
                                <td>

                                    <img src="{{ asset('storage/images/employees/'.$item->img_path) }}" width="70px" height="70px" alt="Image">
                                </td>
                                <td>
                                    <a href="{{ url('employees/restore/one/'.$item->id) }}" class="btn btn-primary btn-sm">Restore</a>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deleted Pets
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <td>ID</td>
                               <td>Name</td>
                               <td>Type</td>
                               <td>Breed</td>
                           
                               <td>Image</td>
                               <td>Actions</td>
                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pet as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->breed}}</td>
                                <td>
                                    <img src="{{ asset('storage/images/pets/'.$item->img_path) }}" width="70px" height="70px" alt="Image">
                                </td>
                                <td>
                                    <a href="{{ url('pets/restore/one/'.$item->id) }}" class="btn btn-primary btn-sm">Restore</a>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deleted Grooming
                     
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <td>ID</td>
                               <td>Name</td>
                               <td>Description</td>
                               <td>Price</td>
                               <td>Actions</td>
                           
                       
                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groomings as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->price}}</td>
                
                               
                                <td>
                                    <a href="{{ url('groomings/restore/one/'.$item->id) }}" class="btn btn-primary btn-sm">Restore</a>
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
 </div>
<!--   <script src="{{ asset('js/app.js') }}" type="text/js"></script> -->
</body>
</html>
