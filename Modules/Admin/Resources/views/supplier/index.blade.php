@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add Supplier </h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              @if ($errors->any())
                              <div class="alert alert-danger">
                                   <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                   </ul>
                              </div>
                              @endif
                              <form action="{{ route('supplier.store') }}" method="POST">
                                   @csrf

                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Supplier Name</th>
                                             <th><input type="text" name="name" class="form-control"
                                                       placeholder="Enter Supplier name" value="{{ old('name') }}"></th>
                                             <th>Supplier Name</th>
                                             <th><input type="text" name="phone" class="form-control"
                                                       placeholder="Enter phone" value="{{ old('phone') }}"></th>

                                        </tr>
                                        <tr>
                                             <th>Email</th>
                                             <th><input type="text" name="email" class="form-control"
                                                       placeholder="Enter email" value="{{ old('email') }}"></th>
                                             <th>Bank Account No</th>
                                             <th><input type="text" name="bank_account" class="form-control"
                                                       placeholder="Enter Bank Account No"
                                                       value="{{ old('bank_account') }}"></th>

                                        </tr>
                                        <tr>
                                             <th>Address</th>
                                             <th colspan="2">
                                                  <textarea name="address" id="" cols="15" rows="3"
                                                       class="form-control">{{ old('address') }}</textarea>
                                             </th>
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
                    <h5>Supplier List</h5>
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
                                             <th> Name</th>
                                             <th> Email</th>
                                             <th> Phone</th>
                                             <th> Address</th>
                                             <th> Bank Account</th>
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
                                             <td>{{$l->email}}</td>
                                             <td>{{$l->phone}}</td>
                                             <td>{{$l->address}}</td>
                                             <td>{{$l->bank_account}}</td>
                                             <td>
                                                  <form action="{{route('supplier.destroy',$l->id)}}" method="post">
                                                       <a href="{{route('supplier.edit',$l->id)}}"
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