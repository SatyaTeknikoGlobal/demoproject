<?php

$element_id = (isset($element->id))?$element->id:0;
$name = '';
$url = '';

$showRemoveBtn = (isset($showRemoveBtn))?$showRemoveBtn:false;


//echo $form_elements + 1;
?>

<div style="clear:both">
</div>
<div class="rowBox">

	<input type="hidden" name="form_element_ids[]" value="{{$element_id}}">
	
	<div class="col-md-3">
		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			<label class="control-label">Name:</label>
			<input type="text" name="name[]" value="{{$name}}" class="form-control" >

			@include('snippets.errors_first', ['param' => 'name'])
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
			<label class="control-label">URL:</label>
			<input type="text" name="url[]" value="{{$url}}" class="form-control" >

			@include('snippets.errors_first', ['param' => 'url'])
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
