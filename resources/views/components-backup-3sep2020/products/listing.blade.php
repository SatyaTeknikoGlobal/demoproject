<ul class="list3">
<?php
$storage = Storage::disk('public');

if(!empty($products) && count($products) > 0){

	foreach ($products as $product) {

		$category = $product->productCategory;
		
		$productImage = $product->defaultImage;
		//prd($productImage->toArray());
		$image = asset('public/assets/themes/theme-1/images/default-img.png');
		
		if(!empty($productImage->image) && $storage->exists('products/thumb/'.$productImage->image)){
			$image = url('public/storage/products/thumb/'.$productImage->image);
		}
		
?>
<li>
<div class="eventbox">
	<div class="imgsec" style="background:#ccc url(<?php echo $image; ?>) center center no-repeat;">
		<img src="public/assets/themes/theme-1/images/blankimg.png" alt="{{$product->name}}" /> 
	</div>
	 
	<div class="contents">
		<div class="title"><a href="<?php echo url('products/details/'.$product->slug);?>">{{$product->name}}</a></div>
		<div class="category"><a href="#">{{$category['name']}}</a></div> 
		<div class="content">
			<?php 
			echo CustomHelper::wordsLimit($product->description, $limit = 100, $isStripTags=false, $allowTags=''); ?></div>
	</div>
</div>
</li>
<?php
}
}?>
</ul>