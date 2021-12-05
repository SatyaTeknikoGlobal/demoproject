@component('themes.theme-1.layouts.main')

@slot('title')
    Blog
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

<div class="fullwidth innerbanner" style="background: url({{$b_image}}) no-repeat;"></div>
 <div class="breadcrumbs">
  <div class="container">
    <ul class="clearfix">
      <li><a href="{{url('/')}}">Home</a></li>  
      <li>Blogs</li>      
    </ul>
  </div>
</div>
<section class="fullwidth innerpage blog_page">	
	<div class="container">
		<h1 class="headings headings-with-border text-center">Blogs</h1>
		<div class="bloglist">
		@include('components.blogs.listing')
	</div>

	</div>
</section> 

@slot('footerBlock')
 

@endslot

@endcomponent