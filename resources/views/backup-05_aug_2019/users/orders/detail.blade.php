<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo (isset($meta_title))?$meta_title:'SlumberJill'?></title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="index, follow"/>
<meta name="robots" content="noodp, noydir"/>

@include('common.head')

</head>

<body>

@include('common.header')
<section class="fullwidth innerpage">
	<div class="container">
		@include('users.nav')

		<div class="rightcontent">
			<div class="main_inner_box">
				<div class="heading2">Order # {{$orderNo}}</div>

				<?php //prd($orders); ?>


				<div class="ordersec ">

					<?php
//prd($order->toArray());
					if(!empty($order) && $order->count() > 0){


						$address = $order->billing_address;
						$locality = $order->billing_locality;
						$pincode = $order->billing_pincode;
// /prd($order->toArray());

						$billingCity = $order->billingCity;
						$billingState = $order->billingState;
						$billingCountry = $order->billingCountry;

						$billingCityName = '';
						$billingStateName = '';
						$billingCountryName = '';

						if(isset($billingCity->name) && !empty($billingCity->name)){
							$billingCityName = $billingCity->name;
						}
						if(isset($billingState->name) && !empty($billingState->name)){
							$billingStateName = $billingState->name;
						}
						if(isset($billingCountry->name) && !empty($billingCountry->name)){
							$billingCountryName = $billingCountry->name;
						}


						$address = $order->shipping_address;
						$locality = $order->shipping_locality;
						$pincode = $order->shipping_pincode;

						$shippingCity = $order->shippingCity;
						$shippingState = $order->shippingState;
						$shippingCountry = $order->shippingCountry;

						$shippinCityName = '';
						$shippinStateName = '';
						$shippinCountryName = '';

						if(isset($shippingCity->name) && !empty($shippingCity->name)){
							$shippinCityName = $shippingCity->name;
						}
						if(isset($shippingState->name) && !empty($shippingState->name)){
							$shippinStateName = $shippingState->name;
						}
						if(isset($shippingCountry->name) && !empty($shippingCountry->name)){
							$shippinCountryName = $shippingCountry->name;
						}


						$billingAddrArr = CustomHelper::formatOrderAddress($order, $isBilling=true, $isPhone=true, $isEmail=false);
						$shippingAddrArr = CustomHelper::formatOrderAddress($order, $isBilling=false, $isPhone=true, $isEmail=false);

						//echo implode('<br>', $billingAddrArr);

						?>
						<div class="orderheading bgcolor row">
							<div class="col-sm-12">
								<div class="top_orders_sec_wrap">
								<div class="top_orders_sec">
										<label>Order No :</label> {{$orderNo}}
									</div>
									<div class="top_orders_sec">
										<label>Added on:</label> <?php $added_on = CustomHelper::DateFormat($order->created_at, 'd F y'); ?>{{$added_on}}
									</div>
									<div class="top_orders_sec">
										<label>Order Status:</label> <?php echo $order->order_status; ?>
									</div>
										<div class="top_orders_sec">
										<label> Payment Status:</label>  <?php echo $order->payment_status;  ?> 
									</div>
								</div>
							</div>
							<!-- <div class="col-sm-6 col-md-3 ">
								<label>Order No :</label> {{$orderNo}}
							</div>
							<div class="col-sm-6 col-md-3 ">
								<label>Added on:</label> <?php $added_on = CustomHelper::DateFormat($order->created_at, 'd F y'); ?>{{$added_on}}
							</div>
							<div class="col-sm-6 col-md-3 ">
								<label>Order Status:</label> <?php echo $order->order_status; ?>
							</div>
							<div class="col-sm-6 col-md-3">
								<label> Payment Status:</label>  <?php echo $order->payment_status;  ?> 
							</div> -->
						</div> 
						<div class="selectadd row"> 
							<div class="col-sm-6">

								<div class="form-group addselectbox">

									<div class="addlist">
										<h4><strong>Billing Address</strong></h4>
										
										<?php echo '<p>'.implode('</p><p>', $billingAddrArr).'</p>'; ?>
										
										<?php
										/*
										<p><span>Name :</span> {{$order->billing_name}}</p>
										<p><span>Email :</span> {{$order->billing_email}}</p>
										<p><span>Phone :</span> {{$order->billing_phone}}</p> 
										<p><span>Address :</span>  <?php
										if(!empty($order->billing_address)) { echo $order->billing_address; echo ',';} ?>

									{{$billingCityName}}</p> 
									<p><span>Pin Code :</span> {{$order->billing_pincode}}</p>
									<p><span>State :</span> {{$billingStateName}}</p> 
									<p><span>Country :</span> {{$billingCountryName}}</p>
										*/
										?>
										 
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group addselectbox">
								<div class="addlist">
									<h4><strong>Shipping Address</strong></h4>

									<?php echo '<p>'.implode('</p><p>', $shippingAddrArr).'</p>'; ?>
									
									<?php
									/*
									<p><span>Name :</span> {{$order->shipping_name}}</p>
									<p><span>Email :</span> {{(!empty($order->shipping_email))?$order->shipping_email:$order->billing_email}}</p>
									<p><span>Phone :</span> {{$order->shipping_phone}}</p>
									<p><span>Address :</span> {{$order->shipping_address}}, {{$order->shipping_locality}}, {{$shippinCityName}}</p> 
									<p><span>Pin Code :</span> {{$order->shipping_pincode}}</p>
									<p><span>State :</span> {{$shippinStateName}} </p>
									<p><span>Country :</span> {{$shippinCountryName}} </p>
									*/
									?>
									
								</div>
							</div>
						</div>
					</div>

					@include('common._order_details')

					<?php
				}
				?>

			</div>
		</div> 
	</div>
</div>
</section>
 

@include('common.footer')



</body>
</html>