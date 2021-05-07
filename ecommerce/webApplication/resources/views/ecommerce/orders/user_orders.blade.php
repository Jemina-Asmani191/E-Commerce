@extends('ecommerce.layouts.master')
@section('title','Orders')
@section('content')

        <!-- Start All Title Box -->
        <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>User Orders</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                                <th>Order Id</th>
                                <th>Ordered Product</th>
                                <th>Payment Method</th>
                                <th>Grand Total</th>
                                <th>Order Status</th>
                                <th>Order Date</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>
                                        @foreach($order->orders as $pro)
                                            <!-- <a href="#"> -->
                                                {{$pro->product_code}}
                                                ({{$pro->product_qty}})
                                            <!-- </a> -->
                                            <br/>
                                        @endforeach
                                    </td>
                                    <td>{{$order->payment_method}}</td>
                                    <td>{{$order->grand_total}}</td>
                                    <td>{{$order->order_status}}</td>
                                    <td>{{$order->created_at}}</td>
                            
                                    <td><a href="{{url('/orders/'.$order->id)}}">View Details</a></td>
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