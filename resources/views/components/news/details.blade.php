<?php
//pr($news->toArray());

$keyword = (request()->has('keyword'))?request()->keyword:'';

$storage = Storage::disk('public');

$news_date = CustomHelper::DateFormat($news->blog_date, 'M d, Y');

$news_title = $news->title;
$news_content = $news->content;

$news_images = (isset($news->Images))?$news->Images:'';
$category = (isset($news->Category))?$news->Category:'';
?>

<?php
$image = asset('public/assets/themes/theme-1/images/default-img.png');

if(!empty($news_images) && count($news_images)){
	foreach($news_images as $bimg){
		if(!empty($bimg->image) && $storage->exists('blogs/'.$bimg->image)){
			
			$image = url('public/storage/blogs/'.$bimg->image);
			break;
		}
	}
}
?>

<?php /* <div class="pageimg">
	<img src="<?php echo $image; ?>" alt="{{$news_title}}">
</div> */?>

<div class="cmscontent">
	<h1>{{$news_title}}</h1>
	<!-- <p><strong>Date:</strong> <cite>{{$news_date}}</cite></p> -->
	<!-- <div class="category"><a href="#">{{$category->name}}</a></div> -->
	
	<?php echo $news_content; ?>

</div>

