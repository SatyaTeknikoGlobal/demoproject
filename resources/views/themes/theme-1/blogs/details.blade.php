@component('themes.theme-1.layouts.main')

@slot('title')
    Blog | Blind Welfare Society, Expanding possibilities for people with vision loss.
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

<div class="fullwidth innerbanner" style="background: url('{{asset('public/assets/themes/theme-1/images/default-banner.jpg')}}');"></div>
<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>Blogs</li>			
		</ul>
	</div>
</div>
<section class="fullwidth innerpage">	
	<div class="container">
		<div class="blogpage">
			<!-- <div class="sidebar"> 
				@include('components.blogs._recent_blogs')
			</div> -->
					
			<div class="bdetail"> 
				@include('components.blogs.details')
			</div>
		</div>
	</div>
</section>
@slot('footerBlock')
<script type="text/javascript" src="{{url('public')}}/js/owl.carousel.min.js"></script> 
@endslot

@endcomponent