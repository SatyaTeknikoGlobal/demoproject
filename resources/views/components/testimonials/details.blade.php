<?php
//pr($blog->toArray());

$keyword = (request()->has('keyword'))?request()->keyword:'';

$storage = Storage::disk('public');

$blog_date = CustomHelper::DateFormat($blog->created_at, 'M d, Y');

$blog_title = $blog->title;
$blog_content = $blog->content;

$blog_images = (isset($blog->Images))?$blog->Images:'';
?>

<div class="dtbg">
	<?php
	if(!empty($blog_images) && count($blog_images)){
		foreach($blog_images as $bimg){
			if(!empty($bimg->image) && $storage->exists('blogs/'.$bimg->image)){
				?>
				<img src="{{url('public/storage/blogs/'.$bimg->image)}}" alt="{{$blog_title}}">
				<?php
				break;
			}
		}
	}
	?>
</div>
<div class="btext">
	<p><cite>{{$blog_date}}</cite></p>
	<h4>{{$blog_title}}</h4>

	<?php
	echo $blog_content;
	?>

</div>

