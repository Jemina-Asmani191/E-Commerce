@extends('admin.Layouts.master')
@section('title','Product Attribute')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="header-icon">
            <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
            <h1>Product Attribute</h1>
            <small>Add Product Attribute</small>
        </div>
    </section>
    @if(Session::has('flash_message_error'))
    <div class="alert alert-sm alert-danger alert-block" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{!! session('flash_message_error') !!}</strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-sm alert-success alert-block" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{!! session('flash_message_success') !!}</strong>
    </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonlist">
                            <a class="btn btn-add " href="{{url('admin/view_products')}}">
                                <i class="fa fa-eye"></i> View Products </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="col-sm-6" enctype="multipart/form-data" action="{{url('/admin/add_attributes/'.$productDetails->id)}}" method="post"> {{csrf_field()}}
                           
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" value="{{$productDetails->name}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Product Code</label>
                                <input type="text" class="form-control" value="{{$productDetails->code}}" disabled>
                            </div>
                            <div class=" form-group">
                                <label>Product Color</label>
                                <input type="text" class="form-control" value="{{$productDetails->color}}" disabled>
                            </div>
                            <div class="form-group">
                                <div class="field_wrapper">
                                <!-- <label>Product Attribute</label> -->
                                <div style="display:flex;">
                                    <label style="margin: 0px 15px 0 9px;">Code-Size(XXX-S)</label>
                                    <label style="margin: 0 40px 0 40px;">Size</label>
                                    <label style="margin: 0 50px 0 55px;">price</label>
                                    <label style="margin: 0 0px 0 43px;">Stock</label>
                                </div>
                                    <div style="display:flex;">
                                        <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width:120px;margin:5px;"/>
                                        <input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width:120px;margin:5px;"/>
                                        <input type="text" name="price[]" id="price" placeholder="Price" class="form-control" style="width:120px;margin:5px;"/>
                                        <input type="text" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width:120px;margin:5px;"/>
                                        <a href="javascript:(0);" class="add_button" title="Add Field" style="margin: 10px;">Add</a>
                                    </div>
                                </div>
                            </div>
                            <div class="reset-button">
                                <input type="submit" class="btn btn-success" value="Add Attributes">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- view attribute -->
 <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>View Attributes </h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">
                                <div class="buttonexport" id="buttonlist">
                                    <a class="btn btn-add" href="{{url('admin/add_product')}}"> <i class="fa fa-plus"></i> Add Product 
                                    </a>
                                </div>
                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <form class="col-sm-6" enctype="multipart/form-data" action="{{url('/admin/edit_attributes/'.$productDetails->id)}}" method="post"> {{csrf_field()}}
                                    <thead>
                                        <tr class="info">
                                            <th>Category ID</th>
                                            <th>SKU</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Stocks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productDetails->attributes as $attribute)
                                        <tr>
                                            <!-- <td>1</td>
                                            <td>1</td>
                                            <td>SKU</td>
                                            <td>Size</td>
                                            <td>Price</td>
                                            <td>Stocks</td> -->
                                            
                                            <td style="display:none;"> <input type="hidden" name="attr[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                                            <td>{{$attribute->id}}</td>
                                            <td> <input type="text" name="sku[]" value="{{$attribute->sku}}"></td>
                                            <td> <input type="text" name="size[]" value="{{$attribute->size}}"></td>
                                            <td> <input type="text" name="price[]" value="{{$attribute->price}}"></td>
                                            <td> <input type="text" name="stock[]" value="{{$attribute->stock}}"></td>
                                            
                                            <td>
                                                <input type="submit" value="update" class="btn btn-success" style="height:30px;padding-top:4px;">
                                                <a href="{{url('/admin/delete_attributes/'.$attribute->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      <!-- /.view attribute -->

     
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection