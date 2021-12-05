<style type="text/css">

	.sub_active a{ color:#fff !important; }

</style>

<div class="leftsec">

	<div class="menuicon"><span></span> <small>Menu</small></div>

	<div class="fullwidth leftsec1">



		<ul class="main-nav clearfix adminleft">



			<?php

			//echo Route::currentRouteName();



			$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();



			$type = (isset(request()->type))?request()->type:'';

			?>



			<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.home') === 0 ? ' class="active"' : '' !!}>

				<a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>

			</li>

			

			@if(CustomHelper::isAllowedModule('categories'))

			<?php

			$category_active = (

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.categories') === 0 ||

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.categories.add') === 0 ||

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.categories.edit') === 0

			)? 'class="active"':'';

			?>



			<li <?php echo $category_active; ?> >



				<a class="dropul subtab"><i class="fa fa-pie-chart"></i> <span> Manage Categories</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.categories.index') === 0 ? ' class="sub_active"' : '' !!} >

						<a href="{{ route($ADMIN_ROUTE_NAME.'.categories.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Categories List</span></a>

					</li>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.categories.add') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.categories.add') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Add Category</span></a>

					</li>



				</ul>



			</li>

			@endif



			<?php

			//pr(Route::currentRouteName());

			//pr(strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.products.add'));

			$product_active = (

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.products') === 0 ||

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.products.add') === 0 ||

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.products.edit') === 0

			)? 'class="active"':'';

			?>



			@if(CustomHelper::isAllowedModule('products'))



			<li <?php echo $product_active; ?> >



				<a class="dropul subtab"><i class="fa fa-pie-chart"></i> <span> Manage Products</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					<li {!! !empty($product_active) ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.products.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Products List</span></a>

					</li>					



				</ul>



			</li>



			@endif



			@if(CustomHelper::isAllowedModule('banners'))



			<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.banners') === 0 ? ' class="active"' : '' !!}>

				<a class="dropul subtab"><i class="fa fa-pie-chart"></i> <span> Banners</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.banners.index') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.banners.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Banners List</span></a>

					</li>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.banners.add') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.banners.add') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Add Banner</span></a>

					</li>



				</ul>

			</li>

			@endif





			@if(CustomHelper::isAllowedModule('home_images'))



			<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.home_images') === 0 ? ' class="active"' : '' !!}>

				<a class="dropul subtab"><i class="fa fa-pie-chart"></i> <span>Manage Images</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.home_images.index') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.home_images.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span> Image List</span></a>

					</li>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.home_images.add') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.home_images.add') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Add  Image</span></a>

					</li>



				</ul>

			</li>

			@endif







			<?php

			$customer_active = (

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.customers') === 0 ||

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.categories.index') === 0 ||

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.categories.add') === 0 ||

				strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.reviews') === 0

			)? 'class="active"':'';

			?>



			<?php /*



			<li <?php echo $customer_active; ?> >

				<a class="dropul subtab"> <span> Customers</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.customers.index') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.customers.index') }}" > <span>Customers List</span></a>

					</li>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.customers.add') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.customers.add') }}" > <span>Add Customer</span></a>

					</li>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.reviews') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.reviews.index') }}" > <span>Customer Reviews</span></a>

					</li>



				</ul>

			</li>

	

			



			<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.orders') === 0 ? ' class="active"' : '' !!}>

				<a class="dropul subtab"> <span> Orders</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.customers.index') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.orders.index') }}" > <span>Orders List</span></a>

					</li>



					



				</ul>

			</li>



			



			<?php

			$shipping_active = (strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.shippingzones') === 0 || strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.shippingrates') === 0 )? 'class="active"':'';

			?>



			<li <?php echo $shipping_active;?> >

				<a  class="dropul subtab"> <span> Shipping</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.shippingzones.index') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.shippingzones.index') }}" > <span>Shipping Zone</span></a>

					</li>





					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.shippingrates.index') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.shippingrates.index') }}" > <span>Shipping Rate</span></a>

					</li>



				</ul>

			</li>

			*/ ?>



			@if(CustomHelper::isAllowedModule('blogs'))



			<?php

			$blog_active = ( $type == 'blogs' && (strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.blogs_categories') === 0 || strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.blogs') === 0 ))? 'class="active"':'';

			?>

			

			<li <?php echo $blog_active; ?> >

				<a  class="dropul subtab"><i class="fa fa-pie-chart"></i> <span> Blogs</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					



					<li {!! ($type == 'blogs' && strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.blogs_categories.index') === 0) ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.blogs_categories.index', ['type'=>'blogs']) }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Category List</span></a>

					</li>

					



					



					<li {!! ($type == 'blogs' && strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.blogs.index') === 0) ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.blogs.index', ['type'=>'blogs']) }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Blog List</span></a>

					</li>

					



				</ul>

			</li>

			@endif

			

			

			@if(CustomHelper::isAllowedModule('news'))

			

			<?php

			$news_active = ( $type == 'news' && (strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.blogs_categories') === 0 || strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.blogs') === 0 ))? 'class="active"':'';

			?>



			<li <?php echo $news_active; ?> >

				<a  class="dropul subtab"><i class="fa fa-pie-chart"></i> <span> News </span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>



					



					<li {!! ($type == 'news' && strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.blogs_categories.index') === 0) ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.blogs_categories.index',['type'=>'news']) }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Category List</span></a>

					</li>

					



					

					<li {!! ($type == 'news' && strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.blogs.index') === 0) ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.blogs.index', ['type'=>'news']) }}" ><i class="fa fa-circle-o text-aqua"></i> <span>News List</span></a>

					</li>

					



				</ul>

			</li>

			@endif

			



			@if(CustomHelper::isAllowedModule('events'))



			<?php

			$event_active = (strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.events') === 0 )? 'class="active sub_active"':'';

			?>



			<li <?php echo $event_active; ?>>

				<a href="{{ route($ADMIN_ROUTE_NAME.'.events.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Events</span></a>

			</li>

			@endif



			@if(CustomHelper::isAllowedModule('forms'))



			<?php

			$event_active = (strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.forms') === 0 )? 'class="active sub_active"':'';

			?>


			<?php /*
			<li <?php echo $event_active; ?>>

				<a href="{{ route($ADMIN_ROUTE_NAME.'.forms.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Manage Forms</span></a>

			</li> */ ?>

			@endif





			@if(CustomHelper::isAllowedModule('videos'))

			<?php

			$video_active = (strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.videos.add') === 0 )? 'class="active sub_active"':'';

			?>

			<li <?php echo $video_active; ?> >

				<a href="{{ route($ADMIN_ROUTE_NAME.'.videos.add',['vid'=>'0','tbl'=>'gallery']) }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Video Gallery</span></a>

			</li>

			@endif



			

			@if(CustomHelper::isAllowedModule('images'))

			<?php

			$image_active = (strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.images.upload') === 0 )? 'class="active sub_active"':'';

			?>

			<li <?php echo $image_active; ?> >

				<a href="{{ route($ADMIN_ROUTE_NAME.'.images.upload',['tid'=>'0','tbl'=>'gallery']) }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Image Gallery</span></a>

			</li>

			@endif





			@if(CustomHelper::isAllowedModule('testimonials'))



			<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.testimonials') === 0 ? ' class="active sub_active"' : '' !!}>

				<a href="{{ route($ADMIN_ROUTE_NAME.'.testimonials.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span> Testimonials</span></a>

			</li>

			@endif



             <!-- Country,state, city-->



             

             <?php

			$country_active = (strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.countries') === 0 || strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.states') === 0  ||  strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.cities') === 0 )? 'class="active"':'';

			?>



			<!-- <li <?php echo $country_active; ?> >

				<a  class="dropul subtab"><i class="fa fa-pie-chart"></i> <span>Country, State, City</span></a><i aria-hidden="true" class="fa fa-angle-left dropul"></i>

				<ul>

					@if(CustomHelper::isAllowedModule('countries'))



					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.countries') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.countries.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Manage Countries</span></a>

					</li>

					@endif



					@if(CustomHelper::isAllowedModule('states'))

					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.states') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.states.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Manage States</span></a>

					</li>

					@endif



					@if(CustomHelper::isAllowedModule('cities'))

					<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.cities') === 0 ? ' class="sub_active"' : '' !!}>

						<a href="{{ route($ADMIN_ROUTE_NAME.'.cities.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span>Manage Cities</span></a>

					</li>

					@endif



				</ul>

			</li> -->

			







			<?php /*

			<!-- For Coupon-->

			<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.coupons') === 0 ? ' class="active"' : '' !!}>

				<a href="{{ route($ADMIN_ROUTE_NAME.'.coupons.index') }}" > <span> Coupons</span></a>

			</li>

			*/ ?>

			<!-- For Newletter Subscriber-->



			@if(CustomHelper::isAllowedModule('newsletter'))

			<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.newsletter') === 0 ? ' class="active sub_active"' : '' !!}>

				<a href="{{url('admin/newsletter')}}" ><i class="fa fa-circle-o text-aqua"></i> <span> Newsletter</span></a>

			</li>

			@endif





			@if(CustomHelper::isAllowedModule('cms'))

			<li {!! strpos(Route::currentRouteName(), $ADMIN_ROUTE_NAME.'.cms') === 0 ? ' class="active sub_active"' : '' !!}>

				<a href="{{ route($ADMIN_ROUTE_NAME.'.cms.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span> CMS Pages</span></a>

			</li>

			@endif	



			@if(CustomHelper::isAllowedModule('enquiries'))

			<li {!! strpos(Route::currentRouteName(), 'admin.enquiries') === 0 ? ' class="active sub_active"' : '' !!}>

				<a href="{{ route('admin.enquiries.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span> Manage Enquiry</span></a>

			</li>	

			@endif



			@if(CustomHelper::isAllowedModule('menus'))

			<li {!! strpos(Route::currentRouteName(), 'admin.menus') === 0 ? ' class="active sub_active"' : '' !!}>

				<a href="{{ route('admin.menus.index') }}" ><i class="fa fa-circle-o text-aqua"></i> <span> Manage Menus</span></a>

			</li>	

			@endif



		</ul>

</div>



</div>