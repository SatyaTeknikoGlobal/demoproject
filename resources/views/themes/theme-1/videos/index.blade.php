@component('themes.theme-1.layouts.main')

@slot('title')
    Video Gallery | Blind Welfare Society, Expanding possibilities for people with vision loss.
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

<section class="fullwidth innerbanner" style="background: url('{{asset('public/assets/themes/theme-1/images/blog-banner.jpg')}}') center center no-repeat;"></section>
<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>Video Gallery</li>			
		</ul>
	</div>
</div>
<section class="fullwidth innerpage blog_page">	
	<div class="container">
		<h1 class="headings headings-with-border text-center">Video Gallery</h1>
		<div class="bloglist">
			@include('components.videos.listing')
		</div>

	</div>
</section> 

@slot('footerBlock')
 

@endslot

@endcomponent