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
  index-page
@endslot

<?php
$storage = Storage::disk('public');
$image = asset('public/assets/themes/theme-1/images/default-img.png');
if(!empty($cms['image']) && $storage->exists('cms_pages/'.$cms['image'])){
  $image = url('public/storage/cms_pages/'.$cms['image']);
}

$banner_image = asset('public/assets/themes/theme-1/images/default-img.png');
if(!empty($cms['banner_image']) && $storage->exists('cms_pages/'.$cms['banner_image'])){
  $banner_image = url('public/storage/cms_pages/'.$cms['banner_image']);
}
?>
<section class="fullwidth innerbanner" style="background: url('<?php echo $banner_image;?>') center center no-repeat;"></section>
<div class="breadcrumbs">
  <div class="container">
    <ul class="clearfix">
      <li><a href="{{url('/')}}">Home</a></li>  
      <li>{{$cms['title']}}</li>      
    </ul>
  </div>
</div>
<section class="sectionpad innerpage graybg fullwidth">
  <div class="container">
      <h1 class="headings headings-with-border text-center">{{$cms['title']}}</h1>
      <div class="row project-listing clearfix">
      <?php
      foreach ($cmsData as $cms){

        $storage = Storage::disk('public');
        $image = asset('public/assets/themes/theme-1/images/default-img.png');
        if(!empty($cms->image) && $storage->exists('cms_pages/thumb/'.$cms->image)){
          $image = url('public/storage/cms_pages/thumb/'.$cms->image);
        }
        ?>
        <div class="col-md-4">
          <div>
            <div class="imgsec" style="background:url(<?php echo $image; ?>);">
              <img src="<?php echo asset('public/assets/themes/theme-1/images/blankimg.png'); ?>" alt="{{$cms->name}}" />
            </div>
            <div class="project-box-wrapper">
              <h3 class="title">{{$cms->name}}</h3>
              <p><?php echo $cms->brief; ?></p>
              <a href="<?php echo url($cms->slug); ?>" class="cmsbox"><div class="read-more">Read More <i class="arrow-icon"></i></div></a>
            </div>
          </div>
        </div>
        <?php } ?>
    </div>
  </div>
  </div>
</section>

@slot('footerBlock')
@endslot


@endcomponent
