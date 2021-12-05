<?php
//pr($blog->toArray());

$keyword = (request()->has('keyword'))?request()->keyword:'';

$storage = Storage::disk('public');

$start_date = CustomHelper::DateFormat($event->start_date, 'M d, Y');
$end_date = CustomHelper::DateFormat($event->end_date, 'M d, Y');

$title = $event->title;
$description = $event->description;

$image = asset('public/assets/themes/theme-1/images/default-img.png');
if(!empty($event->image) && $storage->exists('events/thumb/'.$event->image)){
	$image = url('public/storage/events/thumb/'.$event->image);
}

?>

<h2>{{$title}}</h2>
<div class="dtbg">
<img src="<?php echo $image;?>" alt="{{$title}}">
	
</div>
<div class="content">
	<p><cite><strong>Start:</strong> {{$start_date}}</cite>, <cite><strong>End:</strong> {{$end_date}}</cite></p>
	 
	<?php
	echo $description;
	?>

</div>

