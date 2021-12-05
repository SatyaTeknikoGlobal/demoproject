@component('admin.layouts.main')

    @slot('title')
        Admin - {{ $page_heading }} - {{ config('app.name') }}
    @endslot

    @slot('headerBlock')
    <style type="text/css">
        body.dragging, body.dragging * {
          cursor: move !important;
      }

      .dragged {
          position: absolute;
          opacity: 0.5;
          z-index: 2000;
      }

      ol.example li.placeholder {
          position: relative;
          /** More li styles **/
      }
      ol.example li.placeholder:before {
          position: absolute;
          /** Define arrowhead **/
      }
  </style>
    @endslot


    <?php 
    //prd($form);
    $templates = CustomHelper::getTemplates('forms');

    $id = (isset($form->id))?$form->id:'';

    $title = (isset($form->title))?$form->title:'';

    $name = (isset($form->title))?$form->name:'';
    $thank_you_msg = (isset($form->thank_you_msg))?$form->thank_you_msg:'';  
    $google_map = (isset($form->google_map))?$form->google_map:'';  
    $lat_lang = (isset($form->lat_lang))?$form->lat_lang:'';  
    $top_left_content = (isset($form->top_left_content))?$form->top_left_content:'';  
    $top_right_content = (isset($form->top_right_content))?$form->top_right_content:'';  
    $bottom_content = (isset($form->bottom_content))?$form->bottom_content:'';  
    $template = (isset($form->template))?$form->template:'';
    $captcha = (isset($form->captcha))?$form->captcha:'';
    $status = (isset($form->status))?$form->status:1;
   
    $storage = Storage::disk('public');
    $routeName = CustomHelper::getAdminRouteName();

    $ii = 0;

    ?>
 
 <h2>{{ $page_heading }} <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
        <a href="{{ url($back_url)}}" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?></h2>

        <div class="bgcolor">

            @include('snippets.errors')
            @include('snippets.flash')

            <div class="ajax_msg"></div>

            <form method="POST" action="" accept-charset="UTF-8" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label required">Title:</label>

                            <input type="text" name="title" value="{{ old('title', $title) }}" class="form-control"  />

                            @include('snippets.errors_first', ['param' => 'title'])
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                            <label for="position" class="control-label required">Position:</label>

                            <br>

                            Top <input type="radio" name="position">
                            <br>
                            Bottom <input type="radio" name="position">

                            @include('snippets.errors_first', ['param' => 'position'])
                        </div>
                    </div>

                </div>


                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label class="control-label">Status:</label>
                    &nbsp;&nbsp;
                    Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> >
                    &nbsp;
                    Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                    @include('snippets.errors_first', ['param' => 'status'])
                </div>

                <div class="row rowBox">

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label">Name:</label>
                            <input type="text" name="name[]"  class="form-control" >

                            @include('snippets.errors_first', ['param' => 'name'])
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label class="control-label">URL:</label>
                            <input type="text" name="url[]"  class="form-control" >

                            @include('snippets.errors_first', ['param' => 'url'])
                        </div>
                    </div>

                    <div class="col-md-1">
                        <br><br>
                        <a href="javascript:void(0)" class="add_item">+ Add</a>
                    </div>

                </div>



                <!-- Fix Forms Field -->

                <h2>Menu Items:</h2>

                <div class="input_box">

                    <ol class='example itemsBox'>

                        <!-- <li>First
                        <ol></ol>
                        </li>

                        <li>Second
                        <ol></ol>
                        </li>

                        <li>Third
                        <ol></ol>
                        </li> -->

                    </ol>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <p></p>
                            <input type="hidden" id="id" class="form-control" name="id" value="{{ old('id', $id) }}"  />
                            <button type="submit" class="btn btn-success" title="Create this new category"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </div>
                </div>

            </form>
            <div class="clearfix"></div>
        </div>



@slot('bottomBlock')

<script type="text/javascript" src="{{asset('public/js/jquery-sortable.js')}}"></script>

<script type="text/javascript">
    $(function(){
        $("ol.example").sortable();
    });

    $(".add_item").click(function(){
        var name = $(this).parents('.rowBox').find("input[name='name[]']").val();
        var url = $(this).parents('.rowBox').find("input[name='url[]']").val();
        
        if(name && name != '' && url && url != ''){

            var row = '';

            row += '<li>';
            row += name;

            row += '<ol>';
            row += '</ol>';

            row += '</li>';

            $(".itemsBox").append(row);
        }
    });

</script>

@endslot
 

@endcomponent