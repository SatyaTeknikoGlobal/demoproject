@component('emails.common.layout')

@slot('heading')
Cart Pending
@endslot

@slot('pageBlock')

<tr>
  <td style="padding: 30px 0px 30px 40px;">
    <span style="font-size: 24px; color: #3f4041; font-family: 'Roboto', sans-serif, Arial;">Hi {{$name}}</span>
    <p style="font-size: 16px; font-family: 'Roboto', sans-serif, Arial; color: #626365; line-height: 32px;">You have pending Items in your cart
    </p>
  </td>
</tr>
<tr bgcolor="#e41881">
  <td colspan="2" height="4"></td>

</tr>
<tr bgcolor="#ffffff">
  <td colspan="2" height="1"></td>

</tr>
<tr bgcolor="#3f4041">
  <td colspan="2" height="8"></td>
</tr>
<tr>
  <td style="padding: 40px 40px 20px 40px;">
    <span style="font-size: 18px; font-family: Roboto; color: #3f4041; font-weight: bold;">Itrems Details</span>
  </td>
</tr>

@endslot

<?php
  if(!empty($cartContent) && count($cartContent) > 0){
    ?>

    <table class="table" width="90%" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #ddd; border-radius: 4px; margin: 0px 40px 20px 40px;">

      <?php

      $storage = Storage::disk('public');
      $img_path = 'products/';
      $thumb_path = $img_path.'thumb/';

      foreach($cartContent as $cart){

              $cartId = $cart->id;

              $cartIdArr = explode('_', $cartId);

              $product_id = $cart->product_id;

              $product = $productModel->find($product_id);
              //prd($product->toArray());

              $qty = $cart->qty;

              $sizeId = $cart->size_id;
              $sizeName = $cart->size_name;
              $clrName = $cart->color_name;

              //pr($cart->toArray());

              $price = $product->price;
              $salePrice = $product->sale_price;

              $productBrand = $product->productBrand;

              $defaultImage = $product->defaultImage;
              $productImages = $product->productImages;

              $imgUrl = '';

              if(!empty($defaultImage) && count($defaultImage) > 0){
                if(!empty($defaultImage->image) && $storage->exists($thumb_path.$defaultImage->image) ){
                  $imgUrl = url('public/storage/'.$thumb_path.$defaultImage->image);
                }
              }

              if(empty($imgUrl)){
                if(!empty($productImages) && count($productImages) > 0){
                  $productImg = $productImages[0];
                  if(!empty($productImg->image) && $storage->exists($thumb_path.$productImg->image) ){
                    $imgUrl = url('public/storage/'.$thumb_path.$productImg->image);
                  }
                }
              }

              $brandName = '';

              if(!empty($productBrand) && count($productBrand) > 0){
                $brandName = $productBrand->name;
              }

        $inrImgIconUrl = url('public/images/inr-icon.png');
        $inrImgIcon = '<img src="'.$inrImgIconUrl.'">';

        ?> 
		

        <tr>
      <!--  <td width="20%" style="padding: 10px 0px 5px 10px;" class="imgtable"> -->
          <td width="20%" style="padding: 10px 0px 5px 10px;" class="single_p_images">

            <?php
            if(!empty($imgUrl)){
              ?>
              <img src="{{$imgUrl}}" alt="{{$product->name}}" align="products" width="133" height="187">
              <?php
            }
            ?>
          </td>

          <td width="70%" style="padding: 10px 0px 5px 10px;">
            <table class="table2" width="90%" border="0" cellspacing="0" cellpadding="0">

              <tr>
                <td>
                  <span style="font-size: 17px; font-weight: 600; font-family: Roboto; color:#2c2928; padding: 30px 10px 10px 0px;">{{$brandName}}</span>
                  <p style="font-size: 14px; font-family: Roboto; color: #2c2928; margin: 5px 0px;">{{$product->name}}</p>
                </td>
              </tr>
              <tr>
                <td>
                  <p class="inline_elements" style="font-size: 14px; font-family: Roboto;  color: #2c2928; margin: 8px 0px;">SIZE :<strong style="margin-left: 10px;"> {{$sizeName}}</strong></p>
                  <p class="inline_elements2" style="font-size: 14px; font-family: Roboto;  color: #2c2928; margin: 8px 0px;">QTY :<strong style="margin-left: 10px;"> {{$qty}}</strong></p>
                </td>
                <td>
                  <?php
                  if($salePrice < $price){
                    $discount = 0;
                    //$discount = CustomHelper::calculateProductDiscount($price, $salePrice);

                    $totalPrice = $price*$cart->qty;
                    $totalSaleprice = $salePrice*$cart->qty;

                    $discountAmt = $totalPrice - $totalSaleprice;
                    ?>

                    <p style="font-size: 16px; font-family: Roboto; color: #616161; text-align: right; margin: 8px 0px;"><span>Total MRP    :</span> 
                      <strong style="font-size: 17px; font-family: Roboto; color: #3f4041; font-weight: bold; margin-left: 15px;">
                        <?php echo $inrImgIcon;?> {{number_format($totalPrice)}}
                      </strong>
                    </p>
                    <p style="font-size: 16px; font-family: Roboto; color: #616161; text-align: right; margin: 8px 0px;"><span>Discount    :</span>
                      <strong style="font-size: 17px; font-family: Roboto; color: #3f4041; font-weight: bold; margin-left: 15px;">
                        <?php echo $inrImgIcon;?> - {{number_format($discountAmt)}}
                      </strong>
                    </p>
                    <p style="font-size: 19px; font-family: Roboto; color: #616161; font-weight: bold; text-align: right; margin: 8px 0px;"><span>Total    :</span>
                      <strong style="font-size: 17px; font-family: Roboto; color: #3f4041; font-weight: bold; margin-left: 15px;">
                        <?php echo $inrImgIcon;?> {{number_format($totalSaleprice)}}
                      </strong>
                    </p>

                    <?php
                  }
                  else{
                    ?>
                    <p style="font-size: 19px; font-family: Roboto; color: #616161; font-weight: bold; text-align: right; margin: 8px 0px;"><span>Total    :</span>
                      <strong style="font-size: 17px; font-family: Roboto; color: #3f4041; font-weight: bold; margin-left: 15px;">
                        <?php echo $inrImgIcon;?> {{number_format($price)}}
                      </strong>
                    </p>
                    <?php
                  }
                  ?>


                </td>
              </tr>


            </table>
          </td>
        </tr>



        <?php
      }
      ?>


    </table>

    <?php
  }

  ?>


@endcomponent