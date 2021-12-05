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
					<div class="heading2">My Orders</div>

					<?php //prd($orders); ?>


					<div class="ordersec ">
						<ul>

							<?php
							if(!empty($orders) && count($orders) > 0){ 
								foreach ($orders as $order){ 

									$orderItems = $order->orderItems;
									$orderStatusDetails = $order->orderStatusDetails;
									$noOfItem = $orderItems->count();
						//pr($orderStatusDetails->toArray());
									?>

									<?php
									if(!empty($orderItems) && count($orderItems) > 0){
										?>
										<li>
											<div class="orderlist fullwidth">
												<p><span><strong>{{$orderStatusDetails->name}}</strong>Order No: {{$order->order_no}}</span></p>
												<p>Placed on: <?php echo CustomHelper::DateFormat($order->created_at, $toFormat='M d, Y', $fromFormat=''); ?> / ₹{{number_format($order->total)}} / {{$noOfItem}} Item(s) </p>
												<?php
												/*
												<div class="orderdetail">Detail | <a href="{{url('users/orders/'.$order->order_no)}}">View Details</a></div>
												*/
												?>
												<div class="orderdetail"><a href="{{url('users/orders/'.$order->order_no)}}">View Details</a></div>
											</div>


											<div class="detailbox fullwidth">
												<ul class="cartlist">

													<?php 
													$storage = Storage::disk('public');
													$img_path = 'products/';
													$thumb_path = $img_path.'thumb/';

													foreach ($orderItems as $item) {	

														$product = $item->productDetail;

														$defaultImage = $product->defaultImage;
														$productBrand = $product->productBrand;
														$sale_price = $product->sale_price;

														if(!empty($productBrand) && count($productBrand) > 0){
															$brandName = $productBrand->name;
														}


														if(!empty($defaultImage) && count($defaultImage) > 0){
															if(!empty($defaultImage->image) && $storage->exists($thumb_path.$defaultImage->image) ){
																$imgUrl = url('public/storage/'.$thumb_path.$defaultImage->image);
															}
														}
														?>
														<li>
															<?php
															if(!empty($imgUrl)){
																?>
																<div class="cartimg">
																	<img src="{{$imgUrl}}">
																</div>
																<?php
															}
															?>

															<div class="procont">
																<div class="titles">
																	<p><span>{{$brandName}}</span></p>
																	<p>{{$product->name}}</p>
																</div>
																<div class="cartprice"><span>₹<?php echo number_format($sale_price);?></span></div>

																<div class="sizeqty">
																	<div class="size">SIZE : {{$item->size_name}}</div>
																	<div class="qty">QTY : {{$item->qty}}</div>
																</div>

															</div>
														</li>
														<?php
													}
													?>

												</ul>
											</div>
										</li>
										<?php
									} 
								} 
							}
							?>

						</ul>
					</div>
				</div> 
			</div>
		</div>
	</section>


	@include('common.footer')
	
	<script>

		$(".orderdetail").click(function(){	
			//$(this).parent().next().slideToggle();
		});
	</script>

</body>
</html>