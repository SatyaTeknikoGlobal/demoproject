<?php

namespace App\Http\Controllers;

use App\User;
use App\UserCart;
use App\Product;
use App\ProductInventory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\CustomHelper;
use DB;
use Validator;


class ProcessJobsController extends Controller {

    public function __construct(){

    }

    public function index(){
        echo "unauthorized"; die;
    }

    //getInventory
    public function getInventory(Request $request){

        $data = [];

        $method = $request->method();        

    }

    /* cart_abondon */
    public function cartAbondon(Request $request){

        $CART_ABONDON_TIME = CustomHelper::WebsiteSettings('CART_ABONDON_TIME');

        $CART_ABONDON_TIME = (int)$CART_ABONDON_TIME;
        $CART_ABONDON_TIME = 14;

        if(is_numeric($CART_ABONDON_TIME) && $CART_ABONDON_TIME > 0){
            $cartQuery = UserCart::orderBy('created_at', 'desc');

            $cartQuery->where('user_id', '>', 0);
            $cartQuery->whereRaw("TIMESTAMPDIFF(day,DATE(`created_at`),CURDATE()) >= $CART_ABONDON_TIME");

            //DB::enableQueryLog();
            $cart = $cartQuery->get();
            //prd(DB::getQueryLog());

            if(!empty($cart) && count($cart) > 0){

                $productModel = new Product;

                $cartItems = $cart->groupBy('user_id');

                //prd($cartItems->toArray());

                foreach($cartItems as $user_id=>$cartContent){
                    
                    if(!empty($cartContent) && count($cartContent) > 0){
                        $user = User::select('name', 'email')->where('id', $user_id)->first();

                        /*foreach($cartContent as $item){
                            pr($item->toArray());
                        }*/

                        $email = $user->email;
                        $name = $user->name;

                        $to_email = $email;

                        $subject = 'Cart pending - SlumberJill';

                        $ADMIN_EMAIL = CustomHelper::WebsiteSettings('ADMIN_EMAIL');

                        if(empty($ADMIN_EMAIL)){
                            $ADMIN_EMAIL = config('custom.admin_email');
                        }

                        $from_email = $ADMIN_EMAIL;

                        $email_data = [];
                        $email_data['name'] = $name;
                        $email_data['productModel'] = $productModel;
                        $email_data['cartContent'] = $cartContent;

                        $emailContent = view('emails.cart_abondon', $email_data)->render();

                        //echo $emailContent; die;

                        $is_mail = CustomHelper::sendEmail('emails.cart_abondon', $email_data, $to=$to_email, $from_email, $replyTo = $from_email, $subject);

                    }
                }
                
            }
        }

        //prd($CART_ABONDON_TIME);

    }


/* end of controller */
}
