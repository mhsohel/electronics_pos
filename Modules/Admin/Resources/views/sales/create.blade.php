@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-lg-12">
<div class="ibox">
<div class="ibox-title">
<h5>Purchase Products </h5>
<div class="ibox-tools">
<a class="collapse-link">
<i class="fa fa-chevron-up"></i>
</a>
</div>
</div>
<div class="ibox-content">
<div class="row">
<div class="col-md-12 table-responsive">
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form action="{{route('sales.store')}}" method="POST">
@csrf
<!-- <input type="hidden" name="_token" value="zGz8gIY90dUq20GGeELKSh6jRuXF4cg9bSuoNzka"> -->
<table class="table table-bordered" id="myTable">
<tr>
<th colspan="2">
<input type="text" id="barcode" class="form-control" placeholder="Scan barcode">
</th>
<th colspan="2">
{!! Form::select('', $p_list, '', ['class' =>
'form-control chosen-select','id'=>'product']) !!}
</th>
<th>
	<div class="form-check form-check-inline">
		<input class="form-check-input " type="radio" name="dealorshow" id="show" value="showroom" checked="checked">
		<label class="form-check-label " for="show">Showroom</label>
	</div>
	<div class="form-check form-check-inline">
		<input class="form-check-input" type="radio" name="dealorshow" id="deal" value="dealer">
		<label class="form-check-label" for="deal">Dealer</label>
	</div>
</th>
<th>
{!! Form::select('', $showroom, '', ['class' =>
'form-control chosen-select','id'=>'showroom']) !!}

{!! Form::select('', $dealer, '', ['class' =>
'form-control chosen-select','id'=>'dealer']) !!}
</th>
<th>
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
<th></th>
</tr>
<tr>
<th colspan="2">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="inst">
<label class="form-check-label" for="inst">
Add Instalment
</label>
</div>
</th>
<th colspan="3" class="text-right">Sub Total =</th>
<th colspan="2" class="sub">0</th>
</tr>
</table>

<tr class="foot_cal">
<th colspan="11" class="text-right">
<input type="submit" class="btn btn-block btn-primary"
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
                         var sl= $("#myTable tr").length-4;
                         var p_name = data.name+'[Size: '+data.size+',Color: '+data.color+']';
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
                              '<th colspan="3"><input type="text" class="form-control tl" value="' + tl + '" readonly>' +
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
               '<th><input type="text" class="form-control tl" value="' + tl + '" name="total[]">' +
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
                    $('.uni_'+productId).find('.mrp').val(data.mrp);
                    var qty = $('.uni_'+productId).find('.qty').val();
                    console.log(qty);
                    var mrp = $('.uni_'+productId).find('.mrp').val();
                    var dis = $('.uni_'+productId).find('.dis').val();
                    var price = qty * mrp;
                    var dis_val = dis;
                    if (dis_val == "percent") {
                         var dis_t = (price / 100) * dis;
                         var total = price - dis_t;
                         $('.uni_'+productId).find('.tl').val(total);
                         $.fn.calculate_sub();
                         $.fn.serial();
                    }
                    else {
                         var total = price - dis;
                         $('.uni_'+productId).find('.tl').val(total);
                         $.fn.calculate_sub();
                         $.fn.serial();
                    }
               },
          });
     });
     //select showroom or dealer 
     $(document).on('click','#deal', function() {
          $('div#showroom_chosen').css('display', 'none');
          $('div#dealer_chosen').css('display', 'block');
     });
     $(document).on('click','#show', function() {
          $('div#showroom_chosen').css('display', 'block');
          $('div#dealer_chosen').css('display', 'none');
     });
     //remove table rows            p
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
          var qty = $(this).closest('tr').find('.qty').val();
          var mrp = $(this).closest('tr').find('.mrp').val();
          var dis = $(this).closest('tr').find('.dis').val();
          var price = qty * mrp;
          var dis_val = $(this).closest('tr').find(".dism:checked").val();
          if (dis_val == "percent") {
               var dis_t = (price / 100) * dis;
               var total = price - dis_t;
               $(this).closest('tr').find('.tl').val(total);
               $.fn.calculate_sub();
          } else {
               var total = price - dis;
               $(this).closest('tr').find('.tl').val(total);
               $.fn.calculate_sub();
          }
     });
     
     //Calculating Row
     $(".table tbody").on('keyup', '.qty,.mrp,.dis', function() {
          var qty = $(this).closest('tr').find('.qty').val();
          var mrp = $(this).closest('tr').find('.mrp').val();
          var dis = $(this).closest('tr').find('.dis').val();
          var price = qty * mrp;
          var dis_val = $(this).closest('tr').find(".dism:checked").val();
          if (dis_val == "percent") {
               var dis_t = (price / 100) * dis;
               var total = price - dis_t;
               $(this).closest('tr').find('.tl').val(total);
               $.fn.calculate_sub();
          } else {
               var total = price - dis;
               $(this).closest('tr').find('.tl').val(total);
               $.fn.calculate_sub();
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
     // calculationg subtotal
     $.fn.calculate_sub = function() {
          var s = 0;
          $(".qty").closest('tr').each(function(index, value) {
               var ss = parseInt($(this).find('.tl').val());
               s += ss;
               $(".sub").text(s);
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