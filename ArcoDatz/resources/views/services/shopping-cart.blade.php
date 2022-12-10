<!-- //views/shop/shopping.blade.php -->
@extends('layouts.master')
@section('title')
CHOSEN GROOMING SERVICE
@endsection
@section('content')
@if(Session::has('cart'))
<div class="row">
    <div class="col-md-12">
         <div class="form-group"> 
            

        <a href="{{ url('/services') }}" class="btn btn-primary float-end">Back</a>
          

        <ul class="list-group">
            <div class="card-body">
                     <form action="{{ url('/service/checkout') }}" method="POST" enctype="multipart/form-data">
                        @csrf            
                        
                    </div>
            @foreach($groomings as $grooming)
            <li class="list-group-item">
                <div class="col-md-6">
                <!-- <span class="badge">{{ $grooming['qty'] }}</span> -->
                <strong><h4>{{ $grooming['grooming']['name'] }}</h4></strong><p></p>
                <input type="hidden" name="grooming_id" value="{{ $grooming['grooming']['id'] }}">
                        
                <span class="label label-success">{{ $grooming['grooming']['price'] }}</span>
               <!-- <span class="label label-success">{{ $grooming['grooming']['name'] }}</span> -->
               <select name="pet_id[{{ $grooming['grooming']['id'] }}]"  class="form-select">
                        @foreach($pet as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                        </select>
                        </div>
                <div class="btn-group">                
                       <button class="button"> <a href="{{ route('service.remove',['id'=>$grooming['grooming']['id']]) }}">Remove</a></button>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <strong>Total: {{ $totalPrice }}</strong> 
        

    </div>
</div>
<hr>
<div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </div>
                    </form>
@else
<div class="row">
    <a href="{{ url('/services') }}" class="btn btn-primary float-end">Back</a>
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <h2>No Chosen Service in Cart!</h2>
    </div>
</div>
@endif
@endsection