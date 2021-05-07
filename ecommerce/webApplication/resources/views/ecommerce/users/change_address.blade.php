@extends('ecommerce.layouts.master')
@section('title','Change Address')
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
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- Signup / register form -->
                <div class="contact-form-right">
                    <h2>Change Address</h2>
                    <form action="{{url('/change_address')}}" method="post" id="contactForm registerForm"> {{csrf_field()}}
                        <div class="row">
                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->name}}" id="name" name="name" placeholder="Enter Name" required data-error="Please Enter Your Name" title="Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Address" value="{{$userDetails->address}}" id="address" name="address" required data-error="Please Enter Your Address" title="Address">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter City" value="{{$userDetails->city}}" id="city" name="city" required data-error="Please Enter Your City" title="City">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter State" value="{{$userDetails->state}}" id="state" name="state" required data-error="Please Enter Your State" title="State">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="country" id="country" class="form-control">
                                        <option value="1">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Pincode" value="{{$userDetails->pincode}}" id="pincode" name="pincode" required data-error="Please Enter Your Pincode" title="Pincode">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Mobile No" value="{{$userDetails->mobile}}" id="mobile" name="mobile" required data-error="Please Enter Your Mobile" title="Mobile">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Save</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

@endsection