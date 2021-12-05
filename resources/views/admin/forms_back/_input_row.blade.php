<?php

$element_id = (isset($element->id))?$element->id:0;
$is_static = (isset($element->is_static))?$element->is_static:0;
$label = (isset($element->label))?$element->label:'';
$type = (isset($element->type))?$element->type:'';
$validation = (isset($element->validation))?$element->validation:'';

$readonly = '';
$disabled = '';

if($is_static == '1'){
	$readonly = 'readonly';
	$disabled = 'disabled';
}

$showRemoveBtn = (isset($showRemoveBtn))?$showRemoveBtn:false;


//echo $form_elements + 1;
?>

<div style="clear:both">
</div>
<div class="rowBox">

	<input type="hidden" name="form_element_ids[]" value="{{$element_id}}">
	<input type="hidden" name="is_static[]" value="{{$is_static}}">
	
	<div class="col-md-3">
		<div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
			<label for="bottom_content" class="control-label">Field Label:</label>
			<input type="text" name="field_label[]" value="{{$label}}" id="field_input_<?php echo $ii;?>" class="form-control" {{$readonly}} >

			@include('snippets.errors_first', ['param' => 'field_label'])
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
			<label for="bottom_content" class="control-label">Field Type:</label>

			<select class="form-control" name="field_type[]" {{$disabled}} >
				<?php
				
				if(!empty($form_attribute)){
					foreach($form_attribute as $fa){
						$selected = '';
						if($fa->type == $type){
							$selected = 'selected';
						}
						?>
						<option value="{{$fa->type}}" {{$selected}}>{{$fa->label}}</option>
						<?php
					}
				}
				?>
			</select>
			<?php
			if($is_static == '1'){
				?>
				<input type="hidden" name="field_type[]" value="{{$type}}">
				<?php
			}
			?>
			@include('snippets.errors_first', ['param' => 'field_type'])
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
			<label for="bottom_content" class="control-label">Validations:</label>
			<select class="form-control" name="validations[]">
				<option value="required" <?php //if($fe->validations == 'required'){ echo 'selected';} ?> >Required</option>
			</select>
			@include('snippets.errors_first', ['param' => 'validations['.$ii.']'])
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group{{ $errors->has('bottom_content') ? ' has-error' : '' }}">
			<label for="bottom_content" class="control-label">Data:</label>
			<input type="text" name="data[]" class="form-control" value="">

			@include('snippets.errors_first', ['param' => 'data['.$ii.']'])
		</div>
	</div>

	<div class="col-md-1">
		<br><br>
		<?php
		if($showRemoveBtn){
			?>
			<a href="javascript:void(0)" class="remove_head_row">X</a>
			<?php
		}
		?>
	</div>

</div>
