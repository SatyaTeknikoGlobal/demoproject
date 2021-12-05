<!DOCTYPE html>
<html>
<head>

  <title>{{ $title or 'Theme-1' }}</title>

<meta name="description" content="{{(isset($meta_description))?$meta_description:''}}"/>
<meta name="keywords" content="{{(isset($meta_keyword))?$meta_keyword:''}}"/>

<link rel="profile" href="http://gmpg.org/xfn/11">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<!-- <link rel="icon" type="image/ico" href="{{url('/favicon.ico')}}" /> -->
<link rel="shortcut icon" href="{{url('/favicon.ico')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
<!-- magnific-popup css -->
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/js/magnificpopup/magnific-popup.css')}}">
<!-- End magnific-popup- css -->
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/aos.css')}}" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
{{ $headerBlock or '' }}

</head>

<?php
$THEME_NAME = 'themes./'.CustomHelper::getThemeName();

$websiteSettingsNamesArr = ['FOOTER_CONTACT_DETAILS', 'FOOTER_TEXT', 'FOOTER_BOTTOM', 'SITE_ADDRESS', 'SITE_PHONE', 'SITE_EMAIL', 'FACEBOOK', 'TWITTER', 'LINKEDIN', 'INSTAGRAM', 'YOUTUBE', 'PINTEREST', 'FRONTEND_LOGO','HOME_VIDEO','SITE_COPYRIGHT_TEXT','HOME_HEADING_1','HOME_HEADING_2','HOME_HEADING_3','HOME_HEADING_4'];

$websiteSettingsArr = CustomHelper::websiteSettingsArray($websiteSettingsNamesArr);

$SITE_ADDRESS = (isset($websiteSettingsArr['SITE_ADDRESS']))?$websiteSettingsArr['SITE_ADDRESS']->value:'';
$SITE_PHONE = (isset($websiteSettingsArr['SITE_PHONE']))?$websiteSettingsArr['SITE_PHONE']->value:'';
$SITE_EMAIL = (isset($websiteSettingsArr['SITE_EMAIL']))?$websiteSettingsArr['SITE_EMAIL']->value:'';
$FRONTEND_LOGO = (isset($websiteSettingsArr['FRONTEND_LOGO']))?$websiteSettingsArr['FRONTEND_LOGO']->value:'';

$FACEBOOK = (isset($websiteSettingsArr['FACEBOOK']))?$websiteSettingsArr['FACEBOOK']->value:'';
$TWITTER = (isset($websiteSettingsArr['TWITTER']))?$websiteSettingsArr['TWITTER']->value:'';
$LINKEDIN = (isset($websiteSettingsArr['LINKEDIN']))?$websiteSettingsArr['LINKEDIN']->value:'';
$INSTAGRAM = (isset($websiteSettingsArr['INSTAGRAM']))?$websiteSettingsArr['INSTAGRAM']->value:'';
$PINTEREST = (isset($websiteSettingsArr['PINTEREST']))?$websiteSettingsArr['PINTEREST']->value:'';
$YOUTUBE = (isset($websiteSettingsArr['YOUTUBE']))?$websiteSettingsArr['YOUTUBE']->value:'';

$FOOTER_CONTACT_DETAILS = (isset($websiteSettingsArr['FOOTER_CONTACT_DETAILS']))?$websiteSettingsArr['FOOTER_CONTACT_DETAILS']->value:'';
$FOOTER_TEXT = (isset($websiteSettingsArr['FOOTER_TEXT']))?$websiteSettingsArr['FOOTER_TEXT']->value:'';
$FOOTER_BOTTOM = (isset($websiteSettingsArr['FOOTER_BOTTOM']))?$websiteSettingsArr['FOOTER_BOTTOM']->value:'';
$SITE_COPYRIGHT_TEXT = (isset($websiteSettingsArr['SITE_COPYRIGHT_TEXT']))?$websiteSettingsArr['SITE_COPYRIGHT_TEXT']->value:'';
$HOME_VIDEO = (isset($websiteSettingsArr['HOME_VIDEO']))?$websiteSettingsArr['HOME_VIDEO']->value:'';
$HOME_HEADING_1 = (isset($websiteSettingsArr['HOME_HEADING_1']))?$websiteSettingsArr['HOME_HEADING_1']->value:'';
$HOME_HEADING_2 = (isset($websiteSettingsArr['HOME_HEADING_2']))?$websiteSettingsArr['HOME_HEADING_2']->value:'';
$HOME_HEADING_3 = (isset($websiteSettingsArr['HOME_HEADING_3']))?$websiteSettingsArr['HOME_HEADING_3']->value:'';
$HOME_HEADING_4 = (isset($websiteSettingsArr['HOME_HEADING_4']))?$websiteSettingsArr['HOME_HEADING_4']->value:'';
?>

<body class="home {{ $bodyClass or '' }}">

  @include($THEME_NAME.'/layouts.header')

<!-- all pages content/html will come in this slot -->
  {{ $slot }}

<?php

/*$FOOTER_CONTACT_DETAILS = CustomHelper::WebsiteSettings('FOOTER_CONTACT_DETAILS');
$FOOTER_TEXT = CustomHelper::WebsiteSettings('FOOTER_TEXT');
$FOOTER_BOTTOM = CustomHelper::WebsiteSettings('FOOTER_BOTTOM');*/



?>
<script type="text/javascript" src="{{asset('public/assets/themes/theme-1/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/themes/theme-1/js/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<script src="https://adobe-accessibility.github.io/Accessible-Mega-Menu/js/jquery-accessibleMegaMenu.js"></script>
<script>$('.collapse').collapse(hide)</script>
@include($THEME_NAME.'/layouts.footer')




<script>
$('.decrease').on('click', function () {
    $('*').animate({'font-size': '-=1'});
});
$('.increase').on('click', function () {
    $('*').animate({'font-size': '+=1'});
});

$('.resetMe').on('click', function () {
    $('*').animate({'font-size': '13px'});
});

$(window).load(function()
{
if("A"== " A+ ")
 {
  document.getElementById("A1").click();

}
if("A"==" A ")
 {
 document.getElementById("A2").click();

}
 if("A"==" A- ")
 {
    document.getElementById("A3").click();
}
if("Standard"=="Standard")
{
$(".color-theme-form select").val("Standard");
$('body').removeClass("color");
}
if("Standard"=="Black")
{
$(".color-theme-form select").val("Black");
$('body').addClass("color");

}
});

function textType()
 {
 var text= event.target.value;
 $.ajax({
     url: "/textChange",
     type: 'POST',
     data: {text:text},
     success: function (json) {

     }
 })
 }

function colorChange()
{
 var cvalue=document.getElementById("select_coloe");
 if(cvalue[cvalue.selectedIndex].value == "Standard") {
   var color="Standard"
 }
 if(cvalue[cvalue.selectedIndex].value == "Black") {
   var color="Black"
 }
     $.ajax({
     url: "/colorChange",
     type: 'POST',
     data: {color:color},
     success: function (json) {
     }
 })
}
</script>
<script type="text/javascript">
   $('#select_coloe').on('change', function() {
        $('body').toggleClass('color');
    });
</script>
 <script type="text/javascript">
   $(window).scroll(function() {
    if ($(this).scrollTop() >= 250) {
        $('#topscroll').fadeIn(200);
    } else {
        $('#topscroll').fadeOut(200);
    }
});
$('#topscroll').click(function() {
    $('body,html').animate({
        scrollTop : 0 
    }, 500);
});


$('.subscribeBtn').click(function(e)
{
   e.preventDefault();

   var currSelector = $(this);
   var y= true;
   var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; 
   var email = currSelector.siblings("input[name='subscribe_email']").val().trim();
   //alert(email); return false;

   if(email==''){

     currSelector.siblings('.newsletter_messages').html('<span style="color:#e41881">Email is required.</span>');
     y=false;
   } 
   if(email!=''){
    if (!filter.test(email)){
      currSelector.siblings('.newsletter_messages').html('<span style="color:#e41881">Invalid Email.</span>');
      y=false;
    }
  }
   
  if(y) {
    var _token = '{{csrf_token()}}';
    $.ajax({
      url : '<?php echo url('common/newsletterSubscribe'); ?>',
      type : 'POST',
      data : {email:email},
      dataType: 'JSON',
      async : false,
      headers:{'X-CSRF-TOKEN': _token},
      success: function(resp){
        if(resp.success){

          if(resp.message){
            currSelector.siblings('.newsletter_messages').html('<span>'+resp.message+'</span>');
            currSelector.siblings(".subscribe_email").val('');
            currSelector.siblings(".newsletter_messages").addClass('succ_msg');
            //currSelector.siblings(".newsletter_messages").fadeOut(3000);

          }

        }
        else{
          if(resp.message){
            currSelector.siblings('.newsletter_messages').html('<span>'+resp.message+'</span>');
            currSelector.siblings(".subscribe_email").val('');
          }
        }
      }

    });
  }
   return false; 
});


$(document).on("click", ".btnDonateCheque", function(e){

  e.preventDefault();
  
  if($("#donateChequeForm").isValid()){

  var currSel = $(this);

  //alert('hii');

  var donateChequeForm = $("form[name=donateChequeForm]");
  donateChequeForm.find(".form-group").removeClass( "has-error" );
  donateChequeForm.find(".help-block").remove();

  var _token = '{{ csrf_token() }}';
  
  

  $.ajax({
    url: "{{ url('ajax_request_donate_cheque') }}",
    type: "POST",
    data: donateChequeForm.serialize(),
    dataType:"JSON",
    headers:{'X-CSRF-TOKEN': _token},
    cache: false,
    beforeSend:function(){
      donateChequeForm.find(".form-group").removeClass( "has-error" );
      donateChequeForm.find(".help-block").remove();
    },
    success: function(resp){
      if(resp.success) {
        $("#donateChequeForm").find(".msg").html('<div class="alert alert-success"> Your Request has been submitted. </div>');

        document.donateChequeForm.reset();

        //window.location = "{{url('thankyou')}}";
      }
      else if(resp.errors){

        var errTag;
        var countErr = 1;

        $.each( resp.errors, function ( i, val ) {

          //donateChequeForm.find( "[name='" + i + "']" ).parents(".form-group").addClass( "has-error" );
          donateChequeForm.find( "[name='" + i + "']" ).parents(".form-group").append( '<p class="help-block">' + val + '</p>' );

          if(countErr == 1){
            errTag = donateChequeForm.find( "[name='" + i + "']" );
          }
          countErr++;

        });

        if(errTag){
          errTag.focus();
        }
      }
    }
  });

}

});


</script>

<script type="text/javascript">
    $('.changeCaptcha').on('click', function(e){
      e.preventDefault();

      //alert('hhh');
      
      var captcha = $(".captchImgBox").find('img');

      var _token = '{{csrf_token()}}';

      $.ajax( {
        url: "{{url('common/ajax_regenerate_captcha')}}",
        type: "POST",
        data: {},
        dataType: "JSON",
        headers: {
          'X-CSRF-TOKEN': _token
        },
        cache: false,
        beforeSend: function () {},
        success: function ( resp ) {
          if ( resp.success ) {
            if(resp.captcha_src){
              captcha.attr('src', resp.captcha_src);
            }
          }
        }
      } );
    });


    function validate_contactform()
    {
      //alert('df'); return false;
      $('.error_f_name').html('');
      $('.error_l_name').html('');
      $('.error_c_email').html('');
      $('.error_comment').html('');
      $('.error_phone').html('');
      var z = true;
      var forSub = $('#forSub').val();
      var name = $('#name').val();
      var last_name = $('#last_name').val();
      var phone = $('#phone').val();
      var contact_email = $('#contact_email').val();
      var subject = $('#subject').val();
      var comment = $('#comment').val();
      var scode = '';

        //alert(comment); return false;
    
    if(name == ""){
      $('.name').addClass('error_field');
      $('.error_f_name').html('Name Required');
      z = false; 
    }
    else{
      if(!/^[a-zA-Z_ ]*$/g.test(name)){
        $('.name').addClass('error_field');
        $('.error_f_name').html('Only Characters Required!');
        z = false; 
      }

    }
    if(contact_email == ""){
      $('.contact_email').addClass('error_field');
      $('.error_c_email').html('Email is Required');
      z = false; 
    }
    /*else{
      if(!validateEmail(contact_email)){
        $('.contact_email').addClass('error_field');
        $('.error_c_email').html('Invalid Email!');
        z=false; 
      }     
    }
*/
    /*if(subject == ""){
      $('.subject').addClass('error_field');
      $('.error_subject').html('subject Required');
      z = false; 
    }*/

    if(phone == ""){
      $('.phone').addClass('error_field');
      $('.error_phone').html('Phone Required');
      z = false; 
    }

    /*if(scode == ""){
      $('.scode').addClass('error_field');
      $('.error_scode').html('Security Required');
      z = false; 
    }*/

    if(z)
    {
      var _token = '{{csrf_token()}}';
      
      $.ajax( {
        url: "{{url('contact')}}",
        type: "POST",
        data: {forSub:forSub, name: name, contact_email: contact_email,comment:comment, phone:phone, subject:subject},
        dataType: "JSON",
        headers: {
          'X-CSRF-TOKEN': _token
        },
        cache: false,
        beforeSend: function () {},
        success: function ( resp ) {
          if ( resp.success ) {

            //window.location = "{{url('thank-you')}}";
            $('.msg').addClass('thank-you');
            $('.msg').html(resp.message);
            document.contactForm.reset();
            
                }
                if(resp.errors && resp.errors.scode){
                  $('.error_scode').html(resp.errors.scode);

                }
            }
        });
    }

    return false;

  }

  </script>
  <script type="text/javascript">
  setTimeout(function() {
   $('.flash-message').fadeOut();
   //$('#name, #email, #msg, #origin').val('')
  }, 3000 );
  /*$(document).ready(function(){
      $('#cont').on('click', function(event) {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({scrollTop: $(hash).offset().top}, 900);
      });
  })*/
jQuery(function(){
  jQuery(document).on('click', '.scrolltolink', function (event) {
    event.preventDefault();

    var sel_data_val = $(this).data('value');

    $('#donate').val(sel_data_val);

    var winwidth = jQuery(window).width();
    if(winwidth > 640 ){
      
      jQuery('html, body').animate({
          scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top-10
      }, 500);
    }else{
      jQuery('html, body').animate({
          scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top-100
      }, 500);


    }
  });
});
</script>
<script type="text/javascript">
    $(window).scroll(function() {
   if ($(this).scrollTop() > 0){  
    $('header').addClass("sticky");
    }
    else{
    $('header').removeClass("sticky");
    }
  }); 
  $(document).ready(function () { 
    $( "body" ).click(function() {
      $('.navicon').removeClass('active');
      $('.navbar-collapse').removeClass('showmenu');
    });
    $( ".navicon" ).click(function(e) {
        e.stopPropagation();
        $(this).toggleClass('active');
        $( ".navbar-collapse" ).toggleClass('showmenu');
      }); 
    $(".topmenu").click(function(e){
      e.stopPropagation();
    }); 
    $(".topmenu > ul > li > a").each(function(){ 
      if($(this).parent().children("ul").length){
        $(this).parent('li').addClass("sub-links"); 
        } 
    });
    // $(".sub-links > a").each(function(){  
    //   $(this).before( '<span class="plusicon"></span>' ); 
    // });  
    $('.sub-links > a').click(function(e) {
      e.stopPropagation();
      
     if($(this).parent().hasClass("active")){
        $(this).parent().removeClass("active");
        $(this).parent().find(".plusicon").removeClass("minus_icon");
     } else {
      $(".sub-links").removeClass("active");
      $(".sub-links .plusicon").removeClass("minus_icon");
      $(this).parent().addClass("active");
      $(this).parent().find(".plusicon").addClass("minus_icon");
     }

      $parPlus.stop(true, true).toggleClass("minus_icon");
      $(this).next().slideToggle();
        
    });   
  });
  $(".navbar-toggle").on("click", function(){
    $(this).toggleClass("active");
    if($(this).hasClass("active")){
      $(this).attr("aria-label", "Menu Expanded");
    } else {
      $(this).attr("aria-label", "Menu Collapsed");
    }
  })

</script>
<script src="{{asset('public/assets/themes/theme-1/js/aos.js')}}"></script>
 <script>
    AOS.init({
      //easing: 'ease-out-back',
      //duration: 1000
    });
  </script>

{{ $footerBlock or '' }}
</body>
</html>