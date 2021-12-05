<?php 
if(!empty($images) && count($images) > 0){
?>
<ul class="accomodation-gallery">
	<?php
	$storage = Storage::disk('public');

	foreach ($images as $image) {

		if(!empty($image->name) && $storage->exists('gallery/'.$image->name)){
	?> 
	<li class="gallery-box">	
		 <a data-fancybox="gallery" href="<?php echo url('public/storage/gallery/'.$image->name); ?>">
		 	<img src="<?php echo url('public/storage/gallery/'.$image->name); ?>" alt="img"> 
		 </a>
	</li>
	<?php 
    } 
}?>
</ul>

<?php 
}
?>
