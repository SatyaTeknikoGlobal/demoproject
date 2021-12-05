@component('themes.theme-1.layouts.main')

@slot('title')
    Volunteer
@endslot

@slot('meta_description')
    {{$meta_description or ''}}
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />
@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  forms
@endslot

<?php
$id = (isset($form->id))?$form->id:'';
$name = (isset($form->name))?$form->name:'';
$thank_you_msg = (isset($form->thank_you_msg))?$form->thank_you_msg:'';
$google_map = (isset($form->google_map))?$form->google_map:'';
$lat_lang = (isset($form->lat_lang))?$form->lat_lang:'';
$captcha = (isset($form->captcha))?$form->captcha:'';
$top_left_content = (isset($form->top_left_content))?$form->top_left_content:'';
$top_right_content = (isset($form->top_right_content))?$form->top_right_content:'';
$bottom_content = (isset($form->bottom_content))?$form->bottom_content:'';
$form_fields = (isset($form->form_fields))?$form->form_fields:'';
$template = (isset($form->template))?$form->template:'';
$status = (isset($form->status))?$form->status:'';

//$formElements = (isset($form->formElements))?$form->formElements:'';
//prd($form);
?>

<section class="fullwidth innerbanner" style="background: url(<?php echo asset('public/assets/themes/theme-1/images/blog-banner.jpg'); ?>) center center no-repeat;"></section>
<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>Volunteer</li>			
		</ul>
	</div>
</div>
<section class="fullwidth innerpage" id="forms">
<div class="container">
	<div class="servcont text-center">
  <div class="headings headings-with-border">Volunteer</div>
</div>
<?php
if(!empty($top_left_content) || !empty($top_right_content)){
?>

<div class="contact_content">

	<div class="theme_row">
		<?php
		if(!empty($top_left_content)){
			?>
		<div class="theme_col_6">
			<div class="para_discription">
				<?php echo $top_left_content;
				?>
			</div>
		</div>
		<?php } ?>

		<?php
		if(!empty($top_right_content)){
			?>
		<div class="theme_col_6">
			<div class="para_discription">
				<?php 
				echo $top_right_content;
				?>
			</div>
		</div>
		<?php } ?>	

		<div class="clear"></div>
	</div>
</div>

<?php } ?>


<?php
if($google_map == '1'){
	?>
	<div class="contact_right">
		<?php //echo $map['html'];
		?> 
	</div>
	<?php } ?>


	<div class="contact-inner df-form">
		<div class="contact-form-block">
        <div class="contact-form-area">
	<?php
	if(!empty($formElements)){ 
		//pr($formElements->toArray());?>
		@include('snippets.front.flash')
		
		<form class="clearfix" method="POST" action="" accept-charset="UTF-8" role="form" enctype="multipart/form-data">
			{{ csrf_field() }}
		<input type="hidden" name="form_id" value="{{$id}}">
		<?php
		foreach($formElements as $fe){
			?>
			<div class="form-group col-sm-12">
				<label for="<?php echo $fe->label; ?>">
					<?php echo ucfirst($fe->label); ?>
					<?php if($fe->validation == 'required'){ ?>
					<span class="required" >*</span>
					<?php } ?>
				</label>
				<?php
				$params = [];
				$params['element'] = $fe;
				?>
				@include('components.forms._form_fields', $params)

				<?php   //echo  make_forms_field($fe->id,$set_value); ?>
				<?php //echo form_error('fe_id'.$fe->id); ?>
			</div>
			<?php
		}
	?>
<?php
$captcha_img = [];

if(!empty($captcha)){
$captcha_img = captcha_img('custom');
?>
 <div class="col-md-12 clearfix">
 	<label>Security Code:*</label>
	<div class="captcha">
		<div class="captchacod">
			<span class="captchImgBox"><?php echo $captcha_img; ?></span>
			<img src="{{url('public')}}/images/refresh.png" class="changeCaptcha white-cpimg" alt="refresh">
		</div>
		<input type="text" name="scode" id="scode" value="{{old('scode')}}" class="form-control scode" placeholder="Input Code">
	@include('snippets.errors_first', ['param' => 'scode'])
	
	</div>
</div>
<?php }
?>


<div class="col-md-12"><input type="submit" name="submit" value="Submit" class="button"></div>
</form>
</div>
</div>
</div>
<?php
}
?>

  </div>
</section>

@slot('footerBlock')

<?php

$hash_id = '';

if(isset($errors) && !empty($errors)){

	if($errors->count() > 0){
		$hash_id = 'forms';
	}
	if(!empty($hash_id)){
		?>
		<script type="text/javascript">
			window.location.hash = "{{$hash_id}}";
		</script>

		<?php
	}
}

if(isset($msg) && !empty($msg)){

	if($msg->count() > 0){
		$hash_id = 'forms';
	}
	if(!empty($hash_id)){
		?>
		<script type="text/javascript">
			window.location.hash = "{{$hash_id}}";
		</script>

		<?php
	}
}
?>
@endslot


@endcomponent
