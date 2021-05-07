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
            
    
    <div class="cart-box-main">            
        <div class="container">
            <div class="row">
            @if(!empty(Session::get('grand_total')))
                <div class="col-lg-6">
                    <div align="center">
                        <h2>YOUR ORDER HAS BEEN PLACED</h2>
                        <p>Your Order Number is {{Session::get('order_id')}} and total payable amount is Rs. {{Session::get('grand_total')}}</p>
                        <b>Please make payment by entering your credit or debit card</b>
                    </div>
                </div>

                <div class="col-lg-6">
                        <!-- <h2>PAYMENT METHOD FORM</h2> -->
                        <script src="https://js.stripe.com/v3/"></script>
                        
                        <form id="payment-form" method="POST" action="/stripe"> {{ csrf_field() }}
                            <div class="form-row">
                                <b>Total Amount To be Paid</b>
                                <input readonly name="total_amount" value="{{Session::get('grand_total')}}" class="form-control"></input>
                                <b>Your Name</b>
                                <input type="text" name="name" placeholder="Enter Your Name" value="" class="form-control"></input>
                                <!-- Elements will create input elements here -->
                                <label for="card-element">
                                    Credit Number Card
                                </label>
                            </div>
                            <div id="card-element">

                            </div>
                            <!-- We'll put the error messages in this element -->
                            <div id="card-errors" role="alert"></div>

                            <button class="btn btn-success btn-mini" style="float:right;margin-top:10px;">Submit Payment</button>
                        </form>
                </div>
                @else
                    <div class="col-lg-12">
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
                        <div align="center" class="">
                            <h2>YOUR ORDER HAS BEEN PLACED</h2>
                            <p>For check Your orders clicks on <a href="{{url('/orders')}}">Order details</a></p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        //create a stripe client
        var stripe = Stripe('pk_test_51IbfznSD3DwIKFuRI07sblDx8ILSymvSV9tHrBC0G2PaViCPfhrV9UiWV1TnMjFudc3OyjcGxlHiAksXjkbJdtOZ00RFRshBSt');

        //create a instance of element
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                fontSize: '16px',
                fontFamily: '"Open Sans", sans-serif',
                fontSmoothing: 'antialiased',
                '::placeholder': {
                    color: '#aab7c4',
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        //create a instance of card element
        var card = elements.create('card', {style: style});

        //add an instance of card element into the `card-element` <div>.
        card.mount('#card-element');

        //handle real-time validation errors from the card element
        card.on('change',function(event) {
            var displayError =document.getElementById('card-error');
            if(event.error){
                displayError.textContent = event.error.message;
            }else{
                displayError.textContent = '';
            }
        });

        //handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit',function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result){
                if(result.error){
                    var errorElement = document.getElementById('card-error');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        //submit the form with the Token Id.
        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name','stripe-token');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            //submit the form
            form.submit();
        }
    </script>
@endsection

<?php
    Session::forget('order_id');
    Session::forget('grand_total');
?>