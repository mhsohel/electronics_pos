@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add Dealer </h5>
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
                              <form action="{{ route('dealer.store') }}" method="POST" enctype="multipart/form-data">
                                   @csrf
                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Name</th>
                                             <th>
                                                  <input type="text" name="name" class="form-control"
                                                       value="{{ old('name') }}" required>
                                             </th>
                                             <th>Phone</th>
                                             <th>
                                                  <input type="text" name="phone" class="form-control"
                                                       value="{{ old('phone') }}" required>
                                             </th>
                                             <th>Email</th>
                                             <th>
                                                  <input type="email" name="email" class="form-control"
                                                       value="{{ old('email') }}" required>
                                             </th>
                                        </tr>
                                        <tr>
                                             <th>Bank Account</th>
                                             <th>
                                                  <input type="text" name="bank_account" class="form-control"
                                                       value="{{ old('bank_account') }}" required>
                                             </th>
                                             <th>Address</th>
                                             <th colspan="3">
                                                  <input type="text" name="address" class="form-control"
                                                       value="{{ old('address') }}" required>
                                             </th>
                                        </tr>
                                        <tr>
                                             <th>Logo</th>
                                             <th>
                                                  <input type="file" name="logo" class="form-control">
                                             </th>
                                             <th colspan="4">
                                                  <input type="submit" class="btn btn-block btn-primary" required>
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
                    <h5>Showroom List</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              <table class="table table-striped table-bordered table-hover dataTables-example1">
                                   <thead class="bg-primary">
                                        <tr>
                                             <th>SL</th>
                                             <th>Logo</th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Phone</th>
                                             <th>Bank Account</th>
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
                                             <td><img src="{{asset('images/showroom/'.$l->logo)}}" alt="" width="90"
                                                       height="100"></td>
                                             <td>{{$l->name}}</td>
                                             <td>{{$l->email}}</td>
                                             <td>{{$l->phone}}</td>
                                             <td>{{$l->bank_account}}</td>
                                             <td>
                                                  <form action="{{route('dealer.destroy',$l->id)}}" method="post">
                                                       <a href="{{route('dealer.edit',$l->id)}}"
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
                              <div class="col-md-12 text-center">
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

@endsection