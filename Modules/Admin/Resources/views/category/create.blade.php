@extends('layouts.app')

@section('content')
<div class="container">
     <div class="panel">
          <div class="panel-head">
               <h2>New Category</h2>
          </div>
          <div class="panel-body">
               <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="row">
                         <div class="col-xs-10 col-sm-10 col-md-10">
                              <div class="form-group">
                                   <strong>Category Name:</strong>
                                   <input type="text" name="name" class="form-control" placeholder="Enter name">
                              </div>
                         </div>
                         <div class="col-xs-2 col-sm-2 col-md-2 text-center">
                              <strong>&nbsp</strong><br>
                              <button type="submit" class="btn btn-primary">Submit</button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</div>
@endsection