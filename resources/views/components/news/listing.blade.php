<?php
//prd($newsData->toArray());

if(!empty($newsData) && count($newsData) > 0){
?>

<div class="row">
<?php
$storage = Storage::disk('public');

foreach ($newsData as $news){ 

	$news_date = CustomHelper::DateFormat($news->news_date, 'M d, Y');

	$news_images = (isset($news->Images))?$news->Images:'';
	$category = (isset($news->Category))?$news->Category:'';
?>	
<div class="col-md-4">
	
	<div class="newsbox">
		<?php
		$image = asset('public/assets/themes/theme-1/images/default-img.png');
		if(!empty($news_images) && count($news_images)){
			foreach($news_images as $bimg){


				if(!empty($bimg->image) && $storage->exists('blogs/thumb/'.$bimg->image)){

					$image = url('public/storage/blogs/thumb/'.$bimg->image);
					break;
				}
			}
		}?>
	 
		<div class="imgsec" style="background:#ccc url(<?php echo $image; ?>) center center no-repeat;">
				<img src="public/assets/themes/theme-1/images/blankimg.png" alt="{{$news->title}}" /> 
		</div>

		<div class="contents">
			<h3 class="title">{{$news->title}}</h3>
			<!-- <div class="date">{{$news_date}}</div> -->
			<!-- <div class="category"><a href="#">{{$category->name}}</a></div> -->
			<div class="content">
				<?php 
				echo CustomHelper::wordsLimit($news->brief, $limit = 100, $isStripTags=false, $allowTags=''); ?>
			</div>
			<a href="{{url('news/'.$news->slug)}}"><div class="read-more">Read More <i class="arrow-icon"></i></div></a>
		</div>
	</div>
	
</div>
<?php
}
?>

</div>
<?php 
}
?>

