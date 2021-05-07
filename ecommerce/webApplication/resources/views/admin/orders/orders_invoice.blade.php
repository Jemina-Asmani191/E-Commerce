<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
                <img src="{{asset('front_assets/images/logo.png')}}" alt="" style="margin-left:45%;"> 
                <h2>Invoice</h2><h3 class="pull-right" style="margin-top:-25px;">Order # {{$orderDetails->id}}</h3>
    		</div>
    		<hr width="100%">
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$userDetails->name}}<br>
    					{{$userDetails->address}}<br>
    					{{$userDetails->city}}<br>
                        {{$userDetails->state}}<br>
                        {{$userDetails->country}}<br>
                        {{$userDetails->pincode}}<br>
                        {{$userDetails->mobile}}<br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
                        {{$userDetails->name}}<br>
    					{{$userDetails->address}}<br>
    					{{$userDetails->city}}<br>
                        {{$userDetails->state}}<br>
                        {{$userDetails->country}}<br>
                        {{$userDetails->pincode}}<br>
                        {{$userDetails->mobile}}<br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong> {{$orderDetails->payment_method}}<br>
    					{{$userDetails->email}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$orderDetails->created_at->format('Y-M-d')}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
                                    <td><strong>Item Code</strong></td>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Size</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-center"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							@foreach ($orderDetails->orders as $pro) 
                                    <tr>
                                        <td>{{$pro->product_code}}</td>
                                        <td>{{$pro->product_name}}</td>
                                        <td class="text-center">{{$pro->product_size}}</td>
                                        <td class="text-center">{{$pro->product_price}}</td>
                                        <td class="text-center">{{$pro->product_qty}}</td>
                                        <?php $total = $pro->product_price * $pro->product_qty;?>
                                        <td class="text-center">Rs. {{$total}}</td>
                                    </tr>
                                @endforeach
                                <?php $subTotal = 0;?>
                                <?php $subTotal = $subTotal + ($total);?>
    							
                                <tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
                                    <td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-center">Rs. {{$subTotal}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping Charges (+)</strong></td>
    								<td class="no-line text-center">Rs. {{$orderDetails->shipping_charges}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Coupon Charges (-)</strong></td>
    								<td class="no-line text-center">Rs. {{$orderDetails->coupon_amount}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line text-center"><strong>Grand Total</strong></td>
    								<td class="no-line text-center">Rs. {{$orderDetails->grand_total}}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>