@component('admin.layouts.main')

@slot('title')
Admin - {{$page_heading}} - {{ config('app.name') }}
@endslot

@slot('headerBlock')
<link href="{{url('public')}}/bootstrap-multiselect/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />

<style>
   .multiselect-native-select, span.multiselect-native-select .btn, .btn-group{width:100%; text-align: left;  }
   .btn{  overflow: hidden;}
   .caret{   right: 7px;   position: absolute; top: 15px;}
</style>

@endslot

<div class="row">

    <?php
    $routeName = CustomHelper::getAdminRouteName();

    $back_url = (request()->has('back_url'))?request()->input('back_url'):'';
    if(empty($back_url)){
        $back_url = $routeName.'/fabric';
    }

    $IMG_HEIGHT = CustomHelper::WebsiteSettings('PRODUCT_IMG_HEIGHT');
    $IMG_WIDTH = CustomHelper::WebsiteSettings('PRODUCT_IMG_WIDTH');
    $IMG_WIDTH = (!empty($IMG_WIDTH))?$IMG_WIDTH:768;
    $IMG_HEIGHT = (!empty($IMG_HEIGHT))?$IMG_HEIGHT:768;


    $product_id = (isset($product->id))?$product->id:0;

    $category_id = (isset($product->category_id))?$product->category_id:'';
    //$type = (isset($product->type))?$product->type:'';
    $name = (isset($product->name))?$product->name:'';
    $slug = (isset($product->slug))?$product->slug:'';
    $sku = (isset($product->sku))?$product->sku:'';
    $description = (isset($product->description))?$product->description:'';
    $price = (isset($product->price))?$product->price:'';
    $sale_price = (isset($product->sale_price))?$product->sale_price:'';
    $weight = (isset($product->weight))?$product->weight:'';
    $stock = (isset($product->stock))?$product->stock:'';

    $sort_order = (isset($product->sort_order))?$product->sort_order:'';
    $featured = (isset($product->featured))?$product->featured:'';
    $status = (isset($product->status))?$product->status:'1';


    $meta_title = (isset($product->meta_title))?$product->meta_title:'';
    $meta_keyword = (isset($product->meta_keyword))?$product->meta_keyword:'';
    $meta_description = (isset($product->meta_description))?$product->meta_description:'';

    $productCategories = (isset($product->productCategories))?$product->productCategories:'';
    $productImages = (isset($product->productImages))?$product->productImages:'';

    $productSizesArr = [];

    $productCategory = '';

    if(!empty($productCategories) && count($productCategories) > 0){
        $productCategory = $productCategories[0];
    }
    

    if($weight <= 0){
        $weight = '';
    }

    //pr($productStampsArr);

    $path = 'products/';
    $thumb_path = 'products/thumb/';

    $storage = Storage::disk('public');

    $categoryDropDown = '';


    if(!empty($categories) && $categories->count() > 0){
        //prd(collect($categories)->toArray());

        $categoryDropDown = CustomHelper::categoryDropDown('category_id', 'form-control categoryList', '', $category_id);
    }

    ?>

    <?php
    //echo $categoryDropDown;
    ?>
	 

    <div class="col-md-12">

        <h2>{{$page_heading}}</h2>
        <div class="bgcolor">

            @include('snippets.errors')
            @include('snippets.flash')

            <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}

                <input type="hidden" name="product_id" value="{{$product_id}}">

                <div class="row">

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label required">Name:</label>

                            <input type="text" name="name" class="form-control" value="{{ old('name', $name) }}" maxlength="255" />

                            @include('snippets.errors_first', ['param' => 'name'])
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">

                        <div class="form-group{{ $errors->has('sku') ? ' has-error' : '' }}">

                            <label class="control-label">SKU:</label>

                            <input type="text" class="form-control" name="sku" value="{{ old('sku', $sku) }}" maxlength="10" />

                            @include('snippets.errors_first', ['param' => 'sku'])
                        </div>
                    </div>


                    <!-- here is dynamic Category dropdown -->

                    <?php
                    $viewData = [];
                    $viewData['selected_id'] = $category_id;
                    ?>

                    <div class="col-sm-12 categoryBox">

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="control-label required">Category:</label>

                            <?php echo $categoryDropDown; ?>

                            @include('snippets.errors_first', ['param' => 'category_id'])

                            
                        </div>
                    </div>

                    

                    <div class="col-sm-12">

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label">Description:</label>

                            <textarea name="description" class="form-control" maxlength="2048" rows="5">{{ old('description', $description) }}</textarea>

                            @include('snippets.errors_first', ['param' => 'description'])
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-3">

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label required">Price :</label>

                            <input type="text" name="price" class="form-control" value="{{ old('price', $price) }}" maxlength="10" />

                            @include('snippets.errors_first', ['param' => 'price'])
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">

                        <div class="form-group{{ $errors->has('sale_price') ? ' has-error' : '' }}">
                            <label class="control-label">Sale Price :</label>

                            <input type="text" name="sale_price" class="form-control" value="{{ old('sale_price', $sale_price) }}" maxlength="10" />

                            @include('snippets.errors_first', ['param' => 'sale_price'])
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-3">

                        <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                            <label class="control-label">Stock :</label>

                            <input type="number" name="stock" class="form-control" value="{{ old('stock', $stock) }}" maxlength="10" />

                            @include('snippets.errors_first', ['param' => 'stock'])
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-3">

                        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                            <label class="control-label "> Weight(kg):</label>

                            <input type="text" name="weight" class="form-control" value="{{ old('weight', $weight) }}" maxlength="10" />

                            @include('snippets.errors_first', ['param' => 'weight'])
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <br>


                    <div class="col-sm-12 col-md-3">

                        <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                            <label class="control-label">Sort Order:</label>

                            <input type="text" name="sort_order" class="form-control" value="{{ old('sort_order', $sort_order) }}" maxlength="10" />

                            @include('snippets.errors_first', ['param' => 'sort_order'])
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">

                        <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
                            <label class="control-label ">Featured:</label>

                            <input type="checkbox" name="featured" value="1" <?php echo ($featured == '1')?'checked':''; ?> />

                            @include('snippets.errors_first', ['param' => 'featured'])
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">

                            <?php
                            $sel_status = old('status', $status);
                            ?>

                            <label class="control-label required">Status:</label>
                            <br>
                            <input type="radio" name="status" value="1" {{($sel_status == 1)?'checked':''}}>Active
                            &nbsp;
                            <input type="radio" name="status" value="0" {{($sel_status == 0)?'checked':''}}>Inactive

                            @include('snippets.errors_first', ['param' => 'status'])
                        </div>

                    </div>

                    <div class="clearfix"></div>

                    <br>
                    <br>


                    <div class="col-sm-12">

                        <div class="form-group{{ $errors->has('main_image') ? ' has-error' : '' }}">

                            <label class="control-label">Main Image: (Preferred dimensions: width:{{$IMG_WIDTH}}, height:{{$IMG_HEIGHT}})</label>
                            
                            <input type="file" name="main_image">

                            @include('snippets.errors_first', ['param' => 'main_image'])
                            
                        </div>

                    </div>

                    


                    <div class="col-sm-12">

                        <div class="form-group{{ $errors->has('images.*') ? ' has-error' : '' }}">

                            <label class="control-label">Images: (Preferred dimensions: width:{{$IMG_WIDTH}}, height:{{$IMG_HEIGHT}})</label>

                            <?php
                            $count_images = count($productImages);
                            if(!empty($productImages) && count($productImages) > 0){
                                ?>
                                <table class="table">
                                    <tr>
                                        <th>Image</th>
                                        <th>Default(Main)</th>
                                        <!-- <th>Set Reverse</th> -->
                                        <th>Remove</th>
                                    </tr>
                                    <?php
                                    foreach ($productImages as $pi){

                                        $img_name = $pi->image;

                                        if(!empty($img_name) && $storage->exists($thumb_path.$img_name)){
                                            ?>
                                            <tr>
                                                <td>

                                                    <a href="{{url('public/storage/'.$path.$img_name)}}" target="_blank"><img src="{{url('public/storage/'.$thumb_path.$img_name)}}" width="100" /></a>
                                                </td>
                                                <td><input type="radio" name="is_default" value="{{ $pi->id}}" {{ $pi->is_default ? 'checked' : '' }} /></td>

                                                <?php
                                                /*
                                                <td><input type="radio" name="is_reverse" value="{{ $pi->id}}" {{ $pi->is_reverse ? 'checked' : '' }} /></td>
                                                */
                                                ?>

                                                <td><input type="checkbox" name="images_remove[]" value="{{ $pi->id }}" /></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                                <?php
                            }
                            ?>

                            
                            <input type="file" name="images[]" multiple>

                            <input type="hidden" name="count_images" value="{{$count_images}}" />

                            @include('snippets.errors_first', ['param' => 'images.*'])
                            
                        </div>

                    </div>



                    <div class="clearfix"></div>

                    <br>
                    <br>

                   
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('meta_title') ? ' has-error' : '' }}">
                                <label class="control-label">Meta Title:</label>

                                <textarea name="meta_title" class="form-control" maxlength="255" >{{ old('meta_title', $meta_title) }}</textarea>

                                @include('snippets.errors_first', ['param' => 'meta_title'])
                            </div>
                            
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                                <label class="control-label">Meta Keyword:</label>

                                <textarea name="meta_keyword" class="form-control" maxlength="255" >{{ old('meta_keyword', $meta_keyword) }}</textarea>

                                @include('snippets.errors_first', ['param' => 'meta_keyword'])
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                                <label class="control-label">Meta Description:</label>

                                <textarea name="meta_description" class="form-control" maxlength="255" >{{ old('meta_description', $meta_description) }}</textarea>

                                @include('snippets.errors_first', ['param' => 'meta_description'])
                            </div>
                        </div>


                </div>

                <br>
                <br>

                    <div class="form-group">
                        <input type="hidden" name="back_url" value="{{ $back_url }}" >
                            <button type="submit" class="btn btn-success" title="Create this new product"><i class="fa fa-save"></i> Submit</button>

                            <a href="{{ url($back_url) }}" class="btn btn-lg btn-primary" title="Click here to cancel">Cancel</a>
                        </div>

            </form>
        </div>

    </div>


</div>

@slot('bottomBlock')
<script type="text/javascript" src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>

<?php
/*
<script type="text/javascript" src="{{ url('public/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
*/
?>

<script type="text/javascript">

 var editor = CKEDITOR.replace('description', {
                //filebrowserImageBrowseUrl: "{{url('public/storage/products/ck')}}",
                filebrowserImageUploadUrl: "<?php echo url($routeName.'/ck_upload?type=products&csrf_token='.csrf_token());?>"
            });

 </script>

@endslot


@endcomponent