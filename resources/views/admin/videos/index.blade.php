@component('admin.layouts.main')

@slot('title')
Admin - {{ $page_heading }} - {{ config('app.name') }}
@endslot

<script type="text/javascript" src="{{url('public/js/jquery.min.js')}}"></script>

<section class="content-header">
  <h1 class="page_title">
    Videos
    <!-- <a class="btn btn-sm btn-success pull-right add_head_row"  href="javascript:void(0);">&nbsp; Add more videos</a> -->
  </h1>
  <div class="clearfix"></div>
</section>

<?php
$vid = (request('vid'))?request('vid'):0;
$tbl = (request('tbl'))?request('tbl'):'';
$routeName = CustomHelper::getAdminRouteName();
?>

<form method="POST" name="videoForm" id="videoForm" enctype="multipart/form-data" accept-charset="UTF-8" role="form" >
    
    {{ csrf_field() }}

     <div class="clear"></div>
     <div id="queue"></div>
      <div class="form-label-clear"></div>

      <div class="bgcolor">
        <div class="col-md-12 attributes_box" id="file_list">

          <?php
          //prd($videos);
          $countheading = 1;
          if(!empty($videos) && count($videos) > 0){

            foreach($videos as $attr_key=>$video){

              //$video = (isset($video[$attr_key]))?$video[$attr_key]:'';

              $video_params = [];
              $video_params['countheading'] = $countheading;
              $video_params['title'] = $video->title;
              $video_params['link'] = $video->link;
              $video_params['sort_order'] = $video->sort_order;
              $video_params['featured'] = $video->featured;
              $video_params['id'] = $video->id;
              ?>

              @include('admin.videos._row', $video_params)

              <?php

              $countheading++;
            }
          }
          if($countheading <= 1){

            $video_params = [];
            $video_params['countheading'] = $countheading;
            ?>

            @include('admin.videos._row', $video_params)

            <?php
          }
          ?>
        </div>
        <div class="clearfix"></div><br>

        <input type="hidden" name="tbl" value="{{$tbl}}">
        <input type="hidden" name="vid" value="{{$vid}}">
        <input type="button" name="btn-submit" class="btn btn-success btn-submit sbmtBtn" value="Submit">
      </div>
  </form>
<!-- </section> -->

<?php

$pattern = '/\n*/m';
$replace = '';

$video_params = [];
$video_params['countheading'] = (isset($countheading))?$countheading:1;
$video_params['showRemoveBtn'] = true;

$attr_row_html = view('admin.videos._row', $video_params);

$attr_row = preg_replace( $pattern, $replace, $attr_row_html);
?>

@slot('bottomBlock')

<script type="text/javascript">

  $(".add_row").click(function(){
    var rowLen = $(".itemBox").length;

    if(rowLen+1 > 10){
      alert('Maximum 10 Rows are allowed.');
    }
    else{

      var attr_row = '<?php echo $attr_row; ?>';

      $(".attributes_box").append(attr_row);
    }
  });

  $(document).on("click",".remove_row", function(){
    var currSelector = $(this);
    //$(this).parents(".itemBox").remove();
    var video_id = $(this).parents(".itemBox").find("input[name='ids[]']").val();

    video_id = parseInt(video_id);

    if(!isNaN(video_id) && video_id > 0){

      var _token = '{{ csrf_token() }}';
      $.ajax({
        url: "{{ url($routeName.'/videos/ajax_delete') }}",//ajaxDelete
        type: "POST",
        data: {video_id:video_id},
        dataType:"JSON",
        headers:{'X-CSRF-TOKEN': _token},
        cache: false,
        beforeSend: function () {},
        success: function(resp){
          if(resp.success){
            currSelector.parents(".itemBox").remove();
          }
        }
      });

    }
    else{
      currSelector.parents(".itemBox").remove();
    }

    //alert(video_id);
  });

  $(document).on("click",".sbmtBtn", function(e){
    e.preventDefault();
    submitForm();
  });


  function submitForm(){
    var formData = $('#videoForm').serialize();
    
    //alert(formData); return false;

    var _token = '{{ csrf_token() }}';
    $.ajax({
      url: "{{ url($routeName.'/videos/ajax_save') }}",
      type: "POST",
      data: formData,
      dataType:"JSON",
      headers:{'X-CSRF-TOKEN': _token},
      cache: false,
      beforeSend: function () {},
      success: function(resp){
        if(resp.success){
          window.location.reload();
        }
      }
    });
  }

</script>

@endslot

@endcomponent

