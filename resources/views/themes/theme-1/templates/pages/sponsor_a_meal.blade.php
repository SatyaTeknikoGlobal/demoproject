@component('themes.theme-1.layouts.main')

@slot('title')
    {{$meta_title or ''}}
@endslot

@slot('meta_description')
    {{$meta_description or ''}}
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />
<!-- Event snippet for Donate-India conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-527459866/kZgGCJabreQBEJrMwfsB', 'transaction_id': '', 'event_callback': callback }); return false; } </script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
@endslot

<?php
$url = url()->current();

$storage = Storage::disk('public');
$image = '';
if(!empty($cms['image']) && $storage->exists('cms_pages/thumb/'.$cms['image'])){
  $image = url('public/storage/cms_pages/thumb/'.$cms['image']);
}

$banner_image = asset('public/assets/themes/theme-1/images/default-img.png');
if(!empty($cms['banner_image']) && $storage->exists('cms_pages/'.$cms['banner_image'])){
  $banner_image = url('public/storage/cms_pages/'.$cms['banner_image']);
}

$websiteSettingsNamesArr = ['FOOTER_CONTACT_DETAILS', 'FOOTER_TEXT', 'FOOTER_BOTTOM', 'SITE_ADDRESS', 'SITE_PHONE', 'SITE_EMAIL', 'FACEBOOK', 'TWITTER', 'LINKEDIN', 'INSTAGRAM','FRONTEND_LOGO'];

$websiteSettingsArr = CustomHelper::websiteSettingsArray($websiteSettingsNamesArr);

$SITE_ADDRESS = (isset($websiteSettingsArr['SITE_ADDRESS']))?$websiteSettingsArr['SITE_ADDRESS']->value:'';
$SITE_PHONE = (isset($websiteSettingsArr['SITE_PHONE']))?$websiteSettingsArr['SITE_PHONE']->value:'';
$SITE_EMAIL = (isset($websiteSettingsArr['SITE_EMAIL']))?$websiteSettingsArr['SITE_EMAIL']->value:'';

$rno = 9;
$order_id = CustomHelper::randomNumberOrder($rno);
?>
<section class="fullwidth innerbanner" style="background: url('<?php echo $banner_image;?>') center center no-repeat;">
<!-- <img src="" alt="Industries &amp; Applications"> -->
</section>
<div class="breadcrumbs">
  <div class="container">
    <ul class="clearfix">
      <li><a href="{{url('/')}}">Home</a></li>  
      <li>{{$cms['title']}}</li>      
    </ul>
  </div>
</div>
<section class="fullwidth innerpage cmlayout">
<div class="container">
  <div class="servcont text-center">
      <h1 class="headings headings-with-border">{{$cms['title']}}</h1>
    </div>
    <div class="cms-content-wrapper">
      <?php /*
      if(!empty($image)){
      ?>
    <div class="pageimg">
      <img src="<?php echo $image;?>" alt="{{$cms['title']}}">
    </div>
    <?php } */?>
    <div class="cmscontent">
       <?php echo $cms['content']; ?>

     <div class="donate-form-wrapper sponsorfrm">
        @include('components.includes._book_meal_form')

    </div>
        <!-- <p><a class="button book-meal" href="{{url('sponsor-meal-form')}}">Book Now</a></p> -->

    </div>
    </div>
    <?php //if(isset($cms['description'])){?>
  <div class="spara">
 <?php 
    $description = isset($cms['description']) ? $cms['description'] :'';
    //echo $description;
    ?>
  </div>
    <?php //}?>

    <div class="shear">
  <h4>Spread the Word</h4>
  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url?>" target="_blank" class="facebook" title="facebook"><i class="fa fa-facebook"></i></a>
  <a href="http://www.twitter.com/share?url=<?php echo $url?>" target="_blank" class="twitter" title="twitter"><i class="fa fa-twitter"></i></a>
  <a href="https://www.linkedin.com/shareArticle?url=<?php echo $url?>" target="_blank" class="linkedin" title="linkedin"> <i class="fa fa-linkedin"></i></a>
  <a href="whatsapp://send?text=<?php echo $url?>" target="_blank" class="whatsapp" title="whatsapp"><i class="fa fa-whatsapp"></i></a>
  <a href="https://www.instagram.com/sharer/sharer.php?u=<?php echo $url?>" target="_blank" class="instagram" title="instagram"><i class="fa fa-instagram"></i></a>
</div>
  </div>
</section>

@slot('footerBlock')

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
$.validate({
});

$( function() {
    $( "#date_of_booking" ).datepicker();
  } );
</script>

<script type="text/javascript">
  $("#type_of_meal").change(function() {
  var type_of_meal = $(this).find(':selected').data('value')
    if(type_of_meal == 'custom-amount'){
      $('#custom_amount').show();
      $('#custom_amount').attr('disabled',false);
      $('.btnBookMeal').hide();
    }
    else
    {
      $('#custom_amount').hide();
      $('.btnBookMeal').show();
      $('#custom_amount').attr('disabled','disabled');

    }
  });

      $( function() {
           $('#state_text').hide();
            $("#state_text").attr('disabled','disabled');

      $( "#country" ).change(function() {
        var country_id = $('#country').val();
        if(country_id != 99)
        {   
            $('#state_select').hide();
            $("#state_select").attr('disabled','disabled');
            $('#state_text').show();
            //$("#state_text").prop('disabled', false);
            $("#state_text").attr('disabled',false);


        }
        if(country_id == 99){
            $('#state_text').hide();
            $("#state_text").prop('disabled', true);
            $('#state_select').show();
            $("#state_select").prop('disabled', false);
        }
        var _token = '{{csrf_token()}}';
        $.ajax({
          url : '<?php echo url('meal/get_state'); ?>',
          type : 'POST',
          data : {country_id:country_id},
          dataType: 'html',
          async : false,
          headers:{'X-CSRF-TOKEN': _token},
          success: function(resp){
              $('#state').html(resp);

          }

        });

      });

 });





</script>

<script type="text/javascript">
  
  $(document).on("click", ".btnBookMeal", function(e){

  e.preventDefault();
  
  if($("#bookMealForm").isValid()){

  var currSel = $(this);

  //alert('hii'); return false;

  var bookMealForm = $("form[name=bookMealForm]");
  bookMealForm.find(".form-group").removeClass( "has-error" );
  bookMealForm.find(".help-block").remove();

  var _token = '{{ csrf_token() }}';
  
  

  $.ajax({
    url: "{{ url('ajax_sponsor_meal') }}",
    type: "POST",
    data: bookMealForm.serialize(),
    dataType:"JSON",
    headers:{'X-CSRF-TOKEN': _token},
    cache: false,
    beforeSend:function(){
      bookMealForm.find(".form-group").removeClass( "has-error" );
      bookMealForm.find(".help-block").remove();
    },
    success: function(resp){
      if(resp.success) {
        //$("#bookMealForm").find(".msg").html('<div class="alert alert-success"> Your Request has been submitted. </div>');

        document.bookMealForm.reset();

        window.location = "{{url('thankyou')}}";
      }
      else if(resp.errors){

        var errTag;
        var countErr = 1;

        $.each( resp.errors, function ( i, val ) {

          //bookMealForm.find( "[name='" + i + "']" ).parents(".form-group").addClass( "has-error" );
          bookMealForm.find( "[name='" + i + "']" ).parents(".form-group").append( '<p class="help-block">' + val + '</p>' );

          if(countErr == 1){
            errTag = bookMealForm.find( "[name='" + i + "']" );
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



  function submitPaymentForm(transaction_id){
    //alert(transaction_id); return false;

    var bookMealForm = $("form[name=bookMealForm]");
    bookMealForm.find(".form-group").removeClass( "has-error" );
    bookMealForm.find(".help-block").remove();

    formData = bookMealForm.serialize()+'&transaction_id='+transaction_id;

    var _token = '{{ csrf_token() }}';

    $.ajax({
      url: "{{ url('ajax_sponsor_meal') }}",
      type: "POST",
      data: formData,
      dataType:"JSON",
      headers:{'X-CSRF-TOKEN': _token},
      cache: false,
      beforeSend:function(){
        bookMealForm.find(".form-group").removeClass( "has-error" );
        bookMealForm.find(".help-block").remove();
      },
      success: function(resp){
        if(resp.success) {
          $("#bookMealForm").find(".msg").html('<div class="alert alert-success"> Your Request has been submitted. </div>');

          document.bookMealForm.reset();

          window.location = "{{url('thankyou')}}";
        //window.location = "{{url('thankyou')}}";
      }
      else if(resp.errors){

        var errTag;
        var countErr = 1;

        $.each( resp.errors, function ( i, val ) {

          //donateForm.find( "[name='" + i + "']" ).parents(".form-group").addClass( "has-error" );
          bookMealForm.find( "[name='" + i + "']" ).parents(".form-group").append( '<p class="help-block">' + val + '</p>' );

          if(countErr == 1){
            errTag = bookMealForm.find( "[name='" + i + "']" );
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


  $(document).on("click", ".btnBookMealPayNow", function(e){

    e.preventDefault();

    var logoUrl = "{{asset('public/images/logo.png')}}";

    $('#error_amount').html('');

    var sel_amount = $('#type_of_meal').find(':selected').data('value');
    var contact_name = $('#name').val();
    var contact_email = $('#contact_email').val();
    var contact_phone = $('#phone').val();

    if($("#bookMealForm").isValid()){


     if(sel_amount == 'undefined'){
       return false;
     }
     if(sel_amount == 'custom-amount'){
       sel_amount = $('#amount').val();
     }

     if((!isNaN(sel_amount) && sel_amount == 0) || isNaN(sel_amount)){
       $('#error_amount').html('Amount should be grater than 0');
       return false;
     }

    var currSel = $(this);

    var options = {
     key: "{{ config('custom.RAZORPAY_KEY') }}",
     amount: sel_amount+'00',
     id: "{{$order_id}}",
     name: 'Blindwelfaresociety',
     image: logoUrl,
     "prefill": {
        "name": contact_name,
        "email": contact_email,
        "contact": contact_phone
    },
     handler: demoSuccessHandler
   }

   window.r = new Razorpay(options);
      //document.getElementById('paybtn').onclick = function () {
        var succ = r.open();

        //console.log(succ);
        //return false;
      //}
  //alert('hii');

  if(succ){

    return false;
    var bookMealForm = $("form[name=bookMealForm]");
    bookMealForm.find(".form-group").removeClass( "has-error" );
    bookMealForm.find(".help-block").remove();

    var _token = '{{ csrf_token() }}';

    $.ajax({
      url: "{{ url('ajax_sponsor_meal') }}",
      type: "POST",
      data: bookMealForm.serialize(),
      dataType:"JSON",
      headers:{'X-CSRF-TOKEN': _token},
      cache: false,
      beforeSend:function(){
        bookMealForm.find(".form-group").removeClass( "has-error" );
        bookMealForm.find(".help-block").remove();
      },
      success: function(resp){
        if(resp.success) {
          //$("#bookMealForm").find(".msg").html('<div class="alert alert-success"> Thanks for your generous support. We will send you the donation receipt soon. </div>');

          document.bookMealForm.reset();

        //window.location = "{{url('thankyou')}}";
        window.location = "{{url('thankyou')}}";
      }
      else if(resp.errors){

        var errTag;
        var countErr = 1;

        $.each( resp.errors, function ( i, val ) {

          //bookMealForm.find( "[name='" + i + "']" ).parents(".form-group").addClass( "has-error" );
          bookMealForm.find( "[name='" + i + "']" ).parents(".form-group").append( '<p class="help-block">' + val + '</p>' );

          if(countErr == 1){
            errTag = bookMealForm.find( "[name='" + i + "']" );
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
}
});

    $('#bookMealForm').submit(function (e) {
        var button = $(this).find('button');
        var parent = $(this);
        button.attr('disabled', 'true').html('Please Wait...');
        $.ajax({
            method: 'get',
            url: this.action,
            data: $(this).serialize(),
            complete: function (r) {
                console.log('complete');
                console.log(r);
            }
        })
        return false;
    })




    function padStart(str) {
        return ('0' + str).slice(-2)
    }

    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        $("#paymentDetail").removeAttr('style');
        $('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        $('#paymentDate').text(
                padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                );

        var transaction_id = transaction.razorpay_payment_id;

        submitPaymentForm(transaction_id);
    }


    /*window.r = new Razorpay(options);
    document.getElementById('paybtn').onclick = function () {
        r.open()
    }*/


</script>

@endslot


@endcomponent