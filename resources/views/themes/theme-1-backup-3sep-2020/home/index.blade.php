@component('themes.theme-1.layouts.main')

@slot('title')
    Blind Welfare Society
@endslot

@slot('headerBlock')
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />

@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
@endslot

  <?php
  $storage = Storage::disk('public');

  $welcomeCms = CustomHelper::getCMSPage('welcome-to-blind-welfare-society');
  //pr($aboutCms);
  $welcomeTitle = (isset($welcomeCms['title']))?$welcomeCms['title']:'';
  $welcomeBrief = (isset($welcomeCms['brief']))?$welcomeCms['brief']:'';
  $welcomeImage = (isset($welcomeCms['image']))?$welcomeCms['image']:'';
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
  //prd($aboutImage);
  ?>
  <?php

 /* $topMenu = CustomHelper::getMenu('top-menu');

  $menuItems = (isset($topMenu->menuParentItems))?$topMenu->menuParentItems:'';

  $menuItemsList = CustomHelper::getMenuForFront($menuItems, $is_parent = true, $parent_class='', $child_class='', $child_parent_class='');*/
  //CustomHelper::getHeaderMenu($menu_name='top-menu', $menu_id='', $parent_id=0, $ul_class="menu", $child_ul_class='munu_item',$li_class='',$child_li_class='');

  //prd($menuItemsList);

  //prd($banners);
  if(!empty($banners) && count($banners) > 0){
    ?>
  <section class="banner owl-carousel owl-theme fullwidth">

    <?php
    $path = 'banners/';
    foreach($banners as $banner){
      $images = (isset($banner->Images))?$banner->Images:'';

      //prd($images);
      if(!empty($images) && count($images) > 0){
        foreach($images as $image){
          if(!empty($image->name) && $storage->exists($path.$image->name)){
            ?>
            <div>
              <img src="{{url('public/storage/banners/'.$image->name)}}" alt="{{$banner->title}}" />
              <div class="bannertext">
                <div class="banner-title">{{$banner->title}}</div>
                <div class="sub-title">{{$banner->subtitle}}</div>
                <div class="banner-description">{{$banner->brief}}</div>
              </div>
            </div>
            <?php
          } 
        }
      }
    }
    ?>
  </section>
  <?php } ?>
<!-- Welcome start -->
<section class="sectionpad fullwidth welcome-sec">
    <div class="container">
      <div class="top-block-sc">
        <h1 class="headings headings-with-border text-center"><?php echo $HOME_HEADING_1; ?></h1>
      </div>
    </div>
    <div class="welcome-sec-inner">
      <div class="container">
        <div class="welcome-content-block">
          <div class="short-description">
           <?php echo $welcomeBrief; ?>
          </div>
          <div class="button-wrapper">
            <a class="button border-btn" href="{{url('welcome-to-blind-welfare-society')}}">Read More</a>
            <a class="button" href="{{url('donate')}}">Donate Now</a>
          </div>
        </div>
        <div class="welcome-video-block">
          <a href="#home-video" title="" class="inline-popup"> 
            <div class="video-thum-img">
              <img src="{{url('public/storage/cms_pages/'.$welcomeImage)}}" alt="<?php echo $welcomeTitle; ?>">
               <span class="video-play-btn"></span>
            </div>
           
          </a>
           <div id="home-video" class="video-popup-wrapper mfp-hide"> 
                 <?php echo $HOME_VIDEO; ?>
            </div>   
        </div>
      </div>
    </div>
</section> 
<!-- Welcome end -->
<!-- feature project start -->
<!-- CMS Content -->
<?php
$params = [];
$params['featured'] = true;
$params['limit'] = 6;
$cmsData = CustomHelper::getCmsData($id='', $parent_id=13, $limit='', $params);

$parentData = CustomHelper::getCmsData($id=13, $parent_id='', $limit='', $params);
//pr($parentData);
?>

<?php
if(!empty($parentData) && !empty($cmsData) && count($cmsData) > 0){
?>
<section class="sectionpad project-sec fullwidth">
    <div class="container">
    <div class="headings headings-with-border text-center"><?php echo $HOME_HEADING_2; ?></div>
    {{$parentData->brief}}
    <ul class="list3 project-listing clearfix">
      <?php
      foreach ($cmsData as $cms){
        $storage = Storage::disk('public');
        $image = asset('public/assets/themes/theme-1/images/default-img.png');
        if(!empty($cms->image) && $storage->exists('cms_pages/thumb/'.$cms->image)){
          $image = url('public/storage/cms_pages/thumb/'.$cms->image);
        }
        ?>
        <li>
          <a href="<?php echo url($cms->slug);?>" class="cmsbox">
            <div class="imgsec" style="background:url(<?php echo $image; ?>);">
              <img src="<?php echo asset('public/assets/themes/theme-1/images/project_blankimg.png'); ?>" alt="{{$cms->name}}" />
            </div>
            <div class="project-box-wrapper">
                <div class="title">{{$cms->name}}</div>
                <p><?php echo $cms->brief; ?></p>
              <div class="read-more">Read More <i class="arrow-icon"></i></div>
            </div>
          </a>
        </li>
        <?php } ?>
    </ul>
   <!--  <div class="button-wrapper text-center"><a class="button" href="{{$parentData->slug}}">View all</a></div> -->
  </div>
</section>
<?php
}
?>
<!-- feature project end -->
<!-- News start -->
<section class="sectionpad news-sec newsbg fullwidth">
    <div class="container">
      <div class="headings headings-with-border text-center" data-aos="fade-up"><?php echo $HOME_HEADING_3; ?></div>
      <ul class="list3 project-listing clearfix">
       @include('components.includes._news')
      </ul>
    </div>
</section> 
<!-- News end -->
<!-- Testimonials start -->
<section class="sectionpad contact-form-home fullwidth">
  <?php
      if(!empty($HomeImages) && count($HomeImages) > 0) {
        ?>
        
          <?php
          $img_path = 'home_images/';
          foreach($HomeImages as $hi){
            $hi_image = (isset($hi->image))?$hi->image:'';
            if(!empty($hi_image) && $storage->exists($img_path.$hi_image)){

              $link = '#';

              if(!empty($hi->link)){
                $link = $hi->link;
              }

              ?>
                <div class="enquire-img-home" style="background: url({{url('public/storage/'.$img_path.$hi_image)}}) center center no-repeat;"></div>
              <?php
            }
          }
          
          ?>
        
        <?php
      }
      ?>
    <div class="container">
      <div class="headings"><?php echo $HOME_HEADING_4; ?></div> 
      <div class="homeform">
         @include('components.includes._contact_form') 
      </div>    
    </div>
</section> 
<!-- Testimonials end -->
<div>
</div>
@slot('footerBlock')
<script type="text/javascript" src="{{asset('public/assets/themes/theme-1/js/magnificpopup/magnific-popup.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('public/assets/themes/theme-1/js/owl.carousel.min.js')}}"></script>  
<script>
  // $( ".dgsgs" ).click(function(e) {
  //   e.stopPropagation();
  //   if($(window).width() < 1023)
  //   {   
  //   $(this).next().fadeToggle();     
  //   }
  // }); 

  $('.banner').owlCarousel({
    loop:true,
    margin:20,
    items:1,
    dots:true,
    nav:false,   
    autoHeight:true,
  });

  $('.feature-product').owlCarousel({
    loop:false,
    margin:20,
    items:3,
    dots:false,
    nav:true,
    responsive:{
      0:{
        items:1, 
      },
      600:{
        items:2, 
      }, 
      1000:{
        items:4
      }
    }
  });
  $('.feature-blog').owlCarousel({
    loop:false,
    margin:20,
    items:3,
    dots:false,
    nav:true,
    responsive:{
      0:{
        items:1, 
      },
      600:{
        items:2, 
      }, 
      1000:{
        items:3
      }
    }
  });
</script>
<script type="text/javascript">
  // Video Popup
  jQuery('.inline-popup').magnificPopup({
    type:'inline',
    midClick: true 
  });
  jQuery('.inline-popup-team').magnificPopup({
    type:'inline',
    midClick: true 
  });
</script>
@endslot


@endcomponent