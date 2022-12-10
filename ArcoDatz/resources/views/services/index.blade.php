@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
               
                 @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
                <div class="card-header">                  
                    <h4>Services</h4>    
                     <form action="{{ url('/services/shopping-cart') }}" method="GET">
                        
                     <div class="form-group">
                 <button type="submit" class="btn btn-primary">Next</button>
                </div>
             </form>
                                 
                </div>
                    <div class="card-body">
                        @foreach ($groomings->chunk(3) as $grooming)
                        <div class="row">
                            @foreach($groomings as $item)
                            <div class="col-md-4">              
                                <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5></div>
                                <ul>Price: {{$item->price}}</ul>
                                <div class="inline">
                                <a href="{{ url('/service/add-to-cart/'.$item->id) }}" class="button">Add to Cart</a>
                                <a href="{{ url('/service/info/'.$item->id) }}" class="button">View</a> 
                                </div>
                                <br>
                                <br>
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
                                 @foreach($item->images as $image)
                                 <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ asset('storage/images/groomings/'.$image->img_path) }}" width="100px" height="150px" alt="Image">
                                </div>
                                @endforeach
                                 <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                                
                            
                            </div>

                        @endforeach
                        </div>
                        <p></p>
                         @endforeach
                    </div>

            </div>
        </div>
    </div>

@endsection
       