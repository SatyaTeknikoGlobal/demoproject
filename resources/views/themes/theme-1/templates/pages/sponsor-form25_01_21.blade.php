@component('themes.theme-1.layouts.main')

@slot('title')
    {{$meta_title or ''}}
@endslot

@slot('meta_description')
    {{$meta_description or ''}}
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  c-page
@endslot


<?php
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
    <div class="donate-form-wrapper sponsorfrm">
       <?php echo $cms['content']; ?>

        @include('components.includes._book_meal_form')

    </div>
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
