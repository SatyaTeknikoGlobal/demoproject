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

<div class="msg"></div>
<form method="POST" name="contactForm" onsubmit="return validate_contactform()">	
	<ul class="formfild">
		<li>
			<input type="text" name="name" id="name"  placeholder="Name" />
			<span class="error_f_name" style="color:red"></span>
		</li>
		<li>
			<input type="email" name="contact_email" id="contact_email" placeholder="Email" />
			<span class="error_c_email" style="color:red"></span>
		</li>
		<li>
			<input type="tel" name="phone" id="phone" placeholder="Phone" />
			<span class="error_phone" style="color:red"></span>
		</li>
		<li>
			<input type="text" name="subject" id="subject" placeholder="Subject">
			<span class="error_subject" style="color:red"></span>
		</li>
		<li class="fullwidth">
			<textarea name="comment" id="comment" placeholder="Message"></textarea>
			<span class="error_comment" style="color:red"></span>
		</li>
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
		</li>
		<li>
			<button class="button">Submit</button>
		</li>
	</ul>
</form>