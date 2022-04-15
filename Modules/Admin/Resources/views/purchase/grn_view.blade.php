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
                              <form action="{{ route('grn_update',$data[0]->invoiceID) }}" method="POST"
                                   enctype="multipart/form-data">
                                   @csrf
                                   @method('PUT')
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
                                             <th>Ordered QTY</th>
                                             <th>Cost Price</th>
                                             <th>Received QTY</th>
                                             <th>Total</th>
                                             <th>Good Receive Note</th>
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
                                             <td>{{$p->order_qty}}</td>
                                             <td>{{$p->cost_price}}</td>
                                             <td>{{$p->qty}}</td>
                                             <td class="text-righ tl">{{$p->cost_price*$p->qty}}</td>
                                             <td>{{$p->grn}}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="foot_cal">
                                             <th colspan="6" class="text-right">Sub Total =</th>
                                             <th class="sub text-right">{{number_format($sub,2)}}</th>
                                             <th></th>
                                        </tr>
                                        <tr class="foot_cal">
                                             <th colspan="4" class="text-right">
                                                  Discount Type: <span
                                                       class="text-uppercase">{{$data[0]->discount_type}}</span>
                                             </th>
                                             <th colspan="2" class="text-right">
                                                  Discount =
                                             </th>
                                             <th class="text-right discount">{{$data[0]->discount}}</th>
                                             <th></th>
                                        </tr>
                                        <tr class="foot_cal">
                                             <th colspan="6" class="text-right">Grand Total =</th>
                                             <th class="text-right">{{number_format($sub-$data[0]->discount,2)}}
                                             </th>
                                             <th></th>
                                        </tr>
                                   </table>
                         </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection