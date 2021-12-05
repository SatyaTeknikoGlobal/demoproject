@component('admin.layouts.main')

    @slot('title')
        Admin - {{ $page_heading }} - {{ config('app.name') }}
    @endslot

    @slot('headerBlock')

    <link rel="stylesheet" type="text/css" href="{{ url('public/css/jquery-ui.css') }}"/ >

    <link rel="stylesheet" type="text/css" href="{{ url('public/datetimepicker/jquery-ui-timepicker-addon.css') }}"/ >

    @endslot


    <?php

    //pr($blog->toArray());
    $routeName = CustomHelper::getAdminRouteName();

    $id = (isset($event->id))?$event->id:'';
    $title = (isset($event->title))?$event->title:'';
    $brief = (isset($event->brief))?$event->brief:'';
    $description = (isset($event->description))?$event->description:'';
    $sort_order = (isset($event->sort_order))?$event->sort_order:0;
    $meta_title = (isset($event->meta_title))?$event->meta_title:'';
    $meta_keyword = (isset($event->meta_keyword))?$event->meta_keyword:'';
    $meta_description = (isset($event->meta_description))?$event->meta_description:'';
    $featured = (isset($event->featured))?$event->featured:0;
    $status = (isset($event->status))?$event->status:1;
    $image = (isset($event->image))?$event->image:'';
    
    $start_date = (isset($event->start_date))?$event->start_date:'';
    $start_date = CustomHelper::DateFormat($start_date, 'd/m/Y');
    
    $end_date = (isset($event->end_date))?$event->end_date:'';
    $end_date = CustomHelper::DateFormat($end_date, 'd/m/Y');

    $storage = Storage::disk('public');

    //pr($storage);

    $path = 'events/';

    $old_image = 0;

    $image_req = 'required';
    $link_req = '';

    ?>

    <div class="row">

        <div class="col-md-12 bgcolor">

            <h2>{{ $page_heading }} <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
            
        <a href="{{ url($back_url)}}" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?>
    </h2>

            @include('snippets.errors')
            @include('snippets.flash')

            <div class="ajax_msg"></div>

            <form method="POST" action="" accept-charset="UTF-8" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="link_name" class="control-label required">Title:</label>

                            <input type="text" id="title" class="form-control" name="title" value="{{ old('title', $title) }}" />

                            @include('snippets.errors_first', ['param' => 'title'])
                        </div>
                    </div>
                
                
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('brief') ? ' has-error' : '' }}">
                            <label for="link_name" class="control-label">Description:</label>

                            <textarea id="brief" class="form-control " name="brief">{{ old('brief', $brief) }}</textarea>

                            @include('snippets.errors_first', ['param' => 'brief'])
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="link_name" class="control-label">Description:</label>

                            <textarea id="description" class="form-control " name="description">{{ old('description', $description) }}</textarea>

                            @include('snippets.errors_first', ['param' => 'description'])
                        </div>
                    </div>
                

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label for="start_date" class="control-label">Start Date:</label>
                            <input type="text" id="start_date" class="form-control date" name="start_date" value="{{ old('start_date', $start_date) }}" autocomplete="off" />

                            @include('snippets.errors_first', ['param' => 'start_date'])
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                        <label for="end_date" class="control-label">Start Date:</label>
                            <input type="text" id="end_date" class="form-control date" name="end_date" value="{{ old('end_date', $end_date) }}"  autocomplete="off" />

                            @include('snippets.errors_first', ['param' => 'end_date'])
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                            <label for="sort_order" class="control-label">Sort Order:</label>

                            <input type="text" id="sort_order" class="form-control" name="sort_order" value="{{ old('sort_order', $sort_order) }}" />

                            @include('snippets.errors_first', ['param' => 'sort_order'])
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('meta_title') ? ' has-error' : '' }}">
                            <label for="link_name" class="control-label">Mata Title:</label>

                            <input type="text" id="meta_title" class="form-control" name="meta_title" value="{{ old('meta_title', $meta_title) }}"  />

                            @include('snippets.errors_first', ['param' => 'meta_title'])
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                            <label for="link_name" class="control-label">Mata Keyword:</label>

                            <input type="text" id="meta_keyword" class="form-control" name="meta_keyword" value="{{ old('meta_keyword', $meta_keyword) }}"  />

                            @include('snippets.errors_first', ['param' => 'meta_keyword'])
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                            <label for="meta_description" class="control-label">Mata Description:</label>

                            <input type="text" id="meta_description" class="form-control" name="meta_description" value="{{ old('meta_description', $meta_description) }}"  />

                            @include('snippets.errors_first', ['param' => 'meta_description'])
                        </div>
                    </div>
                


                <?php
                $image_required = $image_req;
                if($id > 0){
                    $image_required = 'required';
                }
                ?>
                    <div class="col-md-12">

                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="sort_order" class="control-label {{ $image_required }}">Image:</label>

                                    <input type="file" id="image" name="image"/>

                                    @include('snippets.errors_first', ['param' => 'image'])
                                </div>
                                <?php
                                if(!empty($image)){
                                    if($storage->exists($path.$image))
                                    {
                                        ?>
                                        <div class="col-md-2 image_box">
                                           <img src="{{ url('public/storage/'.$path.'thumb/'.$image) }}" style="width: 100px;"><br>
                                           <a href="javascript:void(0)" data-id="{{ $id }}" class="del_image">Delete</a>
                                       </div>
                                       <?php        
                                   }

                                   ?>
                                   <?php
                               }
                               ?>

                           <input type="hidden" name="old_image" value="{{ $old_image }}">
                        
                 </div>


                
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} col-md-12">
                            <label class="control-label">Status:</label>
                            &nbsp;&nbsp;
                            Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> >
                            &nbsp;
                            Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                            @include('snippets.errors_first', ['param' => 'status'])
                        </div>

                        <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }} col-md-12">
                            <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
                                <label class="control-label ">Featured:</label>

                                <input type="checkbox" name="featured" value="1" <?php echo ($featured == '1')?'checked':''; ?> />

                                @include('snippets.errors_first', ['param' => 'featured'])
                            </div>
                        </div>
                
                
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p></p>
                                    <input type="hidden" id="id" class="form-control" name="id" value="{{ old('id', $id) }}"  />
                                    <button type="submit" class="btn btn-success" title="Create this new category"><i class="fa fa-save"></i> Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </form>
            <div class="clearfix"></div>
        </div>

    </div>




@slot('bottomBlock')

<script type="text/javascript" src="{{ url('public/js/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ url('public/datetimepicker/jquery-ui-timepicker-addon.js') }}"></script>

<script type="text/javascript" src="{{ url('public/js/ckeditor/ckeditor.js') }}"></script>


<script type="text/javascript">

$(document).ready(function(){

    $(".del_image").click(function(){

        var current_sel = $(this);

        var image_id = $(this).attr('data-id');

        conf = confirm("Are you sure to Delete this Image?");

        if(conf){

            var _token = '{{ csrf_token() }}';

            $.ajax({
                url: "{{ route($routeName.'.events.ajax_delete_image') }}",
                type: "POST",
                data: {image_id},
                dataType:"JSON",
                headers:{'X-CSRF-TOKEN': _token},
                cache: false,
                beforeSend:function(){
                   $(".ajax_msg").html("");
                },
                success: function(resp){
                    if(resp.success){
                        $(".ajax_msg").html(resp.msg);
                        current_sel.parent('.image_box').remove();
                    }
                    else{
                        $(".ajax_msg").html(resp.msg);
                    }
                    
                }
            });
        }

    });

});
    
$(document).ready(function(){

var editor = CKEDITOR.replace('brief');
var editor = CKEDITOR.replace('description');

$('.date').datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth: true,
    changeYear: true,
    yearRange:"1950:+0"
});

});
 </script>


@endslot

@endcomponent