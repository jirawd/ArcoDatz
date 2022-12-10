@extends('employee.base')
@section('body')
 <div class="container">
      <h2>Check Up</h2><br/>
      <form action="{{ url('/update-checkup/'.$checkup->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                             <label for="haircut_name">Pet Name: {{$checkup->pet->name}}</label>
                        </div>

                        <div class="form-group mb-3">
                            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
                            width: 150px; ">Disease</label>
                              <select name="disease">
                                <option value="Canine distemper">Canine distemper</option>
                                <option value="Canine influenza">Canine influenza</option>
                                <option value="Canine parvovirus">Canine parvovirus</option>
                                <option value="External parasites">External parasites</option>
                                <option value="Heartworms">Heartworms</option>
                              </select>
                        </div>

                       

                        <div class="form-group mb-3">
                           <label for="comments">Comment:</label>
                        <textarea class="form-control" name="comments" placeholder="Your comment"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update checkup</button>
                        </div>

                    </form>
    </div>
@endsection