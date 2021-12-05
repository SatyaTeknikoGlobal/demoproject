<table>
    <thead>
    <tr>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
        <?php

        //$storage = Storage::disk('public');

        //$img_path = 'products/';
        //$thumb_path = $img_path.'thumb/';

        if(!empty($newsletters)){
            foreach($newsletters as $newsletter){
                $email = $newsletter->email;
                //$productInventory = $product->productInventory;

                //prd($product->toArray());

                //if(!empty($productInventory)){

                    //foreach($productInventory as $pi){

                        ?>
                        <tr>
                            <td>{{$email}}</td>
                        </tr>
                        <?php
                    //}
                //}
            }
        }
        ?>
    </tbody>
</table>