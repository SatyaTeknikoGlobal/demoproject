@component('admin.layouts.main')

@slot('title')
Admin - {{ $page_heading }} - {{ config('app.name') }}
@endslot


<?php

$routeName = CustomHelper::getAdminRouteName();

$id = (isset($menu->id))?$menu->id:'';
$title = (isset($menu->title))?$menu->title:'';  
$position = (isset($menu->position))?$menu->position:''; 

$status = (isset($menu->status))?$menu->status:1;

$positionArr = ['top'=>'Top', 'bottom'=>'Bottom'];


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

					<select name="position" class="form-control">
						<?php
						if(!empty($positionArr) && count($positionArr) > 0){
							foreach($positionArr as $pKey=>$pVal){
								$selected = '';
								if($pKey == $position){
									$selected = 'selected';
								}
								?>
								<option value="{{$pKey}}" {{$selected}} >{{$pVal}}</option>
								<?php
							}
						}
						?>
					</select>

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



		<div class="row">
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



@slot('bottomBlock')

@endslot


@endcomponent