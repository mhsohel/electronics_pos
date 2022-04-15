@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add Category </h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              <form action="{{ route('category.update',$data->id) }}" method="POST">
                                   @csrf
                                   @method('PUT')
                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Category Name</th>
                                             <th><input type="text" name="name" class="form-control"
                                                       placeholder="Enter name" value="{{$data->name}}"></th>
                                             <th><button type="submit" class="btn btn-primary btn-block">Save</button>
                                             </th>
                                        </tr>
                                   </table>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Category List</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              <table class="table table-bordered">
                                   <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                   </tr>
                                   @php
                                   $i=0;
                                   @endphp
                                   @foreach ($list as $l)
                                   <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$l->name}}</td>
                                        <td>
                                             <form action="{{route('category.destroy',$l->id)}}" method="post">
                                                  <a href="{{route('category.edit',$l->id)}}"
                                                       class="btn btn-xs btn-success">Edit</a>
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-xs btn-danger"
                                                       onclick="return confirm('Are you sure?')">Delete</button>
                                             </form>
                                        </td>
                                   </tr>
                                   @endforeach
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection