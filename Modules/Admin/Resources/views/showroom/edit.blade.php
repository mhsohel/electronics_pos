@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Edit Showroom </h5>
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
                              <form action="{{ route('showroom.update',$edit->id) }}" method="POST"
                                   enctype="multipart/form-data">
                                   @csrf
                                   @method('PUT')
                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Name</th>
                                             <th>
                                                  <input type="text" name="name" class="form-control"
                                                       value="{{ $edit->name }}" required>
                                             </th>
                                             <th>Phone</th>
                                             <th>
                                                  <input type="text" name="phone" class="form-control"
                                                       value="{{ $edit->phone }}" required>
                                             </th>
                                             <th>Email</th>
                                             <th>
                                                  <input type="email" name="email" class="form-control"
                                                       value="{{ $edit->email }}" required>
                                             </th>
                                        </tr>
                                        <tr>
                                             <th>Bank Account</th>
                                             <th>
                                                  <input type="text" name="bank_account" class="form-control"
                                                       value="{{ $edit->bank_account }}" required>
                                             </th>
                                             <th>Address</th>
                                             <th colspan="3">
                                                  <input type="text" name="address" class="form-control"
                                                       value="{{ $edit->address }}" required>
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
@endsection