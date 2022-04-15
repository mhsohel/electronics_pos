@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add Product </h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                              @if ($errors->any())
                              <div class="alert alert-danger">
                                   <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                   </ul>
                              </div>
                              @endif
                              <form action="{{ route('product.update',$edit->id) }}" method="POST"
                                   enctype="multipart/form-data">
                                   @csrf
                                   @method('PUT')
                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Brand</th>
                                             <th>
                                                  {!! Form::select('brand_id', $brand, $edit->brand_id, ['class' =>
                                                  'form-control chosen-select','id'=>'brandID']) !!}
                                             </th>
                                             <th>Category</th>
                                             <th id="c" colspan="3">
                                                  {!! Form::select('category_id', $category, $edit->category_id,
                                                  ['class' =>
                                                  'form-control chosen-select','id'=>'category']) !!}
                                             </th>

                                        </tr>
                                        <tr>
                                             <th>Product Name</th>
                                             <th>
                                                  <input type="text" name="name" class="form-control"
                                                       placeholder="Enter Product name" value="{{ $edit->name }}">
                                             </th>
                                             <th>Model</th>
                                             <th colspan="3">
                                                  <input type="text" name="model" class="form-control"
                                                       placeholder="Enter Model" value="{{ $edit->model }}">
                                             </th>
                                        </tr>
                                        <tr>
                                             <th>Size</th>
                                             <th>
                                                  {!! Form::select('size_id', $size, $edit->size_id, ['class' =>
                                                  'form-control chosen-select','id'=>'size']) !!}
                                             </th>
                                             <th>Color</th>
                                             <th>
                                                  {!! Form::select('color_id', $color, $edit->color_id, ['class' =>
                                                  'form-control chosen-select','id'=>'color']) !!}
                                             </th>
                                             <th>Unit</th>
                                             <th>
                                                  {!! Form::select('unit_id', $unit, $edit->unit_id, ['class' =>
                                                  'form-control chosen-select','id'=>'unit']) !!}
                                             </th>
                                        </tr>
                                        <tr>
                                             <th>Product Code</th>
                                             <th>
                                                  <input type="text" name="product_code" class="form-control"
                                                       placeholder="Enter Product Code"
                                                       value="{{ $edit->product_code }}">
                                             </th>
                                             <th>Photo</th>
                                             <th>
                                                  <input type="file" name="photo" class="form-control">
                                             </th>
                                             <th colspan="2"><button type="submit"
                                                       class="btn btn-primary btn-block">Save</button>
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
                                             <th>Photo</th>
                                             <th>Product Name</th>
                                             <th>Category</th>
                                             <th>Brand</th>
                                             <th>Size</th>
                                             <th>Color</th>
                                             <th>Code</th>
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
                                             <td><img src="{{asset('images/'.$l->photo)}}" alt="" width="90"
                                                       height="100"></td>
                                             <td>{{$l->name}}</td>
                                             <td>{{$l->category->name}}</td>
                                             <td>{{$l->brand->name}}</td>
                                             <td>{{$l->size->size}}</td>
                                             <td>{{$l->color->color}}</td>
                                             <td>{{$l->product_code}}</td>
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
                                   {{ $list->onEachSide(5)->links() }}
                              </div>
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