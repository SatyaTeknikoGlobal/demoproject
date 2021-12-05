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

        window.location = "{{url('thank-you')}}";
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

</script>

@endslot


@endcomponent
