@component('themes.theme-1.layouts.main')

@slot('title')
    News & Events | Blind Welfare Society, Expanding possibilities for people with vision loss.
@endslot
@slot('meta_description')
    Blind Welfare Society, Expanding possibilities for people with vision loss.
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{url('public')}}/css/owl.carousel.min.css" />

@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
@endslot
<?php
$storage = Storage::disk('public');
$image = '';
if(!empty($cms['image']) && $storage->exists('cms_pages/thumb/'.$cms['image'])){
	$image = url('public/storage/cms_pages/thumb/'.$cms['image']);
}

$banner_image = asset('public/assets/themes/theme-1/images/default-banner.jpg');
if(!empty($cms['banner_image']) && $storage->exists('cms_pages/'.$cms['banner_image'])){
	$banner_image = url('public/storage/cms_pages/'.$cms['banner_image']);
}
?>
<section class="fullwidth innerbanner" style="background: url('<?php echo $banner_image;?>') center center no-repeat;">
</section>
<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>News & Events</li>			
		</ul>
	</div>
</div>
<section class="fullwidth innerpage">	
	<div class="container">
		<div class="newspage">	
			<!-- <div class="sidebar"> 
				 @include('components.news._recent_news')
			</div> -->			
			<div class="bdetail">
				@include('components.news.details')
			</div>
		</div>
		 
	</div>
</section>

@slot('footerBlock')

<script type="text/javascript" src="{{url('public')}}/js/owl.carousel.min.js"></script> 

@endslot

@endcomponent