<?php
//prd($recent_blogs->toArray());
if(!empty($recent_blogs && count($recent_blogs) > 0)){
	?>
	<div class="recent_blogs">
		<div class="title">Recent blog</div>
		<ul>
		<?php
		foreach ($recent_blogs as $r_blogs){
			?>
			<li><a href="<?php echo url('blogs/'.$r_blogs->slug); ?>">{{$r_blogs->title}}</a></li>

			<?php
		}
		?>
	</ul>
	</div>
	<?php  } ?>


