<?php
/*$form_fields_arr = array(
		['type'=>'text', 'name'=>'text', 'label'=>'Test', 'placeholder'=>'', 'title'=>'Test', 'class'=>'inputfild', 'id'=>'', 'atrributes'=>[]],
	);
	pr($form_fields_arr);*/
?>
<?php
$captcha_img = captcha_img('custom');
//pr($captcha_img);
?>

<form method="POST" name="donateForm" id="donateForm" class="donateForm">	
<div class="msg"></div>
	<ul class="formfild">
		<li class="form-group">
			<label>Select Donation <span title="This field is required.">*</span></label>
			<select id="donate" name="donation" class="donate" data-validation="required" onchange="showAmountBox(this.value)">
				<option value="">Select Donation</option>
				<option value="Education and hostel sponsorship of blind girl for a year INR 36,000" data-value="36000">Education and hostel sponsorship of blind girl for a year INR 36,000</option>
				<option value="Computer or Laptop for a visually impaired person INR 30,000" data-value="30000">Computer or Laptop for a visually impaired person INR 30,000</option>
				<option value="Lunch or dinner for children on a day of your choice INR 3,500" data-value="3500">Lunch or dinner for children on a day of your choice INR 3,500</option>
				<option value="Braille inter-point for 10 visually impaired persons INR 2,500" data-value="2500">Braille inter-point for 10 visually impaired persons INR 2,500</option>
				<option value="Folding Stick for 10 visually impaired persons INR 2,000" data-value="2000">Folding Stick for 10 visually impaired persons INR 2,000</option>
				<option value="Pen drive for 2 visually impaired persons INR. 1500" data-value="1500">Pen drive for 2 visually impaired persons INR 1500</option>
				<option value="Custom Donation" data-value="custom-amount">Custom Donation</option>
			</select>
		</li>
		<!-- <input type="hidden" name=""> -->
		<li class="form-group" id="amount_id" style="display:none">
			<label>Amount <span title="This field is required.">*</span></label>
			<input type="text" name="amount" id="amount"  placeholder="Amount" data-validation="required custom" data-validation-regexp="^([0-9]+)$" data-validation-error-msg-custom = "This should be numeric text"/>
			<span id="error_amount" style="color:red"></span>
		</li>

		<li class="form-group">
			<label>Your Name <span title="This field is required.">*</span></label>
			<input type="text" name="name" id="name"  placeholder="Name" data-validation="required"/>
			<span class="error_f_name" style="color:red"></span>
		</li>

		<li class="form-group">
			<label>Your Email <span title="This field is required.">*</span></label>
			<input type="email" name="contact_email" id="contact_email" placeholder="Email" data-validation="required email"/>
			<span class="error_c_email" style="color:red"></span>
		</li>
		<li class="form-group phone-donate-c">
			<label>Your Phone <span title="This field is required.">*</span></label>
			<input type="tel" name="phone" id="phone" placeholder="Phone" data-validation="required number"/>
			<span class="error_phone" style="color:red"></span>
		</li>
		<li class="form-group">
			<label>Your Address <span title="This field is required.">*</span></label>
			<textarea name="address" id="address" placeholder="Address" data-validation="required"></textarea>
			<span class="error_address" style="color:red"></span>
		</li>
		<!-- <li class="form-group">
			<label>Your Message</label>
			<textarea name="comment" id="comment" placeholder="Message"></textarea>
			<span class="error_comment" style="color:red"></span>
		</li> -->
		<!-- <li class="fullwidth">
			<div class="radio-item form-group">
				<label class="radio-inline">
			      <input type="radio" name="payment_option" value="online" checked="" data-validation="required"> Payment
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="payment_option" value="DD or Cheque Pick Up" data-validation="required"> DD or Cheque Pick Up
			    </label>
			</div>
		</li> -->
		<?php /*
		<li class="fullwidth">
			<div class="captcha form-group">
				<span class="captchImgBox"><?php echo $captcha_img; ?></span>
				<small>
					<img src="{{url('public')}}/images/refresh.png" class="changeCaptcha white-cpimg" alt="refresh">
				</small>
				<input type="text" name="scode" id="scode" value="{{old('scode')}}" class="inputfild scode" placeholder="Input Code" data-validation="required">
			</div>
			<span class="error_scode" style="color:red"></span>
		</li> */ ?>
		<li>
			<button type="submit" class="button btnDonate" id="paybtn">Submit</button>
		</li>
	</ul>
</form>