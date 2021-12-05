<?php
/*$form_fields_arr = array(
		['type'=>'text', 'name'=>'text', 'label'=>'Test', 'placeholder'=>'', 'title'=>'Test', 'class'=>'inputfild', 'id'=>'', 'atrributes'=>[]],
	);
	pr($form_fields_arr);*/
?>
<?php
$current_uri = request()->segment(1);

//pr($current_uri);

$captcha_img = captcha_img('custom');
?>

<div class="msg"></div>
<form method="POST" name="contactForm" onsubmit="return validate_contactform()">	
	<ul class="formfild">

		<input type="hidden" name="forSub" id="forSub" value="{{$current_uri}}">
		<li>
			<label>Your Name</label>
			<input type="text" name="name" id="name"  placeholder="Name" />
			<span class="error_f_name" style="color:red"></span>
		</li>
		<li>
			<label>Your Email</label>
			<input type="email" name="contact_email" id="contact_email" placeholder="Email" />
			<span class="error_c_email" style="color:red"></span>
		</li>
		<li>
			<label>Your Phone</label>
			<input type="tel" name="phone" id="phone" placeholder="Phone" />
			<span class="error_phone" style="color:red"></span>
		</li>

		<?php
		if($current_uri == 'volunteer'){
		?>
		<li>
			<label>Enter Subject</label>
			<select name="subject" id="subject">
				<option value="Reading Books">Reading Books</option>
				<option value="Writing Assignments">Writing Assignments</option>
				<option value="Content Writing">Content Writing</option>
				<option value="Website Development">Website Development</option>
				<option value="Fund Raising">Fund Raising</option>
				<option value="Events">Events</option>
				<option value="Picnics">Picnics</option>
				<option value="Other">Other</option>
			</select>
			<span class="error_subject" style="color:red"></span>
		</li>

		<?php
		}
		else {
		?>
		<li>
			<label>Enter Subject</label>
			<input type="text" name="subject" id="subject" placeholder="Subject">
			<span class="error_subject" style="color:red"></span>
		</li>

		<?php } ?>

		<li class="fullwidth">
			<label>Your Message</label>
			<textarea name="comment" id="comment" placeholder="Message"></textarea>
			<span class="error_comment" style="color:red"></span>
		</li>
		<?php /*
		<li>
			<div class="captcha">
				<span class="captchImgBox"><?php echo $captcha_img; ?></span>
				<small>
					<img class="refresh-black-img" src="{{url('public')}}/images/refresh.png" class="changeCaptcha white-cpimg" alt="refresh">
					<img class="refresh-white-img" src="{{url('public')}}/images/refresh-white.png" class="changeCaptcha white-cpimg" alt="refresh">
				</small>
				<input type="text" name="scode" id="scode" value="{{old('scode')}}" class="inputfild scode" placeholder="Input Code">
			</div>
			<span class="error_scode" style="color:red"></span>
		</li>*/?>
		<li> 
			<button class="button">Submit</button>
		</li>
	</ul>
</form>