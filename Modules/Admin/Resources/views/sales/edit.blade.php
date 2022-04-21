@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-lg-12">
<div class="ibox">
<div class="ibox-title">
<h5>Update Purchase</h5>
<div class="ibox-tools">
<a class="collapse-link">
<i class="fa fa-chevron-up"></i>
</a>
</div>
</div>
<div class="ibox-content">
<div class="row">
<div class="col-md-12 table-responsive">
@if(Session::has('error'))
<div class="alert alert-danger">
<ul>
<li>{{ Session::get('error')}}</li>
</ul>
</div>
@endif
<form action="{{route('sales.store')}}" method="POST">
@csrf
<!-- <input type="hidden" name="_token" value="zGz8gIY90dUq20GGeELKSh6jRuXF4cg9bSuoNzka"> -->
<table class="table table-bordered" id="myTable">
<tr>
<!-- <th colspan="2">
<input type="text" id="barcode" class="form-control" placeholder="Scan barcode">
</th> -->
<th colspan="2">
{!! Form::select('', $p_list, '', ['class' =>
'form-control chosen-select','id'=>'product']) !!}
</th>
<th colspan="2">
<div class="form-check form-check-inline">
     <input class="form-check-input " type="radio" name="dealorshow" id="show" value="showroom" {{$showroom_id->showroom_id != '' ? 'checked':''}}>
     <label class="form-check-label " for="show">Showroom</label>
</div>
<div class="form-check form-check-inline">
     <input class="form-check-input" type="radio" name="dealorshow" id="deal" value="dealer" {{$dealer_id->dealer_id != '' ? 'checked':''}}>
     <label class="form-check-label" for="deal">Dealer</label>
</div>
<select class="form-control chosen-select" id="showroom" name="showroom" >
    <option value="">Select Showroom</option>
    @foreach($showroom as $show)
    <option value="{{$show->id}}" @if($show->id == $showroom_id->showroom_id) selected @endif>{{$show->name}}</option>
    @endforeach
</select>
<select class="form-control chosen-select" id="dealer" name="dealer">
    <option value="">Select Dealer</option>
    @foreach($dealer as $deal)
    <option value="{{$deal->id}}" @if($deal->id == $dealer_id->dealer_id) selected @endif>{{$deal->name}}</option>
    @endforeach
</select>
</th>
<th colspan="2">
<input type="text" class="form-control date" placeholder="" id="date_modified" value="<?php echo date("Y-m-d"); ?>">
</th>
<th></th>
</tr>
<tr class="th">
<th>SL</th>
<th>Product Name</th>
<th>Batch Id</th>
<th>QTY</th>
<th>MRP</th>
<th>Discount</th>
<th>Total</th>
</tr>
@php 
$i=0;
$total_dis=0;
$subtotal = 0;
@endphp
@foreach($sales as $sale)
@php 
$i++; 
$price = $sale->qty * $sale->mrp;
$dis = $sale->discount;
if($sale->discount_type == 'percent'){
    $dis_t = ($price / 100) * $dis;
}else{
    $dis_t = $dis;
}
$total_dis += $dis_t; 
$subtotal += $price - $dis_t;
@endphp 
<tr class="uni_'+productId+'">
     <th class="sl">{{$i}}</th>
     <th><input type="hidden" class="productID" name="product_id[]" value="{{$sale->product_id}}">{{$sale->product->name}} [ {{$sale->product->size->size}}, {{$sale->product->color->color}}]</th>
     <th class="wm">
        <select class="form-control chosen-select cus-width batchId" data-id="{{$sale->product_id}}" id="batchId" name="batchId[]">
            <option value="">Select Batch</option>
            @php $allBatchID = App\Models\Purchase::select('batchID')->where('product_id',$sale->product_id)->get(); @endphp
            @foreach($allBatchID as $batch)
            <option value="{{$batch->batchID}}" @if($batch->batchID == $sale->batchID) selected @endif>{{$batch->batchID}}</option>
            @endforeach
        </select>
     </th>
     <th><input type="text" class="form-control qty" value="{{intval($sale->qty)}}" name="qty[]"></th>
     <th><input type="text" class="form-control mrp" value="{{$sale->mrp}}" name="mrp[]" readonly></th>
     <th class="align-middle">
          <input type="text" class="form-control mb-1 dis" autocomplete="off" value="{{$sale->discount}}" name="dis[]">
          <div class="form-check form-check-inline">
               <input class="form-check-input per dism" data-id="{{$sale->product_id}}" type="radio" name="discount_type{{$i}}" id="per{{$i}}" value="percent" {{$sale->discount_type == 'percent' ? 'checked' : ''}}>
               <input type="hidden" name="dis_type[]" class="dis_type" value="percent">
               <label class="form-check-label " for="per{{$i}}">percentage</label>
          </div>
          <div class="form-check form-check-inline">
               <input class="form-check-input amt dism" data-id="{{$sale->product_id}}" type="radio" name="discount_type{{$i}}" id="amt{{$i}}" value="fixed" {{$sale->discount_type == 'fixed' ? 'checked' : ''}}>
               <label class="form-check-label" for="amt{{$i}}">Amount</label><br>
          </div>
          <input readonly class="form-control each-dis" value="{{$dis_t}}">
     </th>
     <th colspan="3"><input type="text" name="total[]" class="form-control tl" value="{{$sale->qty * $sale->mrp - $dis_t}}" readonly></th>
     <th>
          <a href="javascript:void(0)" class="btn btn-xs btn-danger rm">X</a>
     </th>
</tr>
@endforeach
<tr>
<!-- <th colspan="2">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="inst">
<label class="form-check-label" for="inst">
Add Instalment
</label>
</div>
</th> -->
<th colspan="5" class="text-right">Total Discount =</th>
<th colspan="1" class="t_discount">{{$total_dis}}</th>
</tr>
<tr>
<th colspan="6" class="text-right">Sub Total =</th>
<th colspan="1" class="sub">{{$subtotal}}</th>
<input type="hidden" name="total" class="total" value="0.00">
</tr>
</table>

<tr class="foot_cal">
<th colspan="11" class="text-right">
<input type="submit" class="btn btn-block btn-primary order-submit"
value="Submit">
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
<script>
$(document).ready(function() {
     
     let productName = '';
     let productId = ''
     $("#product").change(function(){
          productId = $(this).val()
          //batch information
               $.ajax({
                    url: '/admin/sales/getPurchasesInfo/'+productId,
                    type: 'get',
                    dataType: 'json',
                    success: function(data){
                         console.log(data)
                         var sl= $("#myTable tr").length-4;
                         var p_name = data.name+'[Size: '+data.size+',Color: '+data.color+']';
                         var in_stock = data.in_stock;
                         if(in_stock == 0){
                              alert('Quantity is not available in stock')
                         }
                         var b_id = 0;
                         let batch='';  
                         var dis = 0;
                         let mrp = 0;
                         mrp=data.purchase[0].mrp;
                         $.each(data.purchase, function(index, value){
                              batch += '<option value="'+value.batchID+'">'+value.batchID+'</option>';
                         });
                         var qty = 0;
                         var tl = qty * mrp;
                         $(".table tbody .th").after(
                              '<tr class="uni_'+productId+'">' +
                              '<th class="sl">'+ sl +'</th>' +
                              '<th><input type="hidden" class="productID" name="product_id[]" value="'+data.priduct_id+'">' + p_name + '</th>' +
                              '<th>' +
                              '<select class="form-control chosen-select cus-width batchId" data-id="'+data.priduct_id+'" id="batchId" name="batchId[]">' + batch + '</select>' +
                              '</th>' +
                              '<th><input type="text" class="form-control qty" value="' + qty + '" name="qty[]"></th>' +
                              '<th><input type="text" class="form-control mrp" value="' + mrp + '" name="mrp[]" readonly></th>' +
                              '<th class="align-middle">' +
                              '<input type="text" class="form-control mb-1 dis" disabled autocomplete="off" value="' + dis + '" name="dis[]">' +
                              '<div class="form-check form-check-inline">' +
                              '<input class="form-check-input per dism" data-id="'+productId+'" type="radio" name="discount_type' + sl + '" id="per' + sl + '" value="percent" checked="checked"><input type="hidden" name="dis_type[]" class="dis_type" value="percent">' +
                              '<label class="form-check-label " for="per' + sl + '">percentage</label>' +
                              '</div>' +
                              '<div class="form-check form-check-inline">' +
                              '<input class="form-check-input amt dism" data-id="'+productId+'" type="radio" name="discount_type' + sl + '" id="amt' + sl + '" value="fixed">' +
                              '<label class="form-check-label" for="amt' + sl + '">Amount</label><br>' +
                              '</div>' +
                              '<input readonly class="form-control each-dis" value="0">' +
                              '<th colspan="3"><input type="text" name="total[]" class="form-control tl" value="' + tl + '" readonly>' +
                              '</th>' +
                              '<th>' +
                              '<a href="javascript:void(0)" class="btn btn-xs btn-danger rm">X</a>' +
                              '</th>' +
                              '</tr>'
                         );
                         $("#barcode").val("");
                         $.fn.calculate_sub();
                         $.fn.calculate_dis();
                         $.fn.serial();
                    }
               });
          
          //end batch information
     })
     
     // Hiding Instalment Form
     $(".inst_form").hide();
     
     //add table rows   
     $("#barcode").change(function() {
          var sl = $("#myTable tr").length - 2;
          var p_name = productName;
          var qty = 0;
          var mrp = 0;
          var dis = 0;
          var tl = qty * mrp;
          $("#myTable .th").after(
               '<tr>' +
               '<th class="sl">' + sl + '</th>' +
               '<th>' + p_name + '</th>' +
               '<th class="batchID'+ productId +'"></th>' +
               '<th><input type="text" class="form-control qty" value="' + qty + '" name="qty[]"></th>' +
               '<th><input type="text" class="form-control mrp" value="' + mrp + '" name="mrp[]"></th>' +
               '<th class="align-middle">' +
               '<input type="text" class="form-control mb-1 dis" value="' + dis + '" name="dis[]">' +
               '<div class="form-check form-check-inline">' +
               '<input class="form-check-input per dism" type="radio" name="discount_type' + sl + '" id="per' + sl + '" value="percent" checked="checked">' +
               '<label class="form-check-label " for="per' + sl + '">percentage</label>' +
               '</div>' +
               '<div class="form-check form-check-inline">' +
               '<input class="form-check-input amt dism" type="radio" name="discount_type' + sl + '" id="amt' + sl + '" value="fixed">' +
               '<label class="form-check-label" for="amt' + sl + '">Amount</label>' +
               '</div>' +
               '</th>' +
               '<th><input type="text" class="form-control tl" value="' + tl + '">' +
               '</th>' +
               '<th>' +
               '<a href="javascript:void(0)" class="btn btn-xs btn-danger rm">X</a>' +
               '</th>' +
               '</tr>'
          );
          
          $("#barcode").val("");
          // calculation of Sub_total
          $.fn.calculate_sub()
     });
     //batchid change
     $(document).on('change','#batchId', function() {
          var batchId = $(this).val();
          var productId = $(this).attr('data-id');
          $.ajax({
               url: '/admin/sales/getMrp/'+productId+'/'+batchId,
               type: 'GET',
               success: function(data) {
                    console.log(data)
                    $('.uni_'+productId).find('.mrp').val(data.getMrp.mrp);
                    var in_stock = data.in_stock;
                    var qty = $('.uni_'+productId).find('.qty').val();
                    var mrp = $('.uni_'+productId).find('.mrp').val();
                    var dis = $('.uni_'+productId).find('.dis').val();
                    var price = qty * mrp;
                    var dis_val = $('.uni_'+productId).find(".dism:checked").val();
                    if(in_stock < qty){
                         alert('Quantity is not available in stock');
                         $('.uni_'+productId).find('.qty').val(0);
                         $('.uni_'+productId).find('.tl').val(0);
                         $('.uni_'+productId).find('.each-dis').val(0);
                         $('.uni_'+productId).find('.dis').val(0);
                         $('.uni_'+productId).find('.dis').prop('disabled', true);
                         $.fn.calculate_sub();
                         $.fn.calculate_total_dis();
                    }
                    else{
                         if (dis_val == "percent") {
                              if(dis <= 100){
                                   dis_t=0;
                                   var dis_t = (price / 100) * dis;
                                   var total = price - dis_t;
                                   $('.uni_'+productId).find('.each-dis').val(dis_t);
                                   $('.uni_'+productId).find('.tl').val(total);
                                   $.fn.calculate_sub();
                                   $.fn.calculate_total_dis();
                              }else{
                                   alert('Discount cannot be greater than 100%');
                                   $('.uni_'+productId).find('.dis').val(0);
                                   $('.uni_'+productId).find('.each-dis').val(0);
                                   $('.uni_'+productId).find('.tl').val(price);
                                   $.fn.calculate_sub();
                                   $.fn.calculate_total_dis();
                              }
                              
                         } else {
                              if(dis <= price){
                                   var total = price - dis;
                                   $('.uni_'+productId).find('.tl').val(total);
                                   $('.uni_'+productId).find('.each-dis').val(dis);
                                   $.fn.calculate_sub();
                                   $.fn.calculate_total_dis();                    
                              }else{
                                   alert('Discount cannot be greater than total amount');
                                   $('.uni_'+productId).find('.dis').val(0);
                                   $('.uni_'+productId).find('.each-dis').val(0);
                                   $('.uni_'+productId).find('.tl').val(price);
                                   $.fn.calculate_sub();
                                   $.fn.calculate_total_dis();
                              }
                         }
                   }
               },
          });
     });
     //select showroom or dealer 
     $(document).on('click','.order-submit', function() {
          var showroom = $('#showroom').val();
          var dealer = $('#dealer').val();
          if($('#show:checked').val() == 'showroom' && showroom == ''){
               alert('Please select showroom');
               return false;
          }
          if($('#deal:checked').val() =='dealer' && dealer == ''){
               alert('Please select dealer');
               return false;
          }
          return true;
     });

     $(document).on('click','#deal', function() {
          $('div#showroom_chosen').css('display', 'none');
          $('#showroom').val('');
          $('div#dealer_chosen').css('display', 'block');
     });
     $(document).on('click','#show', function() {
          $('div#showroom_chosen').css('display', 'block');
          $('div#dealer_chosen').css('display', 'none');
          $('#dealer').val('');
     });
     //remove table rows      
     $(".table tbody").on('click', '.rm', function() {
          $(this).closest('tr').remove();
          // calculation of Sub_total
          $.fn.calculate_sub();
          
          // Removing footer amounts
          var rowCount = $("#myTable tr").length;
          if (rowCount < 4) {
               $(".sub").text(0);
          }
     });
     // entering discount amount
     $("#discount").on('keyup', function() {
          $.fn.calculate_dis();
     });

      // selecting discount method
      $(".ii").on('click', function() {
          $.fn.calculate_dis();
     });
     // selecting discount method
     $(".table tbody").on('click', '.per,.amt', function() {
          var productId = $(this).attr('data-id');
          var qty = $(this).closest('tr').find('.qty').val();
          var mrp = $(this).closest('tr').find('.mrp').val();
          var dis = $(this).closest('tr').find('.dis').val();
          var price = qty * mrp;
          var dis_val = $(this).closest('tr').find(".dism:checked").val();
          if (dis_val == "percent") {
               $(this).closest('tr').find('.dis_type').val('percent');
               if(dis <= 100){
                    dis_t=0;
                    var dis_t = (price / 100) * dis;
                    var total = price - dis_t;
                    $(this).closest('tr').find('.each-dis').val(dis_t);
                    $(this).closest('tr').find('.tl').val(total);
                    $.fn.calculate_sub();
                    $.fn.calculate_total_dis();
               }else{
                    alert('Discount cannot be greater than 100%');
                    $(this).closest('tr').find('.dis').val(0);
                    $(this).closest('tr').find('.each-dis').val(0);
                    $(this).closest('tr').find('.tl').val(price);
                    $.fn.calculate_sub();
                    $.fn.calculate_total_dis();
               }
               
          } else {
               $(this).closest('tr').find('.dis_type').val('fixed');
               if(dis <= price){
                    var total = price - dis;
                    $(this).closest('tr').find('.tl').val(total);
                    $(this).closest('tr').find('.each-dis').val(dis);
                    $.fn.calculate_sub();
                    $.fn.calculate_total_dis();                    
               }else{
                    alert('Discount cannot be greater than total amount');
                    $(this).closest('tr').find('.dis').val(0);
                    $(this).closest('tr').find('.each-dis').val(0);
                    $(this).closest('tr').find('.tl').val(price);
                    $.fn.calculate_sub();
                    $.fn.calculate_total_dis();
               }
          }
     });
     //check inventory
     $(".table tbody").on('keyup', '.qty', function() {
          var productId = $(this).closest('tr').find('.productID').val();
          var batchId = $(this).closest('tr').find('.batchId').val();
          var qty = $(this).closest('tr').find('.qty').val();
          if(qty > 0){
               $(this).closest('tr').find('.dis').prop('disabled', false);
          }else if(qty == 0){
               $('.uni_'+productId).find('.dis').val(0);
               $(this).closest('tr').find('.dis').prop('disabled', true);
          }
          $.ajax({
               url: '/admin/sales/check-inventory',
               type: 'GET',
               data: {
                    productId: productId,
                    batchId: batchId,
                    qty: qty,
               },
               dataType: 'json',
               success:function(data){
                   var in_stock = data.in_stock;
                   if(in_stock < qty){
                         alert('Quantity is not available in stock');
                         $('.uni_'+productId).find('.qty').val(0);
                         $('.uni_'+productId).find('.tl').val(0);
                         $('.uni_'+productId).find('.each-dis').val(0);
                         $('.uni_'+productId).find('.dis').val(0);
                         $('.uni_'+productId).find('.dis').prop('disabled', true);
                         $.fn.calculate_sub();
                         $.fn.calculate_total_dis();
                   }
               },
          });
     });
     //Calculating Row
     $(".table tbody").on('keyup', '.qty,.mrp,.dis', function() {
          var qty = $(this).closest('tr').find('.qty').val();
          var mrp = $(this).closest('tr').find('.mrp').val();
          var dis = $(this).closest('tr').find('.dis').val();
          var price = qty * mrp;
          var dis_val = $(this).closest('tr').find(".dism:checked").val();
          if (dis_val == "percent") {
               if(dis <= 100){
                    dis_t=0;
                    var dis_t = (price / 100) * dis;
                    var total = price - dis_t;
                    $(this).closest('tr').find('.each-dis').val(dis_t);
                    $(this).closest('tr').find('.tl').val(total);
                    $.fn.calculate_sub();
                    $.fn.calculate_total_dis();
               }else{
                    alert('Discount cannot be greater than 100%');
                    $(this).closest('tr').find('.dis').val(0);
                    $(this).closest('tr').find('.each-dis').val(0);
                    $(this).closest('tr').find('.tl').val(price);
                    $.fn.calculate_sub();
                    $.fn.calculate_total_dis();
               }
               
          } else {
               if(dis <= price){
                    var total = price - dis;
                    $(this).closest('tr').find('.tl').val(total);
                    $(this).closest('tr').find('.each-dis').val(dis);
                    $.fn.calculate_sub();
                    $.fn.calculate_total_dis();                    
               }else{
                    alert('Discount cannot be greater than total amount');
                    $(this).closest('tr').find('.dis').val(0);
                    $(this).closest('tr').find('.each-dis').val(0);
                    $(this).closest('tr').find('.tl').val(price);
                    $.fn.calculate_sub();
                    $.fn.calculate_total_dis();
               }
          }
     });
     //auto calculation
     $(".table tbody").on('keyup', '.qty,.mrp', function() {
          var q = $(this).closest('tr').find('.qty').val();
          var m = $(this).closest('tr').find('.mrp').val();
          var t = q * m;
          $(this).closest('tr').find('.tl').val(t);
          $.fn.calculate_sub();
          $.fn.calculate_dis();
     });
     //discount total calculate 
     $.fn.calculate_total_dis = function() {
          var s = 0;
          $(".dis").closest('tr').each(function(index, value) {
               var ss = parseInt($(this).find('.each-dis').val());
               s += ss;
               $(".t_discount").text(s.toFixed(2));
          });
     }
     // calculationg subtotal
     $.fn.calculate_sub = function() {
          var s = 0;
          $(".qty").closest('tr').each(function(index, value) {
               var ss = parseInt($(this).find('.tl').val());
               s += ss;
               $(".sub").text(s);
               $(".total").val(s);
          });
     }
     //Calculation of discount
     $.fn.calculate_dis = function() {
          var dis_val = $("input[name='discount']:checked").val();
          if (dis_val == "percent") {
               var sub_t = $(".sub").text();
               var dis_m = $("#discount").val();
               var dis_t = (sub_t / 100) * dis_m;
               var gr_t = sub_t - dis_t;
               $(".gr_t").val(gr_t);
          } else {
               var sub_t = $(".sub").text();
               var dis_m = $("#discount").val();
               var gr_t = sub_t - dis_m;
               $(".gr_t").val(gr_t);          
          }
     }
     $.fn.serial=function(){
          var sl=0;
          $('.sl').each(function(i, obj) {
               $(this).text(++sl)
          });
     }
     
     
     // toogle instalmant form
     $("#inst").click(function() {
          var a = $('#inst').prop('checked')
          if ($('#inst').prop('checked')) {
               $(".inst_form").show();
          } else {
               $(".inst_form").hide();
          }
     });
     
     $("#ins_num").change(function() {
          var a = $('#ins_num').val();
          for (let i = a; i >= 1; i--) {
               $("#insTab .add_ins").after(
                    '<tr class="inst_form">' +
                    '<th colspan="2">'+i+'. no. instalment date:</th>' +
                    '<th colspan="2"><input type="text" class="form-control datepick" id="datepicker' + i + '" size="30"></th>' +
                    '<th colspan="3"></th>' +
                    '</tr>'
               );
               var ID_u = "#datepicker" + i
               $('.datepick').each(function() {
                    $(this).datepicker({
                         dateFormat: "yy-mm-dd"
                    });
               });
          }
          
     });
});
</script>
@endsection
