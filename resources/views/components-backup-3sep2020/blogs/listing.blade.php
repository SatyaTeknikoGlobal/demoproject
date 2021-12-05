<?php
$storage = Storage::disk('public');

$keyword = (request()->has('keyword'))?request()->keyword:'';
$cat = (request()->has('category'))?request()->category:'';

//prd($blogs);
?>
		<ul class="list3">

			<?php 
			foreach ($blogs as $blog){
				//prd($blog->toArray);
				$blogMonth = CustomHelper::DateFormat($blog->blog_date, 'M');
				$blogDate = CustomHelper::DateFormat($blog->blog_date, 'd');

				$blog_images = (isset($blog->Images))?$blog->Images:'';
				$category = (isset($blog->Category))?$blog->Category:'';
			?>
			<li>
				<a href="{{url('blogs/'.$blog->slug)}}">
					<?php
					$image = asset('public/assets/themes/theme-1/images/default-img.png');

					if(!empty($blog_images) && count($blog_images)){
						foreach($blog_images as $bimg){

							if(!empty($bimg->image) && $storage->exists('blogs/thumb/'.$bimg->image)){
								$image = asset('public/storage/blogs/thumb/'.$bimg->image);
								break;
							}
						}
					}
					?>
					<div class="newsbox">
					<div class="imgsec" style="background:#ccc url(<?php echo $image; ?>) center center no-repeat;">
						<img src="public/assets/themes/theme-1/images/blankimg.png" alt="{{$blog->title}}" />
					</div>
						<div class="contents">
							<div class="title">{{$blog->title}}</div>
							<!-- <div class="category">{{$category->name}}</div> -->
							<?php
							if(!empty($blogMonth)){ ?>
							<div class="date">
							<span>
							<?php echo $blogDate; ?>
						    </span>
						    <?php echo $blogMonth; ?>
							</div>
							<?php } ?> 

							<div class="content">
								<?php 
								echo CustomHelper::wordsLimit($blog->content, $limit = 100, $isStripTags=false, $allowTags=''); ?>
							</div> 
							<div class="read-more">Read More <i class="arrow-icon"></i></div> 
						</div>
					</div>
				</a>
			</li>
			<?php } ?>
		</ul> 