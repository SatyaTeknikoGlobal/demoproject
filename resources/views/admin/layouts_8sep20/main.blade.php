<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="_token" content="{{ $_token or '' }}" />
    <title>{{ $title or config('app.name') . ' - Admin Panel' }}</title>

    <link rel="stylesheet" href="{{asset('public/assets')}}/css/chat.css">
    <!-- <link rel="stylesheet" href="{{url('public/assets')}}/css/chat-style.css"> -->

    <?php
    /*
    <link href="favicon.ico" type="image/x-icon" rel="icon" />
    <link href="favicon.ico" type="image/x-icon" rel="shortcut icon" />

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />

    <link href="{{asset('public')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    */
    ?>
    
    <link href="{{asset('public')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{url('public')}}/css/site.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{url('public')}}/css/jquery.mCustomScrollbar.css" />
     <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900" rel="stylesheet" /> 
    <!--Header block-->
    {{ $headerBlock or '' }}
</head>

<body>
<div class="fullwidth mainwrapper">
<div class="container">
    <!-- Site Top -->
    
    <!-- Menu -->
    @include('admin.layouts.nav')
    
    
     <div class="rightsec">
     <!-- Header -->
     <div class="headersec">
     	<div class="menuicon menu_on"><span></span></div>
		 @include('admin.layouts.top')
		 <div class="logo">

		 	<?php
		 	if(file_exists(public_path('assets/img/logo.png'))){
		 		?>
		 		<img src="{{asset('public')}}/assets/img/logo.png" alt="Admin" />
		 		<?php
		 	}
		 	else{
		 		?>
		 		<h4>Admin</h4>
		 		<?php
		 	}
		 	?>

		 </div>
     </div>
   

    

    <!-- Body -->
    <div class="centersec">
    {{ $slot }}
    </div>
    
    <div class="copyright text-center">
		All Rights Reserved &copy;  <?php echo date('Y'); ?>
	</div>
    
     </div>

    

</div>
</div>

<!-- Placed at the end of the document so the pages load faster -->

<?php
/*
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
*/
?>



<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>


	<style>
		.leftsec1{height: calc(100% - 70px); position: absolute; top: 0; margin-top: 70px;}
	</style>
	<script>
		(function($){
			

			$(document).click(function(){
				$("body").removeClass("nav_active");
			});
			$(".menu_on,.leftsec1").click(function(e){
				e.stopPropagation();
				$("body").addClass("nav_active");
			});
		})(jQuery);
	</script>
	
<!--Bottom block-->
{{ $bottomBlock or '' }}
	
<script>
/*$(".subtab").click(function(){
	
		$('li').removeClass('active');
	
	  if($(this).parent().hasClass("active")) {
			$(this).parent().removeClass('active');
		} else {
			$('.subtab').removeClass('active');
			$(this).parent().addClass('active');
			
			
		}
  });*/
	$('.dropul').click(function(){
		$(".dropul").parent('li').not($(this).parent('li')).removeClass( "active" );
		$(".dropul").parent('li').not($(this).parent('li')).find("ul").slideUp(300);
		$(this).parent('li').toggleClass( "active" );
		//$(this).parent() .toggleClass( "active" );
		$(this).parent().find("ul").slideToggle(300);
	} );
	if($(".adminleft > li").hasClass("active")){
		$(".adminleft > li.active").find("ul").slideDown(300);
	}
	$('.child_dropul').click(function(){
		$(".child_dropul").siblings('ul').not($(this).siblings('ul')).slideToggle();

		if($(this).find('i').hasClass("fa-angle-right")){
			$(this).find('i').removeClass("fa-angle-right");
			$(this).find('i').addClass("fa-angle-down");
		}
		else{
			$(this).find('i').addClass("fa-angle-right");
			$(this).find('i').removeClass("fa-angle-down");
		}
		
		$(this).siblings('ul').toggle();
		//$(this).parent() .toggleClass( "active" );
	} );
</script>

<!--
<script>
$(".subnav_link").click(function(){
		if($(this).hasClass("active")){
			$(".catsubnav_full").slideUp(300);
			$(".subnav_link").removeClass("active");
		} else {
			$(".catsubnav_full").hide();
			$(".subnav_link").removeClass("active");
	    $(this).closest("li").find(".catsubnav_full").slideToggle(300);
	    $(this).toggleClass("active"); 
		}
	}); 
</script>-->
	
</body>
</html>