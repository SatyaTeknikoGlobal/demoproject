<?php
$countheading = (isset($countheading))?$countheading:1;
$title = (isset($title))?$title:'';
$link = (isset($link))?$link:'';
$sort_order = (isset($sort_order))?$sort_order:'';
$featured = (isset($featured))?$featured:'';
$id = (isset($id))?$id:0;

$showRemoveBtn = (isset($showRemoveBtn))?$showRemoveBtn:false;
?>

<div class="row itemBox">

	<input type="hidden" name="ids[]" value="{{$id}}">
	
	<div class="col-md-3">
		<label>Title</label><br>
		<input class="form-control" type="text" name="title[]" value="{{$title}}" />
	</div>


	<div class="col-md-3">
		<label>Link (Embeded Code)</label><br> 
		<textarea class="form-control" name="link[]">{{$link}}</textarea>
	</div>

	<div class="col-md-2">
		<label>Sort Order</label><br>
		<input class="form-control" type="text" name="sort_order[]"  value="{{$sort_order}}">
	</div>

	<div class="col-md-1">
		<label>Featured</label><br> 
		<input  type="checkbox" name="featured[]" value="1" <?php echo ($featured == '1')?'checked':''; ?> />
	</div>

	<div class="col-md-3">
		<label>Action </label><br>
		<!-- <a href="javascript:void(0)" class="del_row delete_logo label label-danger delit-image">Remove</a> -->


	<?php
	if($countheading == 1 && !$showRemoveBtn){
		?>
		<a href="javascript:void(0)" class="add_row">Add</a>
		<?php
	}
	else{
		?>
		<a href="javascript:void(0)" class="remove_row">Remove</a>
		<?php
	}
	?>
</div>

</div>