@extends('ecommerce.layouts.master')
@section('title','Thanks')
@section('content')

        <!-- Start All Title Box -->
        <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Thanks For Purchasing With Us!</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Thanks</li>
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
                    <div align="center" class="">
                        <h2>YOUR COD ORDER HAS BEEN PLACED</h2>
                        <p>Your Order Number is {{Session::get('order_id')}} and total payable amount is Rs. {{Session::get('grand_total')}}</p>
                    </div>
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