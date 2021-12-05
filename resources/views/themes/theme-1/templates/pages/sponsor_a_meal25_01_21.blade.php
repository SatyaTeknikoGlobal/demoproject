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
@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
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

        <p><a class="button book-meal" href="{{url('sponsor-meal-form')}}">Book Now</a></p>

    </div>
    </div>
  </div>
</section>

@slot('footerBlock')
<script type="text/javascript">
  /*$('.book-meal').on('click',function(ev) {
      ev.stopPropagation();
      $('.book-meal-sec').slideToggle();
    });*/
</script>
@endslot


@endcomponent