@component('admin.layouts.main')

@slot('title')
Admin - {{ $page_heading }} - {{ config('app.name') }}
@endslot


<?php

$routeName = CustomHelper::getAdminRouteName();

$backUrl = CustomHelper::BackUrl();

$back_url = (request()->has('back_url') )?request()->back_url:'';
//pr($back_url);

$id = (isset($menu->id))?$menu->id:'';

$menuItemId = (isset($menuItem->id))?$menuItem->id:'';
$title = (isset($menuItem->title))?$menuItem->title:'';  

$link_type = (isset($menuItem->link_type))?$menuItem->link_type:'';
$page_id = (isset($menuItem->page_id))?$menuItem->page_id:'';
$url = (isset($menuItem->url))?$menuItem->url:'';
$target = (isset($menuItem->target))?$menuItem->target:'';

$status = (isset($menuItem->status))?$menuItem->status:1;

$menu_link_type_arr = config('custom.menu_link_type_arr');

$targetArr = ['_self'=>'Same Window/Tab', '_blank'=>'New Window/Tab'];

//pr($menu_link_type_arr);

//pr($menuItem->toArray());


$menuItems = (isset($menu->menuParentItems))?$menu->menuParentItems:'';

$menuItemsList = CustomHelper::getMenuItemsList($menuItems, $id, $is_parent=true, 'sortable_menu', 'sortable');
//prd($menuItemsList);


//$backUrl = rawurlencode($backUrl.$back_url);

?>

<h2>{{ $page_heading }} <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
<a href="{{ url($back_url)}}" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?></h2>

<div class="bgcolor">

	@include('snippets.errors')
	@include('snippets.flash')

	<div class="ajax_msg"></div>

	<form method="POST" action="" accept-charset="UTF-8" role="form" enctype="multipart/form-data">
		{{ csrf_field() }}

		<input type="hidden" name="back_url" value="{{$backUrl}}">


		<div class="row">

			<div class="col-md-3">
				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<label for="title" class="control-label required">Title:</label>

					<input type="text" name="title" value="{{ old('title', $title) }}" class="form-control"  />

					@include('snippets.errors_first', ['param' => 'title'])
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group{{ $errors->has('link_type') ? ' has-error' : '' }}">
					<label for="link_type" class="control-label required">Link Type:</label>

					<select name="link_type" class="form-control">
						<?php
						if(!empty($menu_link_type_arr) && count($menu_link_type_arr) > 0){
							foreach($menu_link_type_arr as $ltKey=>$ltVal){
								$selected = '';
								if($ltKey == $link_type){
									$selected = 'selected';
								}
								?>
								<option value="{{$ltKey}}" {{$selected}} >{{$ltVal}}</option>
								<?php
							}
						}
						?>
					</select>

					@include('snippets.errors_first', ['param' => 'link_type'])
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group{{ $errors->has('page_id') ? ' has-error' : '' }}">
					<label for="page_id" class="control-label required">Please select:</label>

					<div class="pageBox">
						<input type="text" name="page_id" value="{{ old('page_id', $page_id) }}" class="form-control"  />
					</div>

					@include('snippets.errors_first', ['param' => 'page_id'])
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
					<label for="url" class="control-label required">URL:</label>

					<input type="text" name="url" value="{{ old('url', $url) }}" class="form-control"  />

					@include('snippets.errors_first', ['param' => 'url'])
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group{{ $errors->has('target') ? ' has-error' : '' }}">
					<label for="target" class="control-label required">Target:</label>

					<select name="target" class="form-control">
						<?php
						if(!empty($targetArr) && count($targetArr) > 0){
							foreach($targetArr as $tKey=>$tVal){
								$selected = '';
								if($tKey == $target){
									$selected = 'selected';
								}
								?>
								<option value="{{$tKey}}" {{$selected}} >{{$tVal}}</option>
								<?php
							}
						}
						?>
					</select>

					@include('snippets.errors_first', ['param' => 'target'])
				</div>
			</div>

			<div class="col-md-3">

				<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
					<label class="control-label">Status:</label>
					<br>
					&nbsp;&nbsp;
					Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> >
					&nbsp;
					Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

					@include('snippets.errors_first', ['param' => 'status'])
				</div>
			</div>


		</div>







		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<p></p>
					<input type="hidden" id="id" class="form-control" name="id" value="{{ old('id', $id) }}"  />
						<button type="submit" class="btn btn-success" ><i class="fa fa-save"></i> Submit</button>
					<?php
					if(is_numeric($menuItemId) && $menuItemId > 0){
						?>
						<a href="{{url($routeName.'/menus/items/'.$menu->id)}}" class="btn btn-warning" >Cancel</a>
						<?php
					}
					?>
				</div>
			</div>
		</div>



	</form>





	<div class="row">
		<h4>Menu Items</h4>
		<?php
		echo $menuItemsList;
		?>

		<a href="javascript:void(0)" class="btn btn-primary saveMenuItems" title="">Save</a>

	</div>

	<div class="clearfix"></div>


</div>


@slot('bottomBlock')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@include('admin.common._alert')

<script type="text/javascript" src="{{ asset('public/js/jquery.mjs.nestedSortable.js') }}"></script>

<script>

	$('.sortable_menu').nestedSortable({
		items: 'li',
		maxLevels: 4,       
	});

	populatePageList();

	$(document).on("change", "select[name='link_type']", function(){

		populatePageList();

	});

	$(document).on("change", "select[name='page_id']", function(){
		populateUrl();
	});

	function populatePageList(){

		var link_type = $("select[name='link_type']").val();

		var page_id = '{{$page_id}}';

		if(link_type && link_type != ''){

			if(link_type == 'internal' || link_type == 'external'){
				var inp = '<input type="text" name="page_id" value="" class="form-control" />';
				$(".pageBox").html(inp);
			}
			else{

				$(".pageBox").html('');

				var _token = '{{ csrf_token() }}';

				$.ajax({
					url: "{{ route($routeName.'.menus.ajax_get_link_type_list') }}",
					type: "POST",
					data: {link_type:link_type, page_id:page_id},
					dataType:"JSON",
					headers:{'X-CSRF-TOKEN': _token},
					cache: false,
					beforeSend:function(){
						$(".ajax_msg").html("");
					},
					success: function(resp){
						if(resp.success){
							if(resp.list){
								$(".pageBox").html(resp.list);
								populateUrl();
							}
						}

					}
				});
			}
		}

	}

	function populateUrl(){
		var page = $("select[name='page_id']");
		var page_id = page.val();

		var url = '';

		if(page_id && page_id != ''){
			var url = page.find("option[value='"+page_id+"']").data("url");
		}

		if(url && url != ''){
			var inp_url = $("input[name='url']");
			inp_url.val(url);

			inp_url.prop("readonly", true);
		}
	}


	$('.saveMenuItems').click(function(){

		serialized = $('ol.sortable_menu').nestedSortable('serialize');

		//console.log(serialized); return false;

		var _token = '{{ csrf_token() }}';

		$.ajax({
			url: "{{ route($routeName.'.menus.ajax_update_items') }}",
			type: "POST",
			data: serialized,
			dataType:"JSON",
			headers:{'X-CSRF-TOKEN': _token},
			cache: false,
			beforeSend:function(){
				$(".ajax_msg").html("");
			},
			success: function(resp){
				if(resp.success){
					//$(".ajax_msg").html(resp.msg);
					//showAlert(resp.msg);
					window.location.reload();
				}
				else{
					//$(".ajax_msg").html(resp.msg);
					//showAlert(resp.msg);
					window.location.reload();
				}

			}
		});
	});


	$(document).on("click", ".delItem", function(){

		var conf = confirm("Are you sure to delete this Item");

		if(conf){

			var id = $(this).data("id");

			var _token = '{{ csrf_token() }}';

			$.ajax({
				url: "{{ route($routeName.'.menus.ajax_delete_item') }}",
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
						//$(".ajax_msg").html(resp.msg);
						window.location.reload();
					}
					else{
						//$(".ajax_msg").html(resp.msg);
						window.location.reload();
					}

				}
			});
		}
	});


	function showAlert($msg){

		//alert($msg);

		if($msg && $msg != ''){
			$("#alertModal").find(".modal-body").html($msg);
			$("#alertModal").modal("show");
		}

	}


</script>

@endslot


@endcomponent