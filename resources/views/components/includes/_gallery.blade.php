<?php
$params = [];
$where = [];
$tbl = 'common_images';
$orderBy = ['id'=>'asc', 'title'=>'desc'];
$params['orderBy'] = $orderBy;
$params['limit'] = 6;
$where = ['tbl_name'=>'gallery','tbl_id'=>0];

$galleryData = CustomHelper::getData($tbl, $id=0, $where, $selectArr=['*'], $params);
//prd($galleryData->toArray());

if(!empty($galleryData) && count($galleryData) > 0){
?>
<ul class="photogallery">

<?php
$storage = Storage::disk('public');

foreach ($galleryData as $gallery){
	if(!empty($gallery->name) && $storage->exists('gallery/thumb/'.$gallery->name)){
		?>

		<li>
			<div class="gallerylist">
			<div class="imgsec">
				<img src="<?php echo url('public/storage/gallery/thumb/'.$gallery->name); ?>" alt="img" border="0" /> 
			</div>
			<div class="gtitle">{{$gallery->title}}</div>
			</div>
		</li>
		<?php 
	}
}
?>

</ul>
<?php 
}
?>
