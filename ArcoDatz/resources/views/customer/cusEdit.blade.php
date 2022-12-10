@extends('customer.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Edit Customer
                        <a href="{{ url('/customerprofile') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('/update-customer/'.$customer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                             <label for="title">Title</label>
                             <input type="text" value="{{$customer->title}}" class="form-control" name="title"/>
                        </div>

                        <div class="form-group mb-3">
                             <label for="fname">First Name:</label>
                             <input type="text" value="{{$customer->fname}}" class="form-control" name="fname"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="lname">Last Name:</label>
                            <input type="text" value="{{$customer->lname}}" class="form-control" name="lname"/>
                        </div>
                        
                        <div class="form-group mb-3">    
                            <label for="addrline">Address:</label>
                            <input type="text" value="{{$customer->addressline}}" class="form-control" name="addressline"/>
                        </div>

                        <div class="form-group mb-3">    
                            <label for="town">Town:</label>
                            <input type="text" value="{{$customer->town}}" class="form-control" name="town"/>
                        </div>

                        <div class="form-group mb-3">    
                            <label for="zipcode">Zipcode:</label>
                            <input type="text" value="{{$customer->zipcode}}" class="form-control" name="zipcode"/>
                        </div>

                        <div class="form-group mb-3">    
                            <label for="phone">Phone:</label>
                            <input type="text" value="{{$customer->phonenumber}}" class="form-control" name="phonenumber"/>
                        </div>




                        <div class="form-group mb-3">
                            <label for="">Customer Image</label>
                            <input type="file" name="img_path" class="form-control">
                            <img src="{{ asset('storage/images/customers/'.$customer->img_path) }}" width="70px" height="70px" alt="Image">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Customer</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection