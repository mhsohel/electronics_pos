@extends('layouts.master')
@section('content')

<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Product List</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              <table class="table table-striped table-bordered table-hover dataTables-example1">
                                   <thead class="bg-primary">
                                        <tr>
                                             <th>SL</th>
                                             <th>Invoice Date</th>
                                             <th>Sale Man</th>
                                             <th>Invoice Id</th>
                                             <th>Discount</th>
                                             <th>Vat</th>
                                             <th>Total</th>
                                            
                                             <th>Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        @php
                                        $i=0;
                                        @endphp
                                        @foreach ($list as $l)
                                        <tr>
                                             <td>{{++$i}}</td>
                                             <td>{{$l->created_at}}</td>
                                             <td>sales man name</td>
                                             <td>{{$l->invoiceID}}</td>
                                             <td>{{$l->discount}}</td>
                                             <td> vat </td>
                                             <td>{{$l->total}}</td>
                                             
                                             <td>
                                                  <form action="{{route('product.destroy',$l->id)}}" method="post">
                                                       <a href="{{route('product.edit',$l->id)}}"
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
                              <div class="col-md-12 text-center">
                                   {{-- {{ $list->onEachSide(5)->links() }} --}}
                              </div>
                              @php

                              // echo DNS1D::getBarcodeHTML('4445645656', 'C39').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'C39+').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'C39E').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'C39E+').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'C93').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'S25').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'S25+').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'I25').'<br>ll';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'I25+').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'C128').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'C128A').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'C128B').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'C128C').'<br>';
                              // echo DNS1D::getBarcodeHTML('44455656', 'EAN2').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445656', 'EAN5').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445', 'EAN8').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445', 'EAN13').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'UPCA').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'UPCE').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'MSI').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'MSI+').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'POSTNET').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'PLANET').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'RMS4CC').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'KIX').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'IMB').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'CODABAR').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'CODE11').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA').'<br>';
                              // echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T').'<br>';
                              @endphp
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<script>
     $(document).ready(function() {
          $('.dataTables-example1').DataTable({
          pageLength: 25,
          responsive: true,
          paginate:false,
          dom: '<"html5buttons"B>lTfgitp',
          buttons: [{
                    extend: 'copy'
               },
               {
                    extend: 'csv'
               },
               {
                    extend: 'excel',
                    title: 'Excel'
               },
               {
                    extend: 'pdf',
                    title: 'PDF'
               },
               {
                    extend: 'print',
                    customize: function(win) {
                         $(win.document.body).addClass('white-bg');
                         $(win.document.body).css('font-size', '10px');
                         $(win.document.body).find('table')
                              .addClass('compact')
                              .css('font-size', 'inherit');
                    }
               }
          ]
          });
          $('#brandID').change(function(){
               let brand_id=$(this).val();
               $.ajax({
                    url: 'getCategory/'+brand_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                         var len = 0;
                         if(response != null){
                              len = response.length;
                         }
                         let html='<select class="form-control chosen-select" id="category" name="category_id">'
                         if(len > 0){
                              for(var i=0; i<len; i++){
                              var id = response[i].id;
                              var name = response[i].name;
                              html+= "<option value='"+id+"'>"+name+"</option>";
                              }
                              html+='</select>'
                              $('#c').html(html)
                              $('.chosen-select').chosen({
                                   width: "100%"
                              });
                         }
                    }
               });
          })
     });

</script>
@endsection