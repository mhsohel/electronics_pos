@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add Brand </h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              <form action="{{ route('brand.store') }}" method="POST">
                                   @csrf
                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Brand Name</th>
                                             <th><input type="text" name="name" class="form-control"
                                                       placeholder="Enter name"></th>
                                             <th><button type="submit" class="btn btn-primary btn-block">Save</button>
                                             </th>
                                        </tr>
                                        <tr>
                                             <th colspan="2">
                                                  @foreach ($category as $c)
                                                  <input type="checkbox" name="category_id[]" value="{{$c->id}}">&nbsp
                                                  {{$c->name}} &nbsp
                                                  @endforeach

                                                  {{-- {{!! DNS1D::getBarcodeHTML('00000001', 'C39')!!}} --}}
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
                    <h5>Brand List</h5>
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
                                             <th>Brand Name</th>
                                             <th>Categories</th>
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
                                             <td>{{$l->name}}</td>
                                             <td>
                                                  @forelse ($l->categories as $c)
                                                  <a href="">{{$c->name}}</a>,
                                                  @empty

                                                  @endforelse
                                             </td>
                                             <td>
                                                  <form action="{{route('brand.destroy',$l->id)}}" method="post">
                                                       <a href="{{route('brand.edit',$l->id)}}" class="btn btn-xs btn-success">Edit</a>
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