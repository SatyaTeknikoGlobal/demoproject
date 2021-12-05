<?php
$params = [];
$where = [];
$tbl = 'testimonials';
$orderBy = ['id'=>'asc', 'name'=>'desc'];
$params['orderBy'] = $orderBy;
$params['limit'] = 5;
$params['featured'] = true;
$where = ['status'=>'1'];

$testimonialData = CustomHelper::getData($tbl, $id=0, $where, $selectArr=['*'], $params);

if(!empty($testimonialData)){

	$defaultImg = asset('public/assets/themes/theme-1/images/default-img.png');

	$path = 'testimonials/';
	$thumb_path = 'testimonials/thumb/';
	$storage = Storage::disk('public');

	foreach ($testimonialData as $testimonial){

		$image = $testimonial->image;
		$location = $testimonial->location;

		$testimonialImg = $defaultImg;

		if(!empty($image)){
			if($storage->exists($thumb_path.$image)){
				$testimonialImg = asset('public/storage/'.$thumb_path.$image);
			}
			elseif($storage->exists($path.$image)){
				$testimonialImg = asset('public/storage/'.$path.$image);
			}
		}

		//pr($testimonial);

		?>
		<div class="testibox">
			<div class="imgsec" >
				<img src="{{$testimonialImg}}" alt="{{$testimonial->name}}" border="0" /> 
			</div>
			<div class="contents">
				<div class="title"><a href="javascript:void(0)">{{$testimonial->name}}</a></div>
				<?php
				if(!empty($location)){
					?>
					<div class="date">Location: {{$location}} </div> 
					<?php
				}
				?>
				<div class="content">
					<?php echo $testimonial->description; ?>
				</div>
			</div>
		</div>
		<?php
	} 
}
?>


<!-- <div class="testibox">
<div class="imgsec" >
	<img src="http://laravelcms.ii71.com/public/assets/themes/theme-1/images/default-img.png" alt="img" border="0" /> 
</div>
<div class="contents">
	<div class="title"><a href="#">Client Name</a></div>
		<div class="date">Location: Delhi </div> 
	<div class="content">
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown took...
	</div>
</div>
</div> -->