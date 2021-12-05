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

<div class="fullwidth innerbanner">
	<img src="{{asset('public/assets/themes/theme-1/images/blog-banner.jpg')}}" alt="banner" />
</div>
 
<section class="fullwidth innerpage blog_page">	
	<div class="container">
		<h1 class="headings">Products</h1>
		<div class="bloglist">
		@include('components.products.listing')
	</div>

	</div>
</section> 

@slot('footerBlock')
 

@endslot

@endcomponent