@component('admin.layouts.main')

@slot('title')
Admin - {{ $page_heading }} - {{ config('app.name') }}
@endslot


<?php

$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
$routeName = CustomHelper::getAdminRouteName();

if(empty($back_url)){
    $back_url = $routeName.'/testimonials';
}

$name = (isset($testimonial->name))?$testimonial->name:'';
$location = (isset($testimonial->location))?$testimonial->location:'';
$description = (isset($testimonial->description))?$testimonial->description:'';
$image = (isset($testimonial->image))?$testimonial->image:'';
$date_on = (isset($testimonial->date_on))?$testimonial->date_on:'';
$featured = (isset($testimonial->featured))?$testimonial->featured:1;
$status = (isset($testimonial->status))?$testimonial->status:1;

$date_on = CustomHelper::DateFormat($date_on, 'd/m/Y');

$path = 'testimonials/';
$thumb_path = 'testimonials/thumb/';
$storage = Storage::disk('public');

?>

<div class="row">

    <div class="col-md-12">

        <h2>{{ $page_heading }}
            <a href="{{ url($back_url) }}" class="btn btn-sm btn-success pull-right">Back</a>
        </h2>

        @include('snippets.errors')
        @include('snippets.flash')

        <div class="bgcolor">

            <form method="POST" action="" accept-charset="UTF-8" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label required">Name:</label>

                            <input type="text" name="name" class="form-control" value="{{ old('name', $name) }}" />

                            @include('snippets.errors_first', ['param' => 'name'])
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label class="control-label">Location:</label>

                            <input type="text" name="location" class="form-control" value="{{ old('location', $location) }}" />

                            @include('snippets.errors_first', ['param' => 'location'])
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label required">Description:</label>

                            <textarea name="description" class="form-control" >{{ old('description', $description) }}</textarea>

                            @include('snippets.errors_first', ['param' => 'description'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label">Image:</label>

                            <input type="file" name="image" />

                            @include('snippets.errors_first', ['param' => 'image'])
                        </div>

                        <?php
                        $imgSrc = '';
                        $imgUrl = 'javascript:void(0)';
                        if(!empty($image)){
                            if($storage->exists($thumb_path.$image)){
                               $imgSrc = asset('public/storage/'.$thumb_path.$image);
                            }
                            if($storage->exists($path.$image)){
                                $imgUrl = asset('public/storage/'.$path.$image);

                                if(empty($imgSrc)){
                                    $imgSrc =  $imgUrl;
                                }

                            }
                            else{
                                $imgUrl =  $imgSrc;
                            }
                        }

                        if(!empty($imgSrc)){
                            ?>
                            <div class="imgBox">
                                <a href="{{$imgUrl}}" target="_blank">
                                    <img src="{{$imgSrc}}" style="width:100px;" >
                                </a>

                                <a href="javascript:void(0)" data-id="{{$testimonial->id}}" class="delImg">Delete</a>

                                <br><br>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('date_on') ? ' has-error' : '' }}">
                            <label class="control-label required">Date on:</label>

                            <input type="text" name="date_on" class="form-control date_on" value="{{ old('date_on', $date_on) }}" readonly />

                            @include('snippets.errors_first', ['param' => 'date_on'])
                        </div>
                    </div>
                </div>


                 <div class="row">
                    <div class="col-md-6">
                        <br>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label">Status:</label>
                            &nbsp;&nbsp;
                            Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> >
                            &nbsp;
                            Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                            @include('snippets.errors_first', ['param' => 'status'])
                        </div>
                    </div>

                </div>


                <div class="row">

                    <?php /*
                    <div class="col-md-6">
                        <br>
                        <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
                            <label class="control-label">Featured:</label>
                            &nbsp;&nbsp;
                            Active: <input type="radio" name="featured" value="1" <?php echo ($featured == '1')?'checked':''; ?> >
                            &nbsp;
                            Inactive: <input type="radio" name="featured" value="0" <?php echo ( strlen($featured) > 0 && $featured == '0')?'checked':''; ?> >

                            @include('snippets.errors_first', ['param' => 'featured'])
                        </div>
                    </div> */ ?>

                    <div class="col-sm-12">

                        <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
                            <label class="control-label ">Featured:</label>

                            <input type="checkbox" name="featured" value="1" <?php echo ($featured == '1')?'checked':''; ?> />

                            @include('snippets.errors_first', ['param' => 'featured'])
                        </div>
                    </div>
                </div>

               

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" title="Create this new category"><i class="fa fa-save"></i> Save</button>
                            <a href="{{ url($back_url) }}" class="btn btn-primary" style="padding: 10px 17px;">Cancel</a>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>



@slot('bottomBlock')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( ".date_on" ).datepicker({
            'dateFormat':'dd/mm/yy',
            changeMonth:true,
            changeYear:true,
            yearRange:"1950:0+"
        });
    });

    $(".delImg").click(function(){
        var conf = confirm('Are you sure to delete this Image?');

        if(conf){

            var currSelector = $(this);

            var id = $(this).data("id");

            var _token = '{{ csrf_token() }}';

            $.ajax({
                url: "{{ route($routeName.'.testimonials.ajax_delete_image') }}",
                type: "POST",
                data: {id:id},
                dataType:"JSON",
                headers:{'X-CSRF-TOKEN': _token},
                cache: false,
                beforeSend:function(){
                    $(".ajax_msg").html("");
                },
                success: function(resp){
                    if(resp.success){
                        currSelector.parent(".imgBox").remove();
                    }

                }
            });
        }
    });
</script>

@endslot

@endcomponent