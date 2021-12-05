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
	<!-- <div class="form-title">
		<span>One-time Meal Booking Form</span>
	</div> -->
	<ul class="formfild">

		<li class="form-group">
			<label for="name">Your Name <span title="This field is required.">*</span></label>
			<input type="text" name="name" id="name"  placeholder="Name" data-validation="required" required aria-required="true"/>
			<span class="error_f_name" style="color:red"></span>
		</li>

		<li class="form-group">
			<label for="contact_email">Your E-mail Address <span title="This field is required.">*</span></label>
			<input type="email" name="contact_email" id="contact_email" placeholder="Email" data-validation="required email" required aria-required="true"/>
			<span class="error_c_email" style="color:red"></span>
		</li>
		<li class="form-group">
			<label for="phone">Your Contact Number <span title="This field is required.">*</span></label>
			<input type="tel" name="phone" id="phone" placeholder="Phone" data-validation="required number" required aria-required="true"/>
			<span class="error_phone" style="color:red"></span>
		</li>
		<li class="form-group">
			<label for="booking_day">Date of Booking (DD/MM/YYYY)<span title="This field is required.">*</span></label>
			<div class="date-items">
				<div class="date-item">
					<label for="booking_day">Date</label>
					<select name="booking_day" id="booking_day" class="donate" data-validation="required" required aria-required="true">
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
					<select name="booking_month" id="booking_month" class="donate" data-validation="required" required aria-required="true">
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
					<select name="booking_year" id="booking_year" class="donate" data-validation="required" required aria-required="true">
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
			
			<span class="error_phone" style="color:red"></span>
		</li>
		<li class="form-group" style="clear: both;">
			<label for="type_of_meal">Type of Meal <span title="This field is required.">*</span></label>
			<!-- <div class="radio-item"> -->
				<!-- <label class="radio-inline">
			      <input type="radio" name="type_of_meal" id="type_of_meal" value="lunch" checked="" data-validation="required" required aria-required="true">Lunch
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="type_of_meal" id="type_of_meal" value="dinner" data-validation="required" required aria-required="true">Dinner
			    </label> -->
			    <select id="type_of_meal" name="type_of_meal" class="donate" data-validation="required" required aria-required="true">
			    	<option value="">Select</option>
			    	<option value="Lunch for Visually Impaired Girls of the Hostel INR 3500" data-value="3500">Lunch for Visually Impaired Girls of the Hostel INR 3500</option>
			    	<option value="Dinner for Visually Impaired Girls of the Hostel INR 3500" data-value="3500">Dinner for Visually Impaired Girls of the Hostel INR 3500</option>
			    	<option value="Lunch & Dinner for Visually Impaired Girls of the Hostel INR 7000" data-value="7000">Lunch & Dinner for Visually Impaired Girls of the Hostel INR 7000</option>
			    </select>

			<!-- </div> -->
		</li>
		<li class="form-group">
			<label for="book_for">I would Like to Book for <span title="This field is required.">*</span></label>
			<div class="radio-item">
				<label class="radio-inline">
			      <input type="radio" name="book_for" id="book_for" value="Every Year" checked="" data-validation="required" required aria-required="true">Every Year
			    </label>
				<label class="radio-inline">
			      <input type="radio" name="book_for" id="book_for" value="This Year Only"  data-validation="required" required aria-required="true">This Year Only
			    </label>
			    
			</div>
		</li>
		

		<li class="form-group fullwidth">
			<label>Your Address</label>
			<textarea name="address" id="address" placeholder="Address"></textarea>
			<span class="error_address" style="color:red"></span>
		</li>
		
		<li>
			<button class="button btnBookMeal">Pay Later</button>

			<button class="button btnBookMealPayNow">Pay Now</button>
		</li>
	</ul>
</form>
