@extends('ecommerce.layouts.master')
@section('title','Checkout')
@section('content')

<div class="contact-box-main">
    <div class="container">
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
        <form action="{{url('/checkout')}}" method="POST" id="contactForm registerForm"> {{csrf_field()}}
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <!-- Bill to form -->
                    <div class="contact-form-right">
                        <h2>Bill To</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif @if(empty($userDetails->name))  placeholder="Billing Name" @endif  id="billing_name" name="billing_name" required data-error="Please Enter Your Billing Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif @if(empty($userDetails->address))  placeholder="Billing Address" @endif id="billing_address" name="billing_address" required data-error="Please Enter Your Billing Address">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif @if(empty($userDetails->city)) placeholder="Billing City" @endif id="billing_city" name="billing_city" required data-error="Please Enter Your Billing City">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif @if(empty($userDetails->state))  placeholder="Billing State" @endif id="billing_state" name="billing_state" required data-error="Please Enter Your Billing State">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="billing_country" id="billing_country" class="form-control">
                                            <option value="1">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->country_name}}" @if(!empty
                                                    ($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif @if(empty($userDetails->pincode)) placeholder="Billing Pincode"  @endif id="billing_pincode" name="billing_pincode" required data-error="Please Enter Your Billing Pincode">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif @if(empty($userDetails->mobile)) placeholder="Billing Number" @endif id="billing_mobile" name="billing_mobile" required data-error="Please Enter Your Billing Mobile">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" style="margin-left:30px;">
                                        <input type="checkbox" class="form-check-input" id="billtoship">
                                        <label for="billtoship" class="form-check-label">Shipping Address Same As Billing Address</label>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- ship to form -->
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Ship To</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Name" @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif id="shipping_name" name="shipping_name" required data-error="Please Enter Your Shipping Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Address" @if(!empty($shippingDetails->address))  value="{{$shippingDetails->address}}" @endif id="shipping_address" name="shipping_address" required data-error="Please Enter Your Shipping Address">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping City" @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif id="shipping_city" name="shipping_city" required data-error="Please Enter Your Shipping City">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping State" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif id="shipping_state" name="shipping_state" required data-error="Please Enter Your Shipping State">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="shipping_country" id="shipping_country" class="form-control">
                                            <option value="1">Select Country</option>
                                                @foreach ($countries as $country)
                                                <option value="{{$country->country_name}}" @if(!empty
                                                    ($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif>
                                                    {{$country->country_name}}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Pincode" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif id="shipping_pincode" name="shipping_pincode" required data-error="Please Enter Your Shipping Pincode">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Mobile No" @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif id="shipping_mobile" name="shipping_mobile" required data-error="Please Enter Your Shipping Mobile">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">Checkout</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection