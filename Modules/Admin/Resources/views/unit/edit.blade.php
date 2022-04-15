@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add Unit </h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              <form action="{{ route('unit.update',$data->id) }}" method="POST">
                                   @csrf
                                   @method('PUT')
                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Unit Name</th>
                                             <th><input type="text" name="unit" value="{{$data->unit}}"
                                                       class="form-control" placeholder="Enter Unit name"></th>
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
                    <h5>Unit List</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              <table class="table table-striped table-bordered table-hover dataTables-example">
                                   <thead>
                                        <tr>
                                             <th>SL</th>
                                             <th>Unit Name</th>
                                             <th>Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>


                                        @php
                                        $i=0;
                                        @endphp
                                        @foreach ($list as $l)
                                        <tr>
                                             <td>{{++$i}}</td>
                                             <td>{{$l->unit}}</td>
                                             <td>
                                                  <form action="{{route('unit.destroy',$l->id)}}" method="post">
                                                       <a href="{{route('unit.edit',$l->id)}}"
                                                            class="btn btn-xs btn-success">Edit</a>
                                                       @csrf
                                                       @method('DELETE')
                                                       <button type="submit" class="btn btn-xs btn-danger"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                  </form>
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


@endsection