@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Purchase Invoice </h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12 table-responsive">

                              <div class="col-md-6">
                                   <h3>INVOICE NO: {{$data[0]->invoiceID}}</h3>
                                   <h3>Supplier: {{$data[0]->supplier->name}}</h3>
                              </div>
                              <div class="col-md-6">
                                   {{date('Y-m-d h:i:s',strtotime($data[0]->created_at))}}
                              </div>
                              <table class="table table-bordered" id="myTable">
                                   <tr class="th">
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Batch ID</th>
                                        <th>QTY</th>
                                        <th>Cost Price</th>
                                        <th>MRP</th>
                                        <th>Warranty Type</th>
                                        <th>Warranty Period</th>
                                        <th colspan="3">Total</th>
                                   </tr>
                                   @php
                                   $i=0;
                                   $sub=0;
                                   @endphp
                                   @foreach ($data as $p)
                                   @php
                                   $i+=1;
                                   $sub+=$p->cost_price*$p->qty;
                                   @endphp
                                   <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$p->product->name}}</td>
                                        <td>{{$p->batchID}}</td>
                                        <td>{{$p->qty}}</td>
                                        <td class="text-right">{{number_format($p->cost_price,2)}}</td>
                                        <td class="text-right">{{number_format($p->mrp,2)}}</td>
                                        <td>{{$p->warranty_type}}</td>
                                        <td>{{$p->warranty_period}}</td>
                                        <td class="text-right" colspan="3">
                                             {{number_format($p->cost_price*$p->qty,2)}}
                                        </td>
                                   </tr>
                                   @endforeach
                                   <tr class="foot_cal">
                                        <th colspan="9" class="text-right">Sub Total =</th>
                                        <th class="sub text-right">{{number_format($sub,2)}}</th>
                                   </tr>
                                   <tr class="foot_cal">
                                        <th colspan="7" class="text-right">
                                             Discount Type: <span
                                                  class="text-uppercase">{{$data[0]->discount_type}}</span>
                                        </th>
                                        <th colspan="2" class="text-right">
                                             Discount =
                                        </th>
                                        <th class="text-right">{{$data[0]->discount}}</th>
                                   </tr>
                                   <tr class="foot_cal">
                                        <th colspan="9" class="text-right">Grand Total =</th>
                                        <th class="gr_t text-right">{{number_format($sub-$data[0]->discount,2)}}</th>
                                   </tr>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection