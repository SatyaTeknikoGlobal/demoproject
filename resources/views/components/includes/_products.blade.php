<?php
$params = [];
$where = [];
$tbl = 'products';
$orderBy = ['id'=>'asc', 'name'=>'desc'];
$params['orderBy'] = $orderBy;
$params['limit'] = 10;
$params['featured'] = true;

$productData = CustomHelper::getProducts($id='', $limit='', $params=[]);
$storage = Storage::disk('public');

if(!empty($productData) && count($productData) > 0){

	foreach ($productData as $product) {

		$category = $product->productCategory;
		
		$productImage = $product->defaultImage;
		//prd($productImage->toArray());
		$image = asset('public/assets/themes/theme-1/images/default-img.png');
		
		if(!empty($productImage->image) && $storage->exists('products/thumb/'.$productImage->image)){
			$image = url('public/storage/products/thumb/'.$productImage->image);
		}
		
?>
<div class="eventbox">

	<div class="imgsec" style="background:#ccc url({{$image}}) center center no-repeat;">
		<img src="public/assets/themes/theme-1/images/blankimg.png" alt="img" />
	</div>

	<div class="contents">
		<div class="title"><a href="<?php echo url('products/details/'.$product->slug);?>">{{$product->name}}</a></div>
		<div class="category"><a href="#">{{$category['name']}}</a></div> 
		<div class="content">
			<?php echo CustomHelper::wordsLimit($product->description, $limit = 100, $isStripTags=false, $allowTags=''); ?></div>
	</div>
</div>
<?php
}
}?>