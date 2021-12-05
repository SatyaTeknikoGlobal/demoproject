<?php
if(!empty($image) && count($image) > 0){
	$imgName = $image->name;
	?>



	<tr class="row_{{$image->id}}">
        <td>
        	<input type="text" name="title[{{$image->id}}]" value="{{$image->title}}" class="form-control" >
        </td>

        <td>
        	<?php
			$imgUrl = 'javascript:void(0)';
			$imgSrc = '';
			if(!empty($imgName) && $storage->exists($thumb_path.$imgName)){
				$imgUrl = url('public/storage/'.$thumb_path.$imgName);
				$imgSrc = url('public/storage/'.$thumb_path.$imgName);
			}
			if(!empty($imgName) && $storage->exists($path.$imgName)){
				$imgUrl = url('public/storage/'.$path.$imgName);

				if(!empty($imgSrc)){					
					$imgSrc = url('public/storage/'.$path.$imgName);
				}

			}

			if(!empty($imgSrc)){
				?>
				<a href="{{$imgUrl}}" target="_blank">
					<img src="{{$imgSrc}}" style="width:100px;">
				</a>
				<?php
			}
			?>
        </td>

        <td>
        	<input type="text" name="link[{{$image->id}}]" value="{{$image->link}}" class="form-control" >
        </td>

        <td>
        	<input type="text" name="sort_order[{{$image->id}}]" value="{{$image->sort_order}}" class="form-control" >
        </td>

        <td>
        	<a href="javascript:void(0)" data-id="{{$image->id}}" class="delImg" title="Delete"><i class="fas fa-trash-alt"></i></a>
        </td>

      </tr>

      <input type="hidden" name="ids[]" value="{{$image->id}}">

	<?php
}
?>