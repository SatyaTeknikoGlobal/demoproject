@component('themes.theme-1.layouts.main')

@slot('title')
    News & Events | Blind Welfare Society, Expanding possibilities for people with vision loss.
@endslot
@slot('meta_description')
    Blind Welfare Society, Expanding possibilities for people with vision loss.
@endslot
@slot('headerBlock')



@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
@endslot


<?php
$storage = Storage::disk('public');
$path = 'banners/';

//prd($banners);
//$b_image = asset('public/assets/themes/theme-1/images/blog-banner.jpg'); 
?>


<?php 
foreach($banners as $banner){
	$images = (isset($banner->Images))?$banner->Images:'';
     //prd($images);
	if(!empty($images) && count($images) > 0){
		foreach($images as $image){
			if(!empty($image->name) && $storage->exists($path.$image->name)){
				?>
				<div class="fullwidth innerbanner" style="background: url('{{url('public/storage/banners/'.$image->name)}}');"></div>
				<?php 
			} 
		}
	}
}
?>
<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>News & Events</li>			
		</ul>
	</div>
</div>
<div class="blog_wrap">
	<section class="fullwidth innerpage blog_page">	
		<div class="container">
			<h1 class="headings headings-with-border text-center">News & Events</h1>
			@include('components.news.listing')
		</div>
	</section>
</div>


@slot('footerBlock')

<script type="text/javascript" src="{{url('public')}}/js/owl.carousel.min.js"></script> 

@endslot

@endcomponent