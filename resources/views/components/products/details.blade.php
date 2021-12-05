<?php
//pr($product->toArray());

$keyword = (request()->has('keyword'))?request()->keyword:'';

$storage = Storage::disk('public');

$product_date = CustomHelper::DateFormat($product->created_at, 'M d, Y');

$product_title = $product->title;
$product_content = $product->description;

$productImage = $product->defaultImage;

$category = $product->productCategory;
//prd($productImage->toArray());
$image = asset('public/assets/themes/theme-1/images/default-img.png');

if(!empty($productImage->image) && $storage->exists('products/thumb/'.$productImage->image)){
	$image = url('public/storage/products/thumb/'.$productImage->image);
}
?>

<div class="dtbg">	
	<img src="<?php echo $image; ?>" alt="{{$product_title}}">
</div>

<div class="btext">
	<p><cite>{{$product_date}}</cite></p>
	<h4>{{$product_title}}</h4>
	<p>{{$category->name}}</p>

	<?php
	echo $product_content;
	?>

</div>

