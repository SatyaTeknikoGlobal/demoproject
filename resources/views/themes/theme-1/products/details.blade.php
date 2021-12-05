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


<section class="fullwidth innerheading">
	<div class="container">
		 <h1 class="heading">Products</h1>
		<p><a href="{{url('/')}}">Home</a> Product</p>
	</div>	
</section>
<section class="fullwidth innerpage">	
	<div class="container">

		<div class="blogpage">			
			<div class="bdetail">        
				
				@include('components.products.details')

			</div>
		</div>
		 
	</div>
</section>

@slot('footerBlock')

<script type="text/javascript" src="{{url('public')}}/js/owl.carousel.min.js"></script> 

@endslot

@endcomponent