@component('themes.theme-1.layouts.main')

@slot('title')
    Photo Gallery
@endslot

@slot('headerBlock')



@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
@endslot
<section class="fullwidth innerbanner" style="background: url('{{asset('public/assets/themes/theme-1/images/blog-banner.jpg')}}') center center no-repeat;"></section>
<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>Photo Gallery</li>			
		</ul>
	</div>
</div>
<section class="fullwidth innerpage blog_page">	
	<div class="container">
		<h1 class="headings headings-with-border text-center">Photo Gallery</h1>
		<div class="bloglist">
			@include('components.gallery.listing')
		</div>
	</div>
</section> 

@slot('footerBlock')
 

@endslot

@endcomponent