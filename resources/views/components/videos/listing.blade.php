<?php 
if(!empty($videos) && count($videos) > 0){
?>
<ul class="list3">
	<?php
	$storage = Storage::disk('public');

	foreach ($videos as $video) {
	?>
	<li>
		<div class="imgsec">
			<?php echo $video->link; ?>
		</div>
	</li>
	<?php 
    } 
?>
</ul>

<?php 
}
?>
