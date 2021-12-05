<?php
$params = [];

$orderBy = ['id'=>'asc', 'title'=>'desc'];
$params['orderBy'] = $orderBy;
$params['featured'] = true;

$blogs = CustomHelper::getBlogs($id='', $type='blogs', $limit='', $params);
//prd($blogs->toArray());

if(!empty($blogs) && count($blogs) > 0){
	foreach ($blogs as $blog){

		$blog_date = CustomHelper::DateFormat($blog->blog_date, 'M d, Y');

		$blog_images = (isset($blog->Images))?$blog->Images:'';

		$category = (isset($blog->Category))?$blog->Category:'';
?>
<div class="blogbox">

	<?php
	$storage = Storage::disk('public');
	
	$backgroundImage = asset('public/assets/themes/theme-1/images/default-img.png');
	if(!empty($blog_images) && count($blog_images)){
		
		foreach($blog_images as $bimg){
			if(!empty($bimg->image) && $storage->exists('blogs/thumb/'.$bimg->image)){

				$backgroundImage = url('public/storage/blogs/thumb/'.$bimg->image);
				break;
			}
		}
	}
		?>

		<div class="imgsec" style="background:#ccc url(<?php echo $backgroundImage; ?>) center center no-repeat;">
			<img src="public/assets/themes/theme-1/images/blankimg.png" alt="{{$blog->title}}" /> 

		</div>
		
	<div class="contents">
		<div class="title"><a href="<?php echo url('blogs/'.$blog->slug);?>">{{$blog->title}}</a></div>
		<div class="category"><a href="#">{{$category->name}}</a></div>
		<?php
		if(!empty($blog_date)){ ?>
		<div class="date">Date: {{$blog_date}}</div>
		<?php } ?>
		<div class="content">
			<?php 
			echo CustomHelper::wordsLimit($blog->content, $limit = 100, $isStripTags=false, $allowTags=''); ?>
		</div>
	</div>
</div>

<?php } 
}?>
