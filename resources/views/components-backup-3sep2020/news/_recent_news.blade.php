<?php
//prd($recent_news->toArray());
if(!empty($recent_news && count($recent_news) > 0)){
	?>
	<div class="recent_news">
		<div class="title">Recent News</div>
		<ul>
		<?php
		foreach ($recent_news as $r_news){
			?>
			<li><a href="<?php echo url('news/'.$r_news->slug); ?>">{{$r_news->title}}</a></li>

			<?php
		}
		?>
	</ul>
	</div>
	<?php  } ?>


