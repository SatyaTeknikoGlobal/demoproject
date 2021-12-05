<?php 
//prd($testimonials);
?>

<?php
$defaultImg = asset('public/assets/themes/theme-1/images/default-img.png');
$path = 'testimonials/';
$thumb_path = 'testimonials/thumb/';
$storage = Storage::disk('public');

if(!empty($testimonials) && count($testimonials) > 0)
{
?>	
<ul class="list2">
<?php
foreach ($testimonials as $testimonial){
	$testimonialImg = $defaultImg;

	$image = $testimonial->image;
	$location = $testimonial->location;
	$date_on = CustomHelper::DateFormat($testimonial->date_on, 'M d, Y');

	if(!empty($image)){
		if($storage->exists($thumb_path.$image)){
			$testimonialImg = asset('public/storage/'.$thumb_path.$image);
		}
		elseif($storage->exists($path.$image)){
			$testimonialImg = asset('public/storage/'.$path.$image);
		}
	}
?>
<li>

	<div class="testibox text-center">
		<div class="imgsec"><img src="<?php echo $testimonialImg; ?>" alt="img">
		</div>

	<div class="title"><a href="#">{{$testimonial->name}}</a></div>
	
	<?php 
	if(!empty($location)){
		?>
		<p>Location: {{$location}}</p>
		<?php  }
		?>
	<!-- <div class="date"><a href="#">{{$date_on}}</a></div> -->
	<div class="content">
		<p><?php echo $testimonial->description; ?></p>
	</div>
</div>
</li>
<?php 
}
?>

</ul>
<?php
}
?>
