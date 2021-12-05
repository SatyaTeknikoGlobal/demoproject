<style type="text/css">
	.sub_active a{ color:#e41881 !important; }
</style>
<div class="leftsec">
	<div class="menuicon"><span></span> <small>Menu</small></div>
	<div class="fullwidth leftsec1">

		<ul class="main-nav clearfix adminleft">

			<?php
			//echo Route::currentRouteName();

			$type = (isset(request()->type))?request()->type:'';
			?>

			<li {!! strpos(Route::currentRouteName(), 'admin.home') === 0 ? ' class="active"' : '' !!}>
				<a href="{{url('admin')}}"><i class="dashboard-icon"></i> <span>Dashboard</span></a>
			</li>

			<?php
			//pr(Route::currentRouteName());
			//pr(strpos(Route::currentRouteName(), 'admin.products.add'));
			$product_active = (
				strpos(Route::currentRouteName(), 'admin.products') === 0 ||
				strpos(Route::currentRouteName(), 'admin.products.add') === 0 ||
				strpos(Route::currentRouteName(), 'admin.products.edit') === 0
			)? 'class="active"':'';
			?>

			<li <?php echo $product_active; ?> >

				<a class="dropul subtab"> <span> Manage Products</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! !empty($product_active) ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.products.index') }}" > <span>Products List</span></a>
					</li>					

				</ul>

			</li>

			<?php
			$category_active = (
				strpos(Route::currentRouteName(), 'admin.categories') === 0 ||
				strpos(Route::currentRouteName(), 'admin.categories.add') === 0 ||
				strpos(Route::currentRouteName(), 'admin.categories.edit') === 0
			)? 'class="active"':'';
			?>

			<li <?php echo $category_active; ?> >

				<a class="dropul subtab"> <span> Manage Categories</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.categories.index') === 0 ? ' class="sub_active"' : '' !!} >
						<a href="{{ route('admin.categories.index') }}" > <span>Categories List</span></a>
					</li>

					<li {!! strpos(Route::currentRouteName(), 'admin.categories.add') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.categories.add') }}" > <span>Add Category</span></a>
					</li>

				</ul>

			</li>


			<li {!! strpos(Route::currentRouteName(), 'admin.banners') === 0 ? ' class="active"' : '' !!}>
				<a class="dropul subtab"> <span> Banners</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.banners.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.banners.index') }}" > <span>Banners List</span></a>
					</li>

					<li {!! strpos(Route::currentRouteName(), 'admin.banners.add') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.banners.add') }}" > <span>Add Banner</span></a>
					</li>

				</ul>
			</li>

			<li {!! strpos(Route::currentRouteName(), 'admin.home_images') === 0 ? ' class="active"' : '' !!}>
				<a class="dropul subtab"> <span> Home Images</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.home_images.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.home_images.index') }}" > <span>Home Image List</span></a>
					</li>

					<li {!! strpos(Route::currentRouteName(), 'admin.home_images.add') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.home_images.add') }}" > <span>Add Home Image</span></a>
					</li>

				</ul>
			</li>

			<?php
			$customer_active = (
				strpos(Route::currentRouteName(), 'admin.customers') === 0 ||
				strpos(Route::currentRouteName(), 'admin.categories.index') === 0 ||
				strpos(Route::currentRouteName(), 'admin.categories.add') === 0 ||
				strpos(Route::currentRouteName(), 'admin.reviews') === 0
			)? 'class="active"':'';
			?>

			<?php /*

			<li <?php echo $customer_active; ?> >
				<a class="dropul subtab"> <span> Customers</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.customers.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.customers.index') }}" > <span>Customers List</span></a>
					</li>

					<li {!! strpos(Route::currentRouteName(), 'admin.customers.add') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.customers.add') }}" > <span>Add Customer</span></a>
					</li>

					<li {!! strpos(Route::currentRouteName(), 'admin.reviews') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.reviews.index') }}" > <span>Customer Reviews</span></a>
					</li>

				</ul>
			</li>
	
			

			<li {!! strpos(Route::currentRouteName(), 'admin.orders') === 0 ? ' class="active"' : '' !!}>
				<a class="dropul subtab"> <span> Orders</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.customers.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.orders.index') }}" > <span>Orders List</span></a>
					</li>

					

				</ul>
			</li>

			

			<?php
			$shipping_active = (strpos(Route::currentRouteName(), 'admin.shippingzones') === 0 || strpos(Route::currentRouteName(), 'admin.shippingrates') === 0 )? 'class="active"':'';
			?>

			<li <?php echo $shipping_active;?> >
				<a  class="dropul subtab"> <span> Shipping</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.shippingzones.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.shippingzones.index') }}" > <span>Shipping Zone</span></a>
					</li>


					<li {!! strpos(Route::currentRouteName(), 'admin.shippingrates.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.shippingrates.index') }}" > <span>Shipping Rate</span></a>
					</li>

				</ul>
			</li>
			*/ ?>

			<?php
			$blog_active = (strpos(Route::currentRouteName(), 'admin.blogs_categories') === 0 || strpos(Route::currentRouteName(), 'admin.blogs') === 0 ||
				 (!empty($blog_active) && $type == 'blogs') )? 'class="active"':'';
			?>

		
			<li <?php echo $blog_active; ?> >
				<a  class="dropul subtab"> <span> Blogs</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.blog_categories.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.blogs_categories.index', ['type'=>'blogs']) }}" > <span>Blog Category List</span></a>
					</li>


					<li {!! strpos(Route::currentRouteName(), 'admin.blogs.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.blogs.index', ['type'=>'blogs']) }}" > <span>Blog List</span></a>
					</li>

				</ul>
			</li>
			

			<?php
			$news_active = (strpos(Route::currentRouteName(), 'admin.blogs_categories') === 0 || strpos(Route::currentRouteName(), 'admin.blogs') === 0 ||
				 (!empty($news_active) && $type == 'news') )? 'class="active"':'';
			?>

			<li <?php echo $news_active; ?> >
				<a  class="dropul subtab"> <span> News </span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.blog_categories.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.blogs_categories.index',['type'=>'news']) }}" > <span>News Category List</span></a>
					</li>


					<li {!! strpos(Route::currentRouteName(), 'admin.blogs.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.blogs.index', ['type'=>'news']) }}" > <span>News List</span></a>
					</li>

				</ul>
			</li>




			<?php
			$event_active = (strpos(Route::currentRouteName(), 'admin.events') === 0 )? 'class="active"':'';
			?>

			<li <?php echo $event_active; ?> >
				
					<li {!! strpos(Route::currentRouteName(), 'admin.events.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.events.index') }}" > <span>Events</span></a>
					</li>

			</li>

			<?php
			$video_active = (strpos(Route::currentRouteName(), 'admin.videos.add') === 0 )? 'class="active"':'';
			?>

			<li <?php echo $video_active; ?> >
				
					<li {!! strpos(Route::currentRouteName(), 'admin.videos.index') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.videos.add',['vid'=>'0','tbl'=>'gallery']) }}" > <span>Video Gallery</span></a>
					</li>

			</li>

			<li {!! strpos(Route::currentRouteName(), 'admin.testimonials') === 0 ? ' class="active"' : '' !!}>
				<a href="{{ route('admin.testimonials.index') }}" > <span> Testimonials</span></a>
			</li>
		

             <!-- Country,state, city-->

             <?php
			$country_active = (strpos(Route::currentRouteName(), 'admin.countries') === 0 || strpos(Route::currentRouteName(), 'admin.states') === 0  ||  strpos(Route::currentRouteName(), 'admin.cities') === 0 )? 'class="active"':'';
			?>

			<li <?php echo $country_active; ?> >
				<a  class="dropul subtab"> <span>Country, State, City</span></a><i aria-hidden="true" class="fa fa-angle-down dropul"></i>
				<ul>

					<li {!! strpos(Route::currentRouteName(), 'admin.countries') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.countries.index') }}" > <span>Manage Countries</span></a>
					</li>


					<li {!! strpos(Route::currentRouteName(), 'admin.states') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.states.index') }}" > <span>Manage States</span></a>
					</li>

					<li {!! strpos(Route::currentRouteName(), 'admin.cities') === 0 ? ' class="sub_active"' : '' !!}>
						<a href="{{ route('admin.cities.index') }}" > <span>Manage Cities</span></a>
					</li>

				</ul>
			</li>



			<?php /*
			<!-- For Coupon-->
			<li {!! strpos(Route::currentRouteName(), 'admin.coupons') === 0 ? ' class="active"' : '' !!}>
				<a href="{{ route('admin.coupons.index') }}" > <span> Coupons</span></a>
			</li>
			*/ ?>
			<!-- For Newletter Subscriber-->

			<li {!! strpos(Route::currentRouteName(), 'admin.newsletter') === 0 ? ' class="active"' : '' !!}>
				<a href="{{url('admin/newsletter')}}" > <span> Newsletter Subscriber</span></a>
			</li>




			<li {!! strpos(Route::currentRouteName(), 'admin.cms') === 0 ? ' class="active"' : '' !!}>
				<a href="{{ route('admin.cms.index') }}" > <span> CMS Pages</span></a>
			</li>			

		</ul>
</div>

</div>