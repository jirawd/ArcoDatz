@extends('pet.layout')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Add pet
                        <a href="{{ url('/customerprofile') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('/add-pet/'.$customer) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3>Owner: {{$owner->fname}} {{$owner->lname}}</h3>
                        <div class="form-group mb-3">
                             <label for="name">Name:</label>
                             <input type="text" class="form-control" name="name"/>
                        </div>

                        <div class="form-group mb-3">
                             <label for="type">Type:</label>
                             <input type="text" class="form-control" name="type"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="breed">Breed:</label>
                            <input type="text" class="form-control" name="breed"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="img_path" class="control-label">Select image to upload:</label>
                            <input type="file" name="img_path" class="form-control" >
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Pet</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection


