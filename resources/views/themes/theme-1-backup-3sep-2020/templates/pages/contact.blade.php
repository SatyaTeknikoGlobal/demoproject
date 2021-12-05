@component('themes.theme-1.layouts.main')

@slot('title')
    {{$meta_title or ''}}
@endslot

@slot('meta_description')
    {{$meta_description or ''}}
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />

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
<section class="fullwidth innerpage">
  <div class="container">
    <div class="contact-inner clearfix">
      <div class="contact-detail-block">
        <div class="address-wrapper">
          <h3>{{$cms['title']}}</h3>
            <?php //echo $FOOTER_CONTACT_DETAILS; ?>

            <?php
            if(!empty($SITE_ADDRESS)){
              ?>
              <p><span class="ad-title"><i class="pinicon-blue"></i> <?php echo"$SITE_ADDRESS"; ?></span></p>
              <?php
            }
            if(!empty($SITE_EMAIL)){
              ?>
              <p><a href="tel:{{$SITE_EMAIL}}"><i class="mailicon-blue"></i>{{$SITE_EMAIL}}</a></p>
              <?php
            }
            if(!empty($SITE_PHONE)){
              ?>
              <p><a href="tel:+91-11-25948803"><i class="phoneicon-blue"></i>+91-11-25948803</a></p>
              <p><a href="tel:{{$SITE_PHONE}}"><i class="mobileicon-blue"></i>{{$SITE_PHONE}}</a></p>
              <?php
            }
            ?>
            <p><span class="ad-title"><i class="pinicon-blue"></i> Blind Welfare Society, F-5, Near Police Station, <br>Nihal Vihar, New Delhi – 110041</span></p>
        </div>
        <div class="address-wrapper">
          <div class="theme_col_6">
              <div class="para_discription">
                  <?php echo $cms['content']; ?>
              </div>
          </div>
        </div>
      </div>
      <div class="contact-form-block">
        <div class="contact-form-area">
          @include('components.includes._contact_form')
        </div>
      </div>
    </div>
  </div>
</section>

@slot('footerBlock')
@endslot


@endcomponent
