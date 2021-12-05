<?php
$params = [];

$orderBy = ['id'=>'asc', 'title'=>'desc'];
$params['orderBy'] = $orderBy;
$params['featured'] = true;

$events = CustomHelper::getEvents($id='', $limit='', $params);
//prd($events->toArray());
?>

<?php 
$storage = Storage::disk('public');

if(!empty($events) && count($events) > 0)
{
?>

<?php 

foreach ($events as $event) { 

	$start_date = CustomHelper::DateFormat($event->start_date, 'M d, Y');
	$end_date = CustomHelper::DateFormat($event->end_date, 'M d, Y');
?>

<div class="eventbox">

	<?php
	$image = asset('public/assets/themes/theme-1/images/default-img.png');
	if(!empty($event->image) && $storage->exists('events/thumb/'.$event->image)){
		$image = url('public/storage/events/thumb/'.$event->image);
	}
	?> 
	<div class="imgsec" style="background:#ccc url(<?php echo $image; ?>) center center no-repeat;">
		<img src="public/assets/themes/theme-1/images/blankimg.png" alt="img" />
	</div>



	<div class="contents">
		<div class="title"><a href="<?php echo url('events/'.$event->slug) ?>">{{$event->title}}</a></div>
		<!-- <div class="category"><a href="#">Category Name</a></div> -->
		<?php 
		if(!empty($start_date)){  ?>
		<div class="date">Start Date: {{$start_date}}</div>
	    <?php }

	    if($end_date){ ?>
		<div class="date">End Date: {{$end_date}}</div>
	    <?php }?> 

		<div class="content"><?php echo $event->description; ?></div>
	</div>
</div>

<?php 
}
?>

<?php 
}
?>

<!-- <div class="eventbox">
<div class="imgsec" >
	<img src="http://laravelcms.ii71.com/public/assets/themes/theme-1/images/default-img.png" alt="img" border="0" /> 
</div>
<div class="contents">
	<div class="title"><a href="#">Event Title</a></div>
		<div class="date">Date: 25 June 2019</div>
	<div class="category"><a href="#">Category Name</a></div>
	<div class="content">
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown took...
	</div>
</div>
</div>

<div class="eventbox">
<div class="imgsec" >
	<img src="http://laravelcms.ii71.com/public/assets/themes/theme-1/images/default-img.png" alt="img" border="0" /> 
</div>
<div class="contents">
	<div class="title"><a href="#">Event Title</a></div>
		<div class="date">Date: 25 June 2019</div>
	<div class="category"><a href="#">Category Name</a></div>
	<div class="content">
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown took...
	</div>
</div>
</div>

<div class="eventbox">
<div class="imgsec" >
	<img src="http://laravelcms.ii71.com/public/assets/themes/theme-1/images/default-img.png" alt="img" border="0" /> 
</div>
<div class="contents">
	<div class="title"><a href="#">Event Title</a></div>
		<div class="date">Date: 25 June 2019</div>
	<div class="category"><a href="#">Category Name</a></div>
	<div class="content">
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown took...
	</div>
</div>
</div> -->