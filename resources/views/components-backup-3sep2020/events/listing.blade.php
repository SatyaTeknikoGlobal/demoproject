
<?php 
$storage = Storage::disk('public');

if(!empty($events) && count($events) > 0)
{
?>
<ul class="list2">

<?php 

foreach ($events as $event) { 

	$start_date = CustomHelper::DateFormat($event->start_date, 'M d, Y');
	$end_date = CustomHelper::DateFormat($event->end_date, 'M d, Y');
?>
<li>
<div class="eventbox">

	<?php
	$image = asset('public/assets/themes/theme-1/images/default-img.png');
	if(!empty($event->image) && $storage->exists('events/thumb/'.$event->image)){
		$image = url('public/storage/events/thumb/'.$event->image);
	}
	?> 
	<div class="imgsec" style="background:#ccc url(<?php echo $image; ?>) center center no-repeat;">
			<img src="public/assets/themes/theme-1/images/blankimg.png" alt="{{$event->title}}" /> 
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
</li>
<?php 
}
?>

</ul>
<?php 
}
?>





<?php
/*
$storage = Storage::disk('public');

$keyword = (request()->has('keyword'))?request()->keyword:'';
$cat = (request()->has('category'))?request()->category:'';


		if(!empty($blogCategories) && count($blogCategories) > 0){
		foreach ($blogCategories as $category){
		
			$blogs = $category->Blogs;
	        //prd($blogs->toArray());

		?>



<?php
//prd($blogs);
?>
		<div class="blog_rows">
		<div class="strip_head">
			{{$category->name}}
		</div>
		<ul class="blog_list">

			<?php 
			foreach ($blogs as $blog){

				//prd($blog->toArray);
				$blog_date = CustomHelper::DateFormat($blog->blog_date, 'M d, Y');

				$blog_images = (isset($blog->Images))?$blog->Images:'';
			?>
			<li>
				<a href="{{url('blogs/'.$blog->slug)}}" class="blog_box">

					<?php
					if(!empty($blog_images) && count($blog_images)){
						foreach($blog_images as $bimg){
							if(!empty($bimg->image) && $storage->exists('blogs/thumb/'.$bimg->image)){

								$backgroundImage = url('public/storage/blogs/thumb/'.$bimg->image);
								?>
								<div class="images" style="background: url('<?php echo $backgroundImage; ?>');">
									<img src="{{url('public')}}/images/blog-blank.png" alt="Slumber Jill" /> 

									<div class="content">
										<span>{{$blog->title}}</span> 
									</div>
									<?php
									break; ?>
								</div>
								<?php }
							}
						}
						?>
					
				</a>
			</li>
			<?php } ?>
		</ul>
		<?php 
		if(empty($cat)){
		?>
		<div class="view_all">
			<a href="{{ url('blogs?category='.$category->slug) }}">View All</a>
		</div>
		<?php } ?>

	</div>
	<?php } 
}
*/?>


