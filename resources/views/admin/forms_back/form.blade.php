@component('admin.layouts.main')

    @slot('title')
        Admin - {{ $page_heading }} - {{ config('app.name') }}
    @endslot


    <?php 
    //prd($form);
    $templates = CustomHelper::getTemplates('forms');

    $id = (isset($form->id))?$form->id:'';
    $name = (isset($form->name))?$form->name:'';  
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
    //pr($storage);



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
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label required">Name:</label>

                            <input type="text" id="name" data-validation="required length" data-validation-length="3-128"  class="form-control" name="name" value="{{ old('name', $name) }}" />

                            @include('snippets.errors_first', ['param' => 'name'])
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('subtitle') ? ' has-error' : '' }}">
                            <label for="thank_you_msg" class="control-label">Thank You Message:</label>

                            <input type="text" id="thank_you_msg" class="form-control" name="thank_you_msg" data-validation="required length" data-validation-length="3-128" value="{{ old('thank_you_msg', $thank_you_msg) }}" />

                            @include('snippets.errors_first', ['param' => 'thank_you_msg'])
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('lat_lang') ? ' has-error' : '' }}">
                            <label for="lat_lang" class="control-label">Use Google Map:</label>

                            <input type="checkbox" name="use_google_map" value="1" <?php if($google_map == '1'){ echo 'checked'; }?> > Active

                            <input type="text" id="lat_lang" class="form-control" name="lat_lang" value="{{ old('lat_lang', $lat_lang) }}" placeholder="28.591814,77.333602" />

                            @include('snippets.errors_first', ['param' => 'lat_lang'])
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                            <label for="sort_order" class="control-label">Top Left Content:</label>
                            <a href="javascript:void(0);" id="left_content_link"><i title="Show Content" class="fa fa-fw fa-plus-circle"></i></a> 

                            <span id="left_content_field" style="display:none1;">
                              <textarea class="form-control" name="top_left_content">{{ old('top_left_content', $top_left_content) }}</textarea>
                          </span>

                          @include('snippets.errors_first', ['param' => 'sort_order'])
                      </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group{{ $errors->has('right_content_link') ? ' has-error' : '' }}">
                        <label for="right_content_link" class="control-label">Top Right Content:</label>
                        <a href="javascript:void(0);" id="right_content_link"><i title="Show Content" class="fa fa-fw fa-plus-circle"></i></a> 

                        <span id="right_content_field" style="display:none1;">
                          <textarea class="form-control" name="top_right_content">{{ old('top_right_content', $top_right_content) }}</textarea>
                      </span>

                      @include('snippets.errors_first', ['param' => 'top_right_content'])
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
                    <label for="bottom_content" class="control-label">Bottom Content:</label>
                    <a href="javascript:void(0);" id="bottom_content"><i title="Show Content" class="fa fa-fw fa-plus-circle"></i></a> 

                    <span id="bottom_content_field" style="display:none1;">
                      <textarea class="form-control" name="bottom_content">{{ old('bottom_content', $bottom_content) }}</textarea>
                  </span>

                  @include('snippets.errors_first', ['param' => 'bottom_content'])
              </div>
          </div>

          <div class="form-group  col-md-4{{ $errors->has('template') ? ' has-error' : '' }}">
            <label for="template" class="control-label">Tempalate:</label>

            <select class="form-control" name="template">
                <option value="">Select</option>
                <?php
                
                if(!empty($templates) && count($templates) > 0){
                    foreach ($templates as $tKey => $tVal){
                        $selected = '';
                        if($template == $tKey){
                            $selected = 'selected';
                        }
                        ?>
                        <option value="{{$tKey}}" {{$selected}}>{{$tVal}}</option>
                        <?php
                    }
                }
                ?>
            </select>
            @include('snippets.errors_first', ['param' => 'template'])
        </div>



        <div class="col-md-6">
            <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                <label for="captcha" class="control-label">Captcha:</label>
                <select name="captcha" class="form-control">
                    <option value="">Select</option>
                    <option value="1" <?php if($captcha == 1) { echo 'selected';} ?>>Enable</option>
                    <option value="0" <?php if($captcha == 0) { echo 'selected';} ?>>Disable</option>
                </select>

                @include('snippets.errors_first', ['param' => 'captcha'])
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



<!-- Fix Forms Field -->
 
<h2>Form Fields:</h2>

  <a href="javascript:void(0);" class="btn bluebg btn-info add_head_row" style='float: right;'><i class="fa fa-plus-circle"></i> Add Element</a>
  <div style="clear:both">
  </div>

<?php
$ii = 0;
if(!empty($form_elements)){/*

   $ii = 0;
   foreach($form_elements as $fe) {
     $notUpdate = false;
     
     if($ii <= 2 ){
         $notUpdate = true;
     }
?>
    <div class="col-md-3">
        <div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
            <label for="bottom_content" class="control-label">Field Label:</label>
            <input type="text" name="field_label[<?php echo $ii;?>]" id="field_input_<?php echo $ii;?>" class="form-control" value="<?php echo $fe->field_label;?>" <?php if($notUpdate) { echo 'readonly';   } ?>>

            <input type="hidden" name="input_num[]" value="<?php echo $ii; ?>">
            <input type="hidden" name="fe_id[<?php echo $ii;?>]" value="<?php echo $fe->id; ?>">

            @include('snippets.errors_first', ['param' => 'field_label['.$ii.']'])
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
            <label for="bottom_content" class="control-label">Field Type:</label>
            
            <select class="form-control" name="field_type[]">
                <?php
                $field_type = $fe->field_type;
                if(!empty($form_attribute)){
                    foreach($form_attribute as $fa){
                        $selected = '';
                        if($fe->field_type == $fa->id){
                            $selected = 'selected';
                        }
                        $isDisble = '';
                        if($notUpdate && ($fe->field_type != $fa->id)){
                            $isDisble = 'disabled';
                        }
                        ?>
                <option value="{{$fa->id}}" {{$selected}} {{$isDisble}}>{{$fa->label}}</option>
                        <?php }
                    }
                    ?>
            </select>
            @include('snippets.errors_first', ['param' => 'field_type['.$ii.']'])
        </div>
    </div>

     <div class="col-md-3">
        <div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
            <label for="bottom_content" class="control-label">Validations:</label>
            <select class="form-control" name="validations[<?php echo $ii; ?>]">
                <option value="required" <?php if($fe->validations == 'required'){ echo 'selected';} ?> >Required</option>
            </select>
            @include('snippets.errors_first', ['param' => 'validations['.$ii.']'])
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
            <label for="bottom_content" class="control-label">Data:</label>
            <input type="text" name="data[<?php echo $ii; ?>]" class="form-control" value="{{$fe->data}}">

            @include('snippets.errors_first', ['param' => 'data['.$ii.']'])
        </div>
    </div>

    <?php
    if($ii > 2){ ?>
    <a href="javascript:void(0);" onClick="remove_elements('<?php echo $ii; ?>');">X</a>
    <?php } ?>
    <?php $ii++;
}
*/}
?>
<div class="input_box">

    <?php
    if(!empty($formElements) && count($formElements) > 0){
        foreach($formElements as $fe){

            //prd($fe);

            $showRemoveBtn = true;

            if($fe->is_static == '1'){
                $showRemoveBtn = false;
            }

            $input_params = [];
            $input_params['ii'] = $ii;
            $input_params['element'] = $fe;
            $input_params['form_attribute'] = $form_attribute;
            $input_params['showRemoveBtn'] = $showRemoveBtn;
            ?>
            @include('admin.forms._input_row', $input_params)
            <?php
        }
    }
    ?>

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
 

@endcomponent

<?php

$pattern = '/\n*/m';
$replace = '';
$input_params = [];
$input_params['ii'] = $ii;
$input_params['form_attribute'] = $form_attribute;
$input_params['showRemoveBtn'] = true;
$input_row_html = view('admin.forms._input_row', $input_params)->render();
$input_row = preg_replace( $pattern, $replace, $input_row_html);
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate();
$(".add_head_row").click(function(){

    var rowBox_len = $(".rowBox").length;

    if(rowBox_len+1 > 10){
        alert('Maximum 10 Attributes are allowed.');
    }
   else{
        var input_row = '<?php echo $input_row; ?>';
        //alert(attr_row);
        $(".input_box").append(input_row);
    }
});

    $(document).on("click",".remove_head_row", function(){

        var currSelector = $(this);

        var form_element_id = currSelector.parents(".rowBox").find("input[name='form_element_ids[]']").val();

        form_element_id = parseInt(form_element_id);

        //alert(form_element_id);

        if(!isNaN(form_element_id) && form_element_id > 0){

            var conf = confirm("Are you sure to delete this record permanently?");

            if(!conf){
                return false;
            }

            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route($routeName.'.forms.ajax_delete_element') }}",
                type: "POST",
                data: {form_element_id:form_element_id},
                dataType:"JSON",
                headers:{'X-CSRF-TOKEN': _token},
                cache: false,
                beforeSend:function(){

                },
                success: function(resp){
                    if(resp.success){
                        currSelector.parents(".rowBox").remove();
                    }
                }
            });
        }
        else{
           currSelector.parents(".rowBox").remove();
        }

    });


$(document).ready(function(){

   /* $('#left_content_link').click(function(){
        $("#left_content_field").toggle();
    });

    $('#right_content_link').click(function(){
        $("#right_content_field").toggle();
    });

    $('#bottom_content').click(function(){
        $("#bottom_content_field").toggle();
    });*/

    $(".del_image").click(function(){

        var current_sel = $(this);

        var image_id = $(this).data('id');

        conf = confirm("Are you sure to Delete this Home Image?");

        if(conf){

            var _token = '{{ csrf_token() }}';

            $.ajax({
                url: "{{ route($routeName.'.home_images.ajax_delete_image') }}",
                type: "POST",
                data: {image_id:image_id},
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
</script>