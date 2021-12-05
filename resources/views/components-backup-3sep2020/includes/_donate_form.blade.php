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
			<select id="donate" name="donation" class="donate" data-validation="required">
				<option value="">Select Donation</option>
				<option value="Education and hostel sponsorship of blind girl for a year rs. 36,000">Education and hostel sponsorship of blind girl for a year rs. 36,000</option>
				<option value="Computer or Laptop for a visually impaired person Rs. 30,000">Computer or Laptop for a visually impaired person Rs. 30,000</option>
				<option value="Lunch or dinner for children on a day of your choice Rs. 3,000">Lunch or dinner for children on a day of your choice Rs. 3,000</option>
				<option value="Braille inter-point for 10 visually impaired persons Rs. 2,500">Braille inter-point for 10 visually impaired persons Rs. 2,500</option>
				<option value="Folding Stick for 10 visually impaired persons Rs. 2,000">Folding Stick for 10 visually impaired persons Rs. 2,000</option>
				<option value="Pen drive for 2 visually impaired persons Rs. 1500">Pen drive for 2 visually impaired persons Rs. 1500</option>
				<option value="Custom Donation">Custom Donation</option>
			</select>
		</li>
		<li class="form-group">
			<input type="text" name="name" id="name"  placeholder="Name" data-validation="required"/>
			<span class="error_f_name" style="color:red"></span>
		</li>

		<li class="form-group">
			<input type="email" name="contact_email" id="contact_email" placeholder="Email" data-validation="required email"/>
			<span class="error_c_email" style="color:red"></span>
		</li>
		<li class="form-group">
			<input type="tel" name="phone" id="phone" placeholder="Phone" data-validation="required number"/>
			<span class="error_phone" style="color:red"></span>
		</li>
		<li class="form-group">
			<textarea name="comment" id="comment" placeholder="Address"></textarea>
			<span class="error_comment" style="color:red"></span>
		</li>
		<li class="form-group">
			<textarea name="comment" id="comment" placeholder="Message"></textarea>
			<span class="error_comment" style="color:red"></span>
		</li>
		<li class="fullwidth">
			<div class="radio-item form-group">
				<label class="radio-inline">
			      <input type="radio" name="payment_option" value="online" checked="" data-validation="required"> Payment
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="payment_option" value="DD or Cheque Pick Up" data-validation="required"> DD or Cheque Pick Up
			    </label>
			</div>
		</li>
		<li class="fullwidth">
			<div class="captcha form-group">
				<span class="captchImgBox"><?php echo $captcha_img; ?></span>
				<small>
					<img src="{{url('public')}}/images/refresh.png" class="changeCaptcha white-cpimg" alt="refresh">
				</small>
				<input type="text" name="scode" id="scode" value="{{old('scode')}}" class="inputfild scode" placeholder="Input Code" data-validation="required">
			</div>
			<span class="error_scode" style="color:red"></span>
		</li>
		<li>
			<button type="submit" class="button btnDonate">Submit</button>
		</li>
	</ul>
</form>