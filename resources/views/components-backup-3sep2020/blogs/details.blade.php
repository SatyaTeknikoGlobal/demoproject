<?php
//pr($blog->toArray());

$keyword = (request()->has('keyword'))?request()->keyword:'';

$storage = Storage::disk('public');

$blog_date = CustomHelper::DateFormat($blog->created_at, 'M d, Y');

$blog_title = $blog->title;
$blog_content = $blog->content;

$blog_images = (isset($blog->Images))?$blog->Images:'';

$category = (isset($blog->Category))?$blog->Category:'';
?>


	<?php
	$image = asset('public/assets/themes/theme-1/images/default-img.png');

	if(!empty($blog_images) && count($blog_images)){
		foreach($blog_images as $bimg){

			if(!empty($bimg->image) && $storage->exists('blogs/'.$bimg->image)){

				$image = url('public/storage/blogs/'.$bimg->image);
				break;
			}
		}
	}
	?>
	
<div class="dtbg">	
	<img src="<?php echo $image; ?>" alt="{{$blog_title}}">
</div>

<div class="btext">
	<h1>{{$blog_title}}</h1>
	<div class="date"><strong>Date : </strong><cite>{{$blog_date}}</cite></div>
	<!-- <p>{{$category->name}}</p> -->
	<?php
	echo $blog_content;
	?>
</div>

