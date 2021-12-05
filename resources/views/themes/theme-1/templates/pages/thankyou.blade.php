@component('themes.theme-1.layouts.main')

@slot('title')
    {{$meta_title or ''}}
@endslot

@slot('meta_description')
    {{$meta_description or ''}}
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />

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

$banner_image = asset('public/assets/themes/theme-1/images/default-img.png');
if(!empty($cms['banner_image']) && $storage->exists('cms_pages/'.$cms['banner_image'])){
	$banner_image = url('public/storage/cms_pages/'.$cms['banner_image']);
}

/*
?>
<section class="fullwidth innerbanner" style="background: url('<?php echo $banner_image;?>') center center no-repeat;">
<!-- <img src="" alt="Industries &amp; Applications"> -->
</section> */?>
<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>Thank You</li>			
		</ul>
	</div>
</div>
<section class="fullwidth innerpage cmlayout">
<div class="container">
	<div class="servcont text-center">
      <h1 class="headings headings-with-border"><?php echo $cms['title']; ?></h1>
    </div>
    <div class="cms-content-wrapper">
		<div class="cmscontent">
	     <?php echo $cms['content']; ?>

		</div>
    </div>
  </div>
</section>

@slot('footerBlock')

@endslot


@endcomponent