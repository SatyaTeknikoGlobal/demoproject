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
			<label>Your Name</label><sup title="This is Required Field">*</sup>
			<input type="text" name="name" id="name"  placeholder="Name" data-validation="required"/>
			<span class="error_f_name" style="color:red"></span>
		</li>

		<li class="form-group">
			<label>Your E-mail Id</label><sup title="This is Required Field">*</sup>
			<input type="email" name="contact_email" id="contact_email" placeholder="Email" data-validation="required email"/>
			<span class="error_c_email" style="color:red"></span>
		</li>
		<li class="form-group">
			<label>Your Contact Number</label><sup title="This is Required Field">*</sup>
			<input type="tel" name="phone" id="phone" placeholder="Phone" data-validation="required number"/>
			<span class="error_phone" style="color:red"></span>
		</li>
		<li class="form-group">
			<label>Date Of Booking</label><sup title="This is Required Field">*</sup>
			<input type="tel" name="date_of_booking" id="date_of_booking" placeholder="Date Of Booking" data-validation="required"/>
			<span class="error_phone" style="color:red"></span>
		</li>
		<li class="form-group">
			<label>Type Of Meal</label><sup>*</sup>
			<div class="radio-item">
				<label class="radio-inline">
			      <input type="radio" name="type_of_meal" value="lunch" checked="" data-validation="required">Lunch
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="type_of_meal" value="dinner" data-validation="required">Dinner
			    </label>
			</div>
		</li>
		<li class="form-group">
			<label>I Would Like To Book For</label><sup title="This is Required Field">*</sup>
			<div class="radio-item">
				<label class="radio-inline">
			      <input type="radio" name="book_for" value="This Year Only" checked="" data-validation="required">This Year Only
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="book_for" value="Every Year" data-validation="required">Every Year
			    </label>
			</div>
		</li>
		

		<li class="form-group fullwidth">
			<label>Your Address</label>
			<textarea name="address" id="address" placeholder="Address"></textarea>
			<span class="error_address" style="color:red"></span>
		</li>
		
		<li>
			<button class="button btnBookMeal">Submit</button>
		</li>
	</ul>
</form>
