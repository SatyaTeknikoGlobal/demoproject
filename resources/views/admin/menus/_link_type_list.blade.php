<?php
$link_type = (isset($link_type))?$link_type:'';
$page_id = (isset($page_id))?$page_id:'';
$categories = (isset($categories))?$categories:'';
$blogs = (isset($blogs))?$blogs:'';
$news = (isset($news))?$news:'';
$events = (isset($events))?$events:'';
$cms_pages = (isset($cms_pages))?$cms_pages:'';


if(!empty($link_type)){

	?>
	<select name="page_id" class="form-control">
	<?php

	if($link_type == 'category' && !empty($categories) && count($categories) > 0){
		foreach($categories as $cat){
			$url = 'categories/'.$cat->slug;
			$selected = '';
			if($url == $page_id){
				$selected = 'selected';
			}
			?>
			<option value="{{$cat->id}}" data-url="{{$url}}" {{$selected}} >{{$cat->name}}</option>
			<?php
		}
	}
	elseif($link_type == 'blog' && !empty($blogs) && count($blogs) > 0){
		foreach($blogs as $blog){
			$url = 'blogs/'.$blog->slug.'?type=blogs';
			$selected = '';
			if($url == $page_id){
				$selected = 'selected';
			}
			?>
			<option value="{{$blog->id}}" data-url="{{$url}}" {{$selected}} >{{$blog->title}}</option>
			<?php
		}
	}
	elseif($link_type == 'news' && !empty($news) && count($news) > 0){
		foreach($news as $nw){
			$url = 'blogs/'.$nw->slug.'?type=news';
			$selected = '';
			if($url == $page_id){
				$selected = 'selected';
			}
			?>
			<option value="{{$nw->id}}" data-url="{{$url}}" {{$selected}} >{{$nw->title}}</option>
			<?php
		}
	}
	elseif($link_type == 'event' && !empty($events) && count($events) > 0){
		foreach($events as $event){
			$url = 'events/'.$event->slug;
			$selected = '';
			if($url == $page_id){
				$selected = 'selected';
			}
			?>
			<option value="{{$event->id}}" data-url="{{$url}}" {{$selected}} >{{$event->title}}</option>
			<?php
		}
	}
	elseif($link_type == 'cms' && !empty($cms_pages) && count($cms_pages) > 0){
		foreach($cms_pages as $cms){
			$url = $cms->slug;
			$selected = '';
			if($url == $page_id){
				$selected = 'selected';
			}
			?>
			<option value="{{$cms->id}}" data-url="{{$url}}" {{$selected}} >{{$cms->title}}</option>
			<?php
		}
	}
	?>
	</select>
	<?php
}
?>