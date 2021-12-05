<?php
/*$form_fields_arr = array(
		['type'=>'text', 'name'=>'text', 'label'=>'Test', 'placeholder'=>'', 'title'=>'Test', 'class'=>'inputfild', 'id'=>'', 'atrributes'=>[]],
	);
	pr($form_fields_arr);*/
	?>
	<?php
	$captcha_img = captcha_img('custom');
//pr($captcha_img);
//pr($countries);
	?>


	<form method="POST" name="bookMealForm" id="bookMealForm" class="bookMealForm">	
		<div class="msg"></div>
		<h4>Personal Info</h4>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">Your Name <span class="required" title="This field is required.">*</span></label>
					<input type="text" class="form-control" name="name" id="name"  placeholder="Name" data-validation="required"  aria-required="true"/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="contact_email">Your E-mail Address <span class="required" title="This field is required.">*</span></label>
					<input type="email" name="contact_email" class="form-control" id="contact_email" placeholder="Email" data-validation="required email" required aria-required="true"/>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="phone">Your Contact Number <span  class="required" title="This field is required.">*</span></label>
					<input type="tel"  class="form-control" name="phone" id="phone" placeholder="Phone" data-validation="required number"  aria-required="true"/>
				</div>
			</div>
			<!-- <span class="error_phone" style="color:red"></span> -->
			<div class="col-md-6">
				<div class="form-group">
					<label for="phone">PAN (Optional)</label>
					<input type="text"  class="form-control" name="pan" id="pan" placeholder="PAN Number"/>
					<span>(If you need income tax exemption under 80G)</span>
					<!-- <span class="error_phone" style="color:red"></span> -->
				</div></div>
			</div>

			<h4>Billing Information</h4>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="booking_day">Date of Booking (DD/MM/YYYY)<span class="required" title="This field is required.">*</span></label>
						<div class="date-items">
							<div class="date-item">
								<label for="booking_day">Date</label>
								<select name="booking_day" id="booking_day" class="donate form-control" data-validation="required"  aria-required="true">
									<option value="">Date</option>
									<?php

									for($i=1; $i<=31; $i++){
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="date-item">
								<label for="booking_month">Month</label>
								<select name="booking_month" id="booking_month" class="donate form-control" data-validation="required" required aria-required="true">
									<option value=''>Month</option>
									<option value='1'>January</option>
									<option value='2'>February</option>
									<option value='3'>March</option>
									<option value='4'>April</option>
									<option value='5'>May</option>
									<option value='6'>June</option>
									<option value='7'>July</option>
									<option value='8'>August</option>
									<option value='9'>September</option>
									<option value='10'>October</option>
									<option value='11'>November</option>
									<option value='12'>December</option>
								</select>
							</div>
							<div class="date-item">
								<label for="booking_year">Year</label>
								<select name="booking_year" id="booking_year" class="donate form-control" data-validation="required" aria-required="true">
									<option value=''>Year</option>
									<?php
									$currentYear = date('Y');
									$maxYear = $currentYear + 10;

									for($i=$currentYear; $i<=$maxYear; $i++){
										?>
										<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
					</div></div>


					<div class="col-md-6">
						<div class="form-group">
							<label for="occasion">Select Occasion</label>
							<select id="occasion" name="occasion" class="donate form-control">
								<option value="">Select</option>
								<option value="Birthday" data-value="Birthday">Birthday</option>
								<option value="Marriage Anniversary"data-value="Marriage Anniversary">Marriage Anniversary</option>
								<option value="Death Anniversary" data-value="Death Anniversary">Death Anniversary</option>
								<option value="Other" data-value="Other">Other</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">

							<label for="type_of_meal">Select your Donation<span class="required" title="This field is required.">*</span></label>

							<select id="type_of_meal" name="type_of_meal" class="donate form-control" data-validation="required"  aria-required="true">
								<option value="">Select</option>
								<option value="Lunch for Visually Impaired Girls of the Hostel INR 3500" data-value="3500">Lunch for Visually Impaired Girls of the Hostel INR 3500</option>
								<option value="Dinner for Visually Impaired Girls of the Hostel INR 3500" data-value="3500">Dinner for Visually Impaired Girls of the Hostel INR 3500</option>
								<option value="Lunch & Dinner for Visually Impaired Girls of the Hostel INR 7000" data-value="7000">Lunch & Dinner for Visually Impaired Girls of the Hostel INR 7000</option>
								<option value="Lunch & Dinner for Visually Impaired Girls of the Hostel Custom Amount" data-value="custom-amount">Lunch & Dinner for Visually Impaired Girls of the Hostel Custom Amount</option>
							</select>
						</div>
					</div>

					<div class="col-md-6" >
						<div class="form-group" style="display: none;" id="custom_amount">

							<label for="book_for">Enter Custom Amount<span class="required" title="This field is required.">*</span></label>
							<input type="text" name="type_of_meal" class="form-control" id="amount" placeholder="Enter Custom Amount" data-validation="required "  aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-value = ""/>

						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-6">
						<div class="form-group">

							<label for="book_for">I would Like to Book for <span class="required" title="This field is required.">*</span></label>
							<select id="book_for" name="book_for" class="donate form-control" data-validation="required"  aria-required="true">
								<option value="">Select</option>
								<option value="Every Year" data-value="Every Year">Every Year</option>
								<option value="This Year Only" data-value="This Year Only">This Year Only</option>
							</select>
							<!-- <span class="error_address" style="color:red"></span> -->

						</div>
					</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Your Address</label>
								<input type="text" name="address" id="address" class="form-control"  placeholder="Address" data-validation="required"/>
							</div>
						</div>
					</div>

					<!-- <div class="row">
						<div class="col-md-6">
							<div class="form-control">
								<label for="country">Select your Country<span class="required" title="This field is required.">*</span></label>
								<select id="country" name="country" class="donate form-control">
									<option value="" selected="">Select your Country</option>
									<?php foreach($countries as $countr){?>
										<option value="{{$countr->id}}">{{$countr->name}}</option>
									<?php }?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-control">
								<label for="state">Select your State<span class="required" title="This field is required.">*</span></label>
								<select class="donate form-control" id="state" name="state">
									<option value="" selected>Select Your State</option>
								</select>
							</div>
							
						</div>
					</div> -->

					<div class="row">
					<div class="col-md-6">
						<div class="form-group">

							<label for="country">Select your Country<span class="required" title="This field is required.">*</span></label>
							<select id="country" name="country" class="donate form-control" data-validation="required"  aria-required="true">
								<option value="" selected="">Select your Country</option>
									<?php foreach($countries as $countr){?>
										<option value="{{$countr->id}}">{{$countr->name}}</option>
									<?php }?>
							</select>
						</div>
					</div>

						<div class="col-md-6" id="state_select">
							<div class="form-group">
								<label for="state">Select your State<span class="required" title="This field is required.">*</span></label>
								<select class="donate form-control" id="state" name="state">
									<option value="" selected>Select Your State</option>
								</select>

							</div>
						</div>


						<div class="col-md-6" id="state_text" style="display: none;">
							<div class="form-group">
								<label for="state">Enter Your State<span class="required" title="This field is required.">*</span></label>
								<input type="text" name="state" class="form-control" placeholder="Enter State" data-validation="required" required aria-required="true">

							</div>
						</div>



					</div>











						<div class="row">
						<button class="button btnBookMeal">Pay Later</button>

						<button class="button btnBookMealPayNow">Pay Now</button>
					
					</div>

			</form>


<!-- ALTER TABLE `enquiries` ADD `pan` VARCHAR(100) NULL AFTER `data`; -->
<!--  -->