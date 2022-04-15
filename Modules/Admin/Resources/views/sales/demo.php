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
<select class="form-control chosen-select" id="product" name="productName">
<option value="">Select Products</option>
@forelse ($products as $product)
<option value="{{$product->id}}">{{$product->name}}</option>
@empty
<option value="">No Product</option>
@endforelse


</select>
</th>
<th>
<select class="form-control chosen-select" id="supplier" name="supplier_id">
<option value="2">Morshed Habib</option>
<option value="" selected="selected">Select Supplier</option>
</select>
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
<th colspan="2" class="sub_total">0</th>
</tr>
</table>

<table class="table table-bordered" id="insTab">
<tr class="inst_form">
<th colspan="2">
<div class="form-group">
<label for="ins_img" class="font-weight-bold">Customer Photo:</label>
<input type="file" class="form-control-file" id="ins_img">
</div>
</th>
<th>
<div class="form-group">
<label for="nid" class="font-weight-bold">Customer National ID:</label>
<input type="text" class="form-control" id="nid" placeholder="Enter Customer NID no.">
</div>
</th>
<th colspan="2">
<div class="form-group">
<label for="gur_one" class="font-weight-bold">Gurranter One</label>
<input type="text" class="form-control" id="gur_one" placeholder="Enter Gurranter Name">
</div>
</th>
<th colspan="2">
<div class="form-group">
<label for="gur_one_phn" class="font-weight-bold">Gurranter Phone</label>
<input type="text" class="form-control" id="gur_one_phn" placeholder="Enter Gurranter Phone">
</div>
</th>
</tr>
<tr class="inst_form add_ins">
<th colspan="2">
<div class="form-group">
<label for="int" class="font-weight-bold mr-5">Interest</label>
<div class="form-check form-check-inline">
<input class="form-check-input per dism" type="radio" name="int_per" id="int_per" value="percentage" checked="checked">
<label class="form-check-label " for="int_per">percentage</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input amt dism" type="radio" name="dint_amt" id="int_amt" value="amount">
<label class="form-check-label" for="int_amt">Amount</label>
</div>
<input type="text" class="form-control" id="int" placeholder="Enter Interest Rate">
</div>
</th>
<th>
<div class="form-group">
<label for="ins_num" class="font-weight-bold">Number Of Instalment</label>
<input type="text" class="form-control" id="ins_num" placeholder="Enter Number Of Instalment">
</div>
</th>
<th colspan="2">
<div class="form-group">
<label for="gur_two" class="font-weight-bold">Gurranter Two</label>
<input type="text" class="form-control" id="gur_two" placeholder="Enter Gurranter Name">
</div>

</th>
<th colspan="2">
<div class="form-group">
<label for="gur_two_phn" class="font-weight-bold">Gurranter Phone</label>
<input type="text" class="form-control" id="gur_two_phn" placeholder="Enter Gurranter Phone">
</div>
</th>
</tr>
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
          productName =  $("#product_chosen span").text()
          //batch information
          
               
               $.ajax({
                    url: '/admin/sales/getPurchasesInfo/'+productId,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                         var len = 0;
                         if(response != null){
                              len = response.length;
                         }
                         let html='<select class="form-control chosen-select" name="batchId[]">'
                         if(len > 0){
                              for(var i=0; i<len; i++){
                                   var id = response[i].batchID;
                                   var name = response[i].batchID;
                                   html+= "<option value='"+id+"'>"+name+"</option>";
                              }
                              html+='</select>'
                              $('#c').html(html)
                              $('.chosen-select').chosen({
                                   width: "100%"
                              });
                         }
                         console.log(html)
                         $(".batchID"+productId).append(html)
                         $(".batchID"+productId).on('change', function() {
                              let productBatchID = parseInt($(".batchID"+productId ).find(":selected").text())
                              console.log('productId'+productId);
                              console.log('productBatch'+productBatchID);
                              $.ajax({
                                   url: '/admin/sales/getMrp/'+productId+'/'+productBatchID,
                                   type: 'get',
                                   dataType: 'json',
                                   success: function(response){
                                        if(response){
                                             let mrp = parseFloat(response.mrp);
                                             $(".mrp"+productId).val(mrp);
                                             console.log('mrp'+mrp)
                                             
                                        }
                                   }
                              })
                              
                         });

                    }
               });
          
          //end batch information
     });
     
     // Hiding Instalment Form
     $(".inst_form").hide();
     
     //add table rows   
     $("#barcode,#product").change(function() {
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
               '<th><input type="text" class="form-control mrp'+productId+'" value="' + mrp + '" name="mrp[]"></th>' +
               '<th class="align-middle">' +
               '<input type="text" class="form-control mb-1 dis" value="' + dis + '" name="dis[]">' +
               '<div class="form-check form-check-inline">' +
               '<input class="form-check-input per dism" type="radio" name="discount' + sl + '" id="per' + sl + '" value="percentage" checked="checked">' +
               '<label class="form-check-label " for="per' + sl + '">percentage</label>' +
               '</div>' +
               '<div class="form-check form-check-inline">' +
               '<input class="form-check-input amt dism" type="radio" name="discount' + sl + '" id="amt' + sl + '" value="amount">' +
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
     
     //remove table rows            
     $(".table tbody").on('click', '.rm', function() {
          $(this).closest('tr').remove();
          // calculation of Sub_total
          $.fn.calculate_sub();
          
          // Removing footer amounts
          var rowCount = $("#myTable tr").length;
          if (rowCount < 4) {
               $(".sub_total").text(0);
          }
     });
     
     // selecting discount method
     $(".table tbody").on('click', '.per,.amt', function() {
          var qty = $(this).closest('tr').find('.qty').val();
          var mrp = $(this).closest('tr').find('.mrp').val();
          var dis = $(this).closest('tr').find('.dis').val();
          var price = qty * mrp;
          var dis_val = $(this).closest('tr').find(".dism:checked").val();
          console.log(dis_val)
          if (dis_val == "percentage") {
               var dis_t = (price / 100) * dis;
               var total = price - dis_t;
               $(this).closest('tr').find('.tl').val(total);
          } else {
               var total = price - dis;
               $(this).closest('tr').find('.tl').val(total);
          }
     });
     
     //Calculating Row
     $(".table tbody").on('keyup', '.qty,.mrp,.dis', function() {
          var qty = $(this).closest('tr').find('.qty').val();
          var mrp = $(this).closest('tr').find('.mrp').val();
          var dis = $(this).closest('tr').find('.dis').val();
          var price = qty * mrp;
          var dis_val = $(this).closest('tr').find(".dism:checked").val();
          if (dis_val == "percentage") {
               var dis_t = (price / 100) * dis;
               var total = price - dis_t;
               $(this).closest('tr').find('.tl').val(total);
          } else {
               var total = price - dis;
               $(this).closest('tr').find('.tl').val(total);
               console.log(total)
          }
     });
     
     // calculationg subtotal
     $.fn.calculate_sub = function() {
          var s = 0;
          $(".qty").closest('tr').each(function(index, value) {
               var ss = parseInt($(this).find('.tl').val());
               s += ss;
               $(".sub_total").text(s);
          });
     }
     
     
     // toogle instalmant form
     $("#inst").click(function() {
          var a = $('#inst').prop('checked')
          console.log(a)
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