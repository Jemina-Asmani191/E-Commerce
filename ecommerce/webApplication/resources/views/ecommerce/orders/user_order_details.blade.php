@extends('ecommerce.layouts.master')
@section('title','cart')
@section('content')

        <!-- Start All Title Box -->
        <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>User Orders Details</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/orders')}}">Orders</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">            
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Product Size</th>
                                <th>Product Color</th>
                                <th>Product Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderDetails->orders as $pro)
                                <tr>
                                    <td>{{$pro->product_code}}</td>
                                    <td>{{$pro->product_name}}</td>
                                    <td>{{$pro->product_qty}}</td>
                                    <td>{{$pro->product_size}}</td>
                                    <td>{{$pro->product_color}}</td>
                                    <td>{{$pro->product_price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

@endsection

<?php
    Session::forget('order_id');
    Session::forget('grand_total');
?>