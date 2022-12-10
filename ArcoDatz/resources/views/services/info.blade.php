@extends('layouts.master')

@section('content')


    <div class="row">
         @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Service Informations
                    </h4>
                    <a href="{{ url('/services') }}" class="btn btn-primary float-end">Back</a>
                </div>
                
                <div class="card-body">
                     <a href="{{ url('/service/add-to-cart/'.$groomings->id) }}" class="button">Add to Cart</a>               
                        <div class="form-group mb-3">
                             <label for="type">Service ID:</label>
                             <input type="text" value="{{$groomings->id}}" class="form-control" name="groomings_id"/>
                        </div>

                      <div class="column">                    
                         <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
                                 @foreach($groomings->images as $image)
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
                        <label>
                             <label for="name">Name:</label>
                             <input type="text" value="{{$groomings->name}}" class="form-control" name="name" readonly />
                             <label for="type">Price:</label>
                             <input type="text" value="{{$groomings->price}}" class="form-control" name="type" readonly />
                        </label>
             
                    </div>
                   
                
                <form action="/service/comments" method="post">
                    @csrf 
                    <input type="hidden" value="{{$groomings->id}}" class="form-control" name="groomings_id"/>

                    <div class="form-group mb-3">
                             <label for="name">Name:</label>
                             <input type="text" class="form-control" name="name" placeholder="Optional" />
                        </div>
                   
                        <p></p>
                   <div class="form-group">     
                <textarea name="comments" placeholder="Comment here" rows="4" cols="70"></textarea>
                <input type="submit" value="Submit"></div>
                </form>
                <h4>Comments</h4>
                 @foreach($comment as $item)
                <div class="form-group"> 
                   
                                        
                    <label><img src="{{ asset('storage/images/customers/guest.png') }}" width="70px" height="70px" alt="Image">
                        Name: {{$item->name}}</label></div>
                 <ul> <ul> <ul><label>{{$item->comment}}</label></ul> </ul></ul>
                </div>
                @endforeach
                </div>

            </div>
        </div>
    </div>


@endsection
       