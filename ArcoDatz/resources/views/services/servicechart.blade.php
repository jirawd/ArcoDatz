 @extends('layouts.master')
 @section('content')

  <div class="container my-4">
  
  <!--Grid row-->
  
  <div class="row">  
    <!--Grid column-->
    <form action="{{ url('/changedate') }}" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="col-md-6 mb-4">
      <div class="md-form">
        <!--The "from" Date Picker -->
        <input placeholder="Selected starting date" type="date" name="startingDate"  class="form-control datepicker">
        <label for="startingDate">start</label>
      </div>

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-6 mb-4">

      <div class="md-form">
        <!--The "to" Date Picker -->
        <input placeholder="Selected ending date" type="date" name="endingDate"  class="form-control datepicker">
        <label for="endingDate">end</label>
      </div>

    </div>
    <!--Grid column-->
    <div class="form-group mb-3">
    <button type="submit" class="btn btn-primary">Send Date</button>
     </div>
     </form>
 
  </div>
     <div  class="col-sm-6 col-md-6">
    <h2>Customer Service chart</h2>
    @if(empty($ServiceChart))
        <div id="app2"></div>
    @else
    
        <div class="row">
            {!! $ServiceChart->container() !!}
        </div>
       
             {!! $ServiceChart->script() !!}
        
     @endif
     </div>   
  <!--Grid row-->
</div>
@endsection