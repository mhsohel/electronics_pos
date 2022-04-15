@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Pending PO List </h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         @if(session()->has('msg'))
                         <div class="alert alert-success">
                              {{ session()->get('msg') }}
                         </div>
                         @endif
                         <div class="col-md-12 table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example1">
                                   <thead class="bg-primary">
                                        <tr class="th">
                                             <th>SL</th>
                                             <th>Invoice ID</th>
                                             <th>Date</th>
                                             <th>Supplier</th>
                                             <th>Discount</th>
                                             <th>Total</th>
                                             <th>Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        @php
                                        $i=0;
                                        @endphp
                                        @foreach ($list as $p)
                                        @php
                                        $i+=1;
                                        @endphp
                                        <tr>
                                             <td>{{$i}}</td>
                                             <td>{{$p->invoiceID}}</td>
                                             <td>{{date('Y-m-d',strtotime($p->created_at))}}</td>
                                             <td>{{$p->supplier->name}}</td>
                                             <td class="text-right">{{number_format($p->discount,2)}}</td>
                                             <td class="text-right">{{number_format($p->total,2)}}</td>
                                             <td>
                                                  <form action="{{route('purchase.destroy',$p->invoiceID)}}"
                                                       method="post">
                                                       <a href="{{route('grn',$p->invoiceID)}}"
                                                            class="btn btn-xs btn-info">GRN</a>
                                                       <a href="{{route('purchase.show',$p->invoiceID)}}"
                                                            class="btn btn-xs btn-primary">View</a>
                                                       <a href="{{route('purchase.edit',$p->invoiceID)}}"
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