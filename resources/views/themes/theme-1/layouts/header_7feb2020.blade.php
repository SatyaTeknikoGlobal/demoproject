<?php

$path = 'settings/';
$storage = Storage::disk('public');

/* default logo */
$logoUrl = asset('public/images/logo.png');

if(!empty($FRONTEND_LOGO) && $storage->exists($path.$FRONTEND_LOGO)){
	$logoUrl = asset('public/storage/settings/'.$FRONTEND_LOGO);
}

?>
<div class="nav_out"></div>
	<?php

	$BackUrl = CustomHelper::BackUrl();
	$referer = (request()->has('referer'))?request()->referer:'';
	$parentCategories = CustomHelper::getCategories();
	$topMenu = CustomHelper::getMenu('top-menu');
	$menuItems = (isset($topMenu->menuParentItems))?$topMenu->menuParentItems:'';
	$menuItemsList = CustomHelper::getMenuForFront($menuItems, $is_parent = true, $parent_class='', $child_class='sublink', $child_parent_class='childlink');

	//if(!empty($parentCategories) && count($parentCategories) > 0) {
		?>
<header class="header fullwidth"> 
	<div class="topsec clearfix">
		<div class="block-left">
			<form class="color-theme-form">
				<ul>
					<li>
						<div class="input-item">
							<label for="select_coloe">Color Scheme</label>
							<select id="select_coloe" class="droparrow" onchange="colorChange()">
								<option value="Standard" selected="selected">Standard</option>
								<option value="Black">Black/White</option>
							</select>
						</div>
					</li>
					<li class="input-item zoom-wrapper"> 
						<label>Text Size</label>
						<input title="Increase Text Size" type="button" role="button" id="A1" class="increase" onclick="textType()" value=" A+ ">
						<input title="ResetMe Text Size" type="button" role="button" id="A2" class="resetMe" onclick="textType()" value=" A ">
						<input title="Decrease Text Size" type="button" role="button" id="A3" class="decrease" onclick="textType()" value=" A- ">
					</li>
				</ul>
			</form>
		</div>
		<div class="block-right clearfix">
			<!-- <ul class="search-wrapper">
				<li class="headsearch">
					<div class="searchform">
						<form name="searchForm" action="" class="search_form" onsubmit="return submit_search_form();">
							<input type="text" name="keyword" value="" placeholder="Search" autocomplete="off"><button><i class="searchicon"></i></button>
						</form>
					</div>
				</li>
			</ul> -->
			<ul class="contact-details-top clearfix">
				<?php
				if(!empty($SITE_EMAIL)){
					?>
					<li><a href="mailto:{{$SITE_EMAIL}}" title="Email"><i class="mailicon"></i> <span>{{$SITE_EMAIL}}</span></a></li>
					<?php
				}
				if(!empty($SITE_PHONE)){
					?>
					<li><a href="tel:{{$SITE_PHONE}}" title="Phone"><i class="phoneicon"></i> <span>{{$SITE_PHONE}}</span></a></li>
					<?php
				}
				?>
			</ul>
			<ul class="social-links clearfix">
		          <?php
		          //prd($FACEBOOK);
		          if(!empty($FACEBOOK)){
		            ?>
		            <li><a class="facebook-link" href="{{$FACEBOOK}}" target="_blank" title="Facebook"><i class="facebookicon"></i></a></li>
		            <?php
		          }
		          if(!empty($YOUTUBE)){  
		            ?>
		            <li><a class="youtube-link" href="{{$YOUTUBE}}" target="_blank" title="Youtube"><i class="youtubeicon"></i></a></li>
		            <?php
		          }
		          /*if(!empty($TWITTER)){
		            ?>
		            <li><a href="{{$TWITTER}}" target="_blank"><i class="twittericon"></i></a></li>
		            <?php
		          }
		          if(!empty($LINKEDIN)){
		            ?>
		            <li><a href="{{$LINKEDIN}}" target="_blank"><i class="linkedinicon"></i></a></li>
		            <?php
		          }
		          if(!empty($INSTAGRAM)){
		            ?>
		            <li><a href="{{$INSTAGRAM}}" target="_blank"><i class="instagramicon"></i></a></li>
		            <?php
		          }
		           if(!empty($PINTEREST)){
		            ?>
		            <li><a href="{{$PINTEREST}}" target="_blank"><i class="pinteresticon"></i></a></li>
		            <?php
		          }*/
		          ?>
        	</ul>
		</div>
	</div>
	<div class="headsec fullwidth">
	<div class="logo">
		<a href="{{url('/')}}" title="Logo"><img src="{{$logoUrl}}" alt="Logo" border="0" /></a>
	</div>
	<!-- <a href="javascript:void(0)" class="navicon"  data-toggle="collapse" aria-label="Expand Menu" title="Expand Menu" data-target=".navbar-collapse"><span></span></a> -->
	<div class="navbar-header pull-right ">
<button type="button" class="navbar-toggle pz" data-toggle="collapse" aria-label="icons" data-target=".navbar-collapse">
<span class="sr-only">Hide Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>

		
 
		<div class="navbar-collapse collapse" >
<nav role="navigation" class="topmenu">
<ul class="nav-menu js-nav-menu">
<li class="nav-item" title="Home"><a href="{{url('/')}}">Home</a></li>
<li class="nav-item" title="About Us"><a href="{{url('about-us')}}">About Us</a></li>
<li class="nav-item" title="Mission and Vision"><a href="{{url('mission-and-vision')}}">Mission and Vision</a></li>
<li class="nav-item" title="Our Founder"><a href="{{url('our-founder')}}">Our Founder</a></li>
<li class="nav-item" title="Volunteer"><a href="{{url('volunteer')}}">Volunteer</a></li>
<li class="nav-item droplinks" title="Gallery">
<a href="#!" role="button" aria-expanded="false" tabindex="0" class="">Gallery</a>
<div class="sub-nav sub-menu" role="region" aria-expanded="true" aria-hidden="false" >
<ul class="sub-nav-group">
	<li title="Photo Gallery"><a href="{{url('gallery')}}">Photo Gallery</a></li>
	<li title="Video Gallery"><a href="{{url('videos')}}">Video Gallery</a></li>
</ul>
</div>
</li>
<li class="nav-item droplinks" title="Donate">
<a href="#!" role="button" aria-expanded="false" tabindex="0" class="">Donate</a>
<div class="sub-nav" role="region" aria-expanded="true" aria-hidden="false" >
<ul class="sub-nav-group">
	<li><a href="{{url('donate-online-within-india')}}">Donate Online Within India</a></li>
	<li><a href="{{url('international-donations')}}">International Donations</a></li>
	<li><a href="{{url('cheque-or-dd')}}">Write a Cheque or DD</a></li>
	<li><a href="{{url('donate-for-a-kind')}}">Kind Donations</a></li>
</ul>
</div>
</li>
<li class="nav-item" title="Sponsor a Meal"><a href="{{url('sponsor-a-meal')}}">Sponsor a Meal</a></li>
@if(CustomHelper::isAllowedModule('blogs'))
<li class="nav-item" title="Blogs"><a href="{{url('blogs')}}">Blogs</a></li>
@endif
<li class="nav-item highlight-link" title="Contact Us"><a href="{{url('contact-us')}}">Contact Us</a></li>
 
</ul>
</nav>
</div>
 
	</div>

	<?php
	$authCheck = auth()->check();

	$cartCollection = Cart::getContent();
	$cartCount = $cartCollection->count();
	 ?>

	<!--<div class="topright">
		<ul>
			<?php
			if(!empty($SITE_PHONE)){
				?>
				<li><a href="tel:{{$SITE_PHONE}}"><i class="phoneicon"></i> {{$SITE_PHONE}}</a></li>
				<?php
			}
			if(!empty($SITE_EMAIL)){
				?>
				<li><a href="mailto:{{$SITE_EMAIL}}"><i class="mailicon"></i> {{$SITE_EMAIL}}</a></li>
				<?php
			}
			?>

			 <?php
			if($authCheck){
				?>
				<li><a href="{{url('users')}}"><i class="profileicon"></i><span>Profile</span></a>
					<div class="dropdownsec">
						<ul>
							<li><a href="{{url('users/profile')}}"><strong>Hello</strong><br>{{ auth()->user()->email }} </a></li>
							<li><a href="{{url('users/orders')}}">Orders History</a></li>
							<li><a href="{{url('users/profile')}}">Profile</a></li> 
							<li><a href="{{url('users/update')}}">Edit Profile</a></li>
							<li><a href="{{url('users/wishlist')}}">Wishlist</a></li> 
							<li><a href="{{url('users/wallet')}}">Wallet</a></li> 
							<li><a href="{{url('logout')}}">Log Out</a></li>
						</ul>	
					</div>
				</li> 
				<?php
			}  
			else{				

				$login_url = url('account/login');

				$strposLoginUrl = strpos($BackUrl,"account/login");

				echo 'strpos='.$strposLoginUrl;

				if( strlen($strposLoginUrl) > 0 && $strposLoginUrl >= 0){
					$login_url = url('account/login?referer='.$referer);
				}

				?>
			 <li><a href="{{$login_url}}"><i class="profileicon"></i><span>Login</span></a></li> 
				<li class="open_slide"><a href="javascript:void(0)" class="mainLoginBtn"><span>Login</span></a></li>
				<?php
			}
			if($authCheck){
				?>
				<li><a href="{{url('users/wishlist')}}"><span>Wishlist</span></a></li>
				<?php
			}
			else{
				?>
				<li><a href="{{url('account/login?referer=users/wishlist')}}"> <span>Wishlist</span></a></li>
				<?php
			}
			?> -->
			 
			<!-- <li><a href="{{url('cart')}}"><i class="carticon"></i><small><span id="cart_count">{{$cartCount}}</span></small> </a></li>
			
			 
		</ul>
	</div> -->

	<?php
	$keyword = (request()->has('keyword'))?request()->keyword:'';
	?>




	<!-- <div class="searchform" style="position:relative;">
		<form name="searchForm" action="{{url('products')}}" class="search_form" onsubmit="return submit_search_form();">
			<input type="text" name="keyword" value="{{$keyword}}" placeholder="Search for products, brands and more" autocomplete="off" /><button><i class="searchicon"></i></button>
		</form>

		<div id="search_list" style="z-index: 99; position: absolute; top: 42px; /* bottom: 0; */ width: 100%;"></div>
	</div>


	<form name="searchForm2" action="{{url('products')}}"></form> -->

</header>