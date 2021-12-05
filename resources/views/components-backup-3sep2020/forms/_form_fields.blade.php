<?php
$pl_holder_val = '';
//prd($element->toArray());
$id = isset($element->id)?$element->id:0;
$data = isset($element->data)?$element->data:0;

$place_holder = '';

$old = old('');

if($place_holder)
{ 
    // pr($full_data); 
	$pl_holder_val=$full_data->field_label;
	if($full_data->validations=='required')
	{
		$pl_holder_val=$full_data->field_label."*";
	}
} 
    switch ($element->type){
    case 'text':
		?>
		<input type="text" placeholder="{{$pl_holder_val}}" class="form-control" name="input{{$id}}" value="{{old('input'.$id)}}"  />
		@include('snippets.errors_first', ['param' => 'input'.$id])
		<?php
		break;

	case 'textarea':
		?>
		<textarea placeholder="{{$pl_holder_val}}" class="form-control" name="input{{$id}}">{{old('input'.$id)}}</textarea>
		@include('snippets.errors_first', ['param' => 'input'.$id])
		<?php
		break;

	case 'number':
		?>
		<input type="number" min="0" placeholder="{{$pl_holder_val}}" class="form-control" name="input{{$id}}" value="{{old('input'.$id)}}"  />
		@include('snippets.errors_first', ['param' => 'input'.$id])
		<?php
		break;

	case 'file':
		?>
		<input type="file" class="form-control" name="input{{$id}}" value="{{old('input'.$id)}}"  />
		<input type="hidden" name="input{{$id}}" />
		@include('snippets.errors_first', ['param' => 'input'.$id])
		<?php
		break;

		case 'select':
		?>
		<select class="form-control" name="input{{$id}}">
			<option value="">Please Select</option>
			<?php
			$selectVal = old('input'.$id);
			if(!empty($data)){
				$selectData = explode(',', $data);
				foreach($selectData as $val){

					$val = trim($val);
					
					$selected = '';
					if($selectVal == $val){
						$selected = 'selected';
					}
					?>
					<option value="{{$val}}" {{$selected}}>{{$val}}</option>
			<?php }
			}
			?>
			
		</select>

		@include('snippets.errors_first', ['param' => 'input'.$id])

		<?php
		break;

	case 'checkbox':
		//prd($data);
		$checkedVal = old('input'.$id);
		if(!is_array($checkedVal)){
			$checkedVal = [];
		}
		//pr($checkedVal);
		//$checkbox_data = explode(',', $data);
		if(!empty($data)){
			$checkboxtData = explode(',', $data);
			foreach($checkboxtData as $ckd){

				$ckd = trim($ckd);

				$checked = '';
				if(in_array($ckd, $checkedVal)){ 
					$checked = 'checked';
				}
				?>
				<input type="checkbox" name="input{{$id}}[]" value="{{$ckd}}" {{$checked}} >
				<?php echo $ckd.'&nbsp;&nbsp;';
			} 
		} ?>

		@include('snippets.errors_first', ['param' => 'input'.$id])

		<?php
		break;

		case 'radio':
		$checkedVal = old('input'.$id);

		$radioData = explode(',', $data);
		//pr($checkedVal);
		if(!empty($radioData)){
			foreach($radioData as $rd){

				$rd = trim($rd);
				$checked = '';
				if($rd == $checkedVal){
					$checked = 'checked';
				} 
				?>
				<input type="radio" name="input{{$id}}" value="{{$rd}}" {{$checked}}>
				<?php
				echo $rd.'&nbsp;&nbsp;';
			}
		}
		break;

	/*case 'select':

		echo '<select class="form-control" name="input'.$id.'">';
		$select_data = explode(',', $data);
		if(!empty($select_data)){ foreach($select_data as $sd){
			if( $sd == $old){ $selected = 'selected';}else{ $selected = '';}
		echo '<option value="'.$sd.'" '.$selected.' >'.$sd.'</option>';
		} }		
		echo '</select>';
		break;

	case 'checkbox':
		$checkbox_data = explode(',', $data);
		if(!empty($checkbox_data)){ foreach($checkbox_data as $cd){
			if( $cd == $old){ $checked = 'checked';}else{ $checked = '';}
		echo '<input type="checkbox" name="input'.$id.'[]" value="'.$cd.'" '.$checked.' > '; 
		echo $cd.'&nbsp;&nbsp;';
		} }
		break;
	case 'radio':
		$radio_data = explode(',', $data);
		if(!empty($radio_data)){ foreach($radio_data as $rd){
			if( $rd == $old){ $checked = 'checked';}else{ $checked = '';}
		echo '<input type="radio" name="input'.$id.'" value="'.$rd.'" '.$checked.' > '; 
		echo $rd.'&nbsp;&nbsp;';
		} }
		break; */
	case 'datepicker':
		?>
		<input type="text" class="form-control datepicker" name="input{{$id}}" value="{{old('input'.$id)}}" readonly />
		<?php
		break;
	case 'timepicker':
	    ?>
		<input type="text" class="form-control timepicker" name="input{{$id}}" value="{{old('input'.$id)}}" />'
		<?php
		break;	
	default:
		# code...
		break;
}
/*echo '<?php echo form_error(\'id'.$id.'\'); ?>';*/
?>