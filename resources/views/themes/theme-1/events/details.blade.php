@component('themes.theme-1.layouts.main')

@slot('title')
    Laravel CMS - Frontend
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{url('public')}}/css/owl.carousel.min.css" />

@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
@endslot

<!-- <div class="fullwidth innerbanner">
	<img src="{{asset('public/assets/themes/theme-1/images/blog-banner.jpg')}}" alt="banner" />
</div> -->
 
<section class="fullwidth innerpage">	
	<div class="container">
		<div class="innerheading">
			 <h1 class="heading">Events</h1>
			<div class="breadcrumb"><a href="{{url('/')}}">Home</a> Events</div>
		</div>

		<div class="eventpage">	
		<div class="sidebar"> 
			 @include('components.includes._events')
		</div>		
		<div class="bdetail">
			@include('components.events.details')
		</div>
		</div>
		 
	</div>
</section>

@slot('footerBlock')

<script type="text/javascript" src="{{url('public')}}/js/owl.carousel.min.js"></script> 

@endslot

@endcomponent