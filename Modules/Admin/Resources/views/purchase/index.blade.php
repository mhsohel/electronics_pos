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
                              <form action="{{ route('purchase.store') }}" method="POST">
                                   @csrf
                                   <table class="table table-bordered" id="myTable">
                                        <tr>
                                             <th colspan="2">
                                                  <input type="text" id="barcode" class="form-control"
                                                       placeholder="Scan barcode">
                                             </th>
                                             <th colspan="3">
                                                  {!! Form::select('', $p_list, '', ['class' =>
                                                  'form-control chosen-select','id'=>'product']) !!}
                                             </th>
                                             <th colspan="2">
                                                  {!! Form::select('supplier_id', $supplier, '', ['class' =>
                                                  'form-control chosen-select','id'=>'supplier']) !!}
                                             </th>
                                             <th colspan="2">
                                                  <input type="text" class="form-control date" placeholder=""
                                                       id="date_modified" value="<?php echo date(" Y-m-d"); ?>">
                                             </th>
                                             <th></th>
                                        </tr>
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
                                        <div>
                                             <tr class="foot_cal">
                                                  <th colspan="9" class="text-right">Sub Total =</th>
                                                  <th class="sub">0.00</th>
                                             </tr>
                                             <tr class="foot_cal">
                                                  <th colspan="7" class="text-right">
                                                       <input type="radio" name="discount_type" id="per" class="ii"
                                                            value="percent" checked>Percentage
                                                       <input type="radio" name="discount_type" id="amt" class="ii"
                                                            value="fixed">Fixed
                                                  </th>
                                                  <th colspan="2" class="text-right">
                                                       Discount =
                                                  </th>
                                                  <th><input type="text" id="discount" class="form-control"
                                                            placeholder="Discount" name="discount" value="0"></th>
                                             </tr>
                                             <tr class="foot_cal">
                                                  <th colspan="9" class="text-right">Grand Total =</th>
                                                  <th><input type="text" name="total" class="form-control gr_t"
                                                            value="0.00" readonly></th>
                                             </tr>
                                             <tr class="foot_cal">
                                                  <th colspan="11" class="text-right">
                                                       <input type="submit" class="btn btn-block btn-primary"
                                                            value="Submit">
                                                  </th>
                                             </tr>
                                        </div>
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
     $("#barcode").keydown(function() {
          if (event.keyCode === 13) { 
               $.ajax({
                    type: "POST",
                    url: "<?php echo route('product_by_barcode')?>",
                    data: {
                         "_token": "{{ csrf_token() }}",
                         'barcode': $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                         var sl= $("#myTable tr").length-4;
                         var p_name = data.name+'[Size: '+data.size+',Color: '+data.color+']';
                         var b_id = '';
                         var qty = 0;
                         var c_price = 0;
                         var mrp = 0;
                         var tl = qty * c_price;
                         $(".table tbody .th").after(
                              '<tr>' +
                              '<th class="sl">'+ sl +'</th>' +
                              '<th><input type="hidden" name="product_id[]" value="'+data.priduct_id+'">' + p_name + '</th>' +
                              '<th>' +
                              '<input type="text" class="form-control" value="' + b_id + '" name="batchID[]">' +
                              '</th>' +
                              '<th><input type="text" class="form-control qty" value="' + qty + '" name="qty[]"></th>' +
                              '<th><input type="text" class="form-control c_price" value="' + c_price + '" name="cost_price[]"></th>' +
                              '<th><input type="text" class="form-control mrp" value="' + mrp + '" name="mrp[]"></th>' +
                              '<th><select name="warranty_type[]"><option value="warranty">Warranty</option><option value="guarantee">Guarantee</option></select></th>' +
                              '<th><input type="text" class="form-control mrp" value="0" name="warranty_period[]"></th>' +
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
          }
     });
     $("#product").change(function() {
               $.ajax({
                    type: "POST",
                    url:  "<?php echo route('product_by_barcode')?>",
                    data: {
                         "_token": "{{ csrf_token() }}",
                         'barcode': $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                         var sl= $("#myTable tr").length-4;
                         var p_name = data.name+'[Size: '+data.size+',Color: '+data.color+']';
                         var b_id = '';
                         var qty = 0;
                         var c_price = 0;
                         var mrp = 0;
                         var tl = qty * c_price;
                         $(".table tbody .th").after(
                              '<tr>' +
                              '<th class="sl">'+ sl +'</th>' +
                              '<th><input type="hidden" name="product_id[]" value="'+data.priduct_id+'">' + p_name + '</th>' +
                              '<th>' +
                              '<input type="text" class="form-control" value="' + b_id + '" name="batchID[]">' +
                              '</th>' +
                              '<th><input type="text" class="form-control qty" value="' + qty + '" name="qty[]"></th>' +
                              '<th><input type="text" class="form-control c_price" value="' + c_price + '" name="cost_price[]"></th>' +
                              '<th><input type="text" class="form-control mrp" value="' + mrp + '" name="mrp[]"></th>' +
                              '<th><select name="warranty_type[]"><option value="warranty">Warranty</option><option value="guarantee">Guarantee</option></select></th>' +
                              '<th><input type="text" class="form-control mrp" value="0" name="warranty_period[]"></th>' +
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
     });

     //remove table rows            
     $(".table tbody").on('click', '.rm', function() {
          $(this).closest('tr').remove();
          $.fn.calculate_sub();
          $.fn.calculate_dis();
          var rowCount = $("#myTable tr").length;
          if (rowCount < 6) {
               $(".sub").text(0);
               $("#discount").val(0);
               $(".gr_t").val(0);
          }
          $.fn.serial();
     });

     //auto calculation
     $(".table tbody").on('keyup', '.qty,.c_price', function() {
          var q = $(this).closest('tr').find('.qty').val();
          var m = $(this).closest('tr').find('.c_price').val();
          var t = q * m;
          $(this).closest('tr').find('.tl').val(t);
          $.fn.calculate_sub();
          $.fn.calculate_dis();
     });

     // entering discount amount
     $("#discount").on('keyup', function() {
          $.fn.calculate_dis();
     });


     // selecting discount method
     $(".ii").on('click', function() {
          $.fn.calculate_dis();
     });

     // calculation of Sub_total
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
});
</script>
@endsection