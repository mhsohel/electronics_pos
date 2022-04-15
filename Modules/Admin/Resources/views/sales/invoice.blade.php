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
                                   @if(!empty($data[0]->dealer_id))
                                        <h3>Dealer: {{$data[0]->dealer->name}}</h3>
                                   @endif
                                   @if(!empty($data[0]->showroom_id))
                                        <h3>Showroom: {{$data[0]->showroom->name}}</h3>
                                   @endif
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
                                        <th>MRP</th>
                                        <th>Discount</th>
                                        <th>Discount Type</th>
                                        <th>Warranty Type</th>
                                        <th colspan="3">Total</th>
                                   </tr>
                                   @php
                                   $i=0;
                                   $sub=0;
                                   @endphp
                                   @foreach ($data as $p)
                                   @php
                                   $discount=0;
                                   if($p->discount_type=='percent'){
                                        $discount= $p->mrp*$p->discount/100;
                                   }
                                   if($p->discount_type=='fixed'){
                                        $discount= $p->discount;
                                   }

                                   $i+=1;
                                   $sub+=$p->mrp*$p->qty - $discount;
                                   @endphp
                                   <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$p->product->name}}</td>
                                        <td>{{$p->batchID}}</td>
                                        <td>{{$p->qty}}</td>
                                        <td class="text-right">{{number_format($p->mrp,2)}}</td>
                                        <td>{{$p->discount}}</td>
                                        <td>{{$p->discount_type}}</td>
                                        <td>{{$p->warranty_type}}</td>
                                        <td class="text-right" colspan="3">
                                             {{$p->mrp*$p->qty - $discount}}
                                        </td>
                                   </tr>
                                   @endforeach
                                   <tr class="foot_cal">
                                        <th colspan="9" class="text-right">Grand Total =</th>
                                        <th class="sub text-right">{{number_format($sub,2)}}</th>
                                   </tr>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection