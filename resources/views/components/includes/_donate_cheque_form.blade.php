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

<form method="POST" name="donateChequeForm" id="donateChequeForm" class="donateChequeForm">	
<div class="msg"></div>
	<ul class="formfild">

		<li class="fullwidth">
			<div class="radio-item form-group">
				<label class="radio-inline">
			      <input type="radio" name="payment_option" value="Need your cheque pick up service" checked="" data-validation="required">Need your cheque pick up service
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="payment_option" value="No, I will send it by post" data-validation="required">No, I will send it by post
			    </label>
			</div>
		</li>

		<li class="form-group">
			<label for="name">Your Name <span title="This field is required.">*</span></label>
			<input type="text" name="name" id="name"  placeholder="Name" data-validation="required" required aria-required="true"/>
			<span class="error_f_name" style="color:red"></span>
		</li>

		<li class="form-group">
			<label for="contact_email">Your Email <span title="This field is required.">*</span></label>
			<input type="email" name="contact_email" id="contact_email" placeholder="Email" data-validation="required email" required aria-required="true"/>
			<span class="error_c_email" style="color:red"></span>
		</li>
		<li class="form-group" style="width: 100%">
			<label for="phone">Your Phone <span title="This field is required.">*</span></label>
			<input type="tel" name="phone" id="phone" placeholder="Phone" data-validation="required number" required aria-required="true"/>
			<span class="error_phone" style="color:red"></span>
		</li>

		<?php /*
		<li class="form-group">
			<label>Select Country</label>
			<select id="country" name="country" class="country">
				<option value="">Select Country</option>
				<?php
				if(!empty($countries)){
					foreach ($countries as $country){
						?>
						<option value="{{$country->name}}">{{$country->name}}</option>
						<?php
					}
				}
				?>
			</select>
		</li> 

		<li class="form-group fullwidth">
			<label>Your State</label>
			<input type="state" name="state" id="state" placeholder="State"/>
			<span class="error_state" style="color:red"></span>
		</li> */?>

		<li class="form-group fullwidth">
			<label>Your Address</label>
			<textarea name="address" id="address" placeholder="Address"></textarea>
			<span class="error_address" style="color:red"></span>
		</li>
		
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
			<button type="submit" class="button btnDonateCheque">Submit</button>
		</li>
	</ul>
</form>