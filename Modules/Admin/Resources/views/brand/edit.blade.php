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
                              <form action="{{ route('brand.update',$edit->id) }}" method="POST">
                                   @csrf
                                   @method('PUT')
                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Brand Name</th>
                                             <th><input type="text" name="name" class="form-control"
                                                       placeholder="Enter name" value="{{$edit->name}}"></th>
                                             <th><button type="submit" class="btn btn-primary btn-block">Save</button>
                                             </th>
                                        </tr>
                                        <tr>
                                             <th colspan="2">
                                                  @foreach ($category as $c)
                                                  <input type="checkbox" name="category_id[]" value="{{$c->id}}"
                                                       @if(in_array($c->id,$categoryID)){{ "checked"}}@endif>&nbsp
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


@endsection