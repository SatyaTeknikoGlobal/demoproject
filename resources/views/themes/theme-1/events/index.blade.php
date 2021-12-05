@component('themes.theme-1.layouts.main')

@slot('title')
    Laravel CMS - Frontend
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
$b_image = asset('public/assets/themes/theme-1/images/blog-banner.jpg');
foreach($banners as $banner){
	$images = (isset($banner->Images))?$banner->Images:'';
        //prd($images);
	if(!empty($images) && count($images) > 0){
		foreach($images as $image){
			if(!empty($image->name) && $storage->exists($path.$image->name)){
				
				$b_image = url('public/storage/banners/'.$image->name);
			} 
		}
	}
}
?>

<div class="fullwidth innerbanner">
	<img src="{{$b_image}}" alt="banner" />
</div>
 
<section class="fullwidth innerpage blog_page">	
	<div class="container">
		<h1 class="headings">Events</h1>
		<div class="eventslist gridsec">
		@include('components.events.listing')
	</div>

	</div>
</section>
 


@slot('footerBlock')

<script type="text/javascript" src="{{url('public')}}/js/owl.carousel.min.js"></script> 

@endslot

@endcomponent