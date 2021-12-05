<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('phpartisan', function(){
        //prd(request()->all());
    $cmd = request('cmd');
        //echo $cmd; die;
    if(!empty($cmd)){
        $exitCode = Artisan::call("$cmd");

        //dd($exitCode);
    }
});

$segments_arr = request()->segments();

//dd($routeCollection);

/*$home_slug_arr = ['about', 'returns', 'faq', 'terms', 'privacy','we-specialized-in','services'];

if(isset($segments_arr[0]) && in_array($segments_arr[0], $home_slug_arr)){
    Route::get('/{slug}', 'HomeController@cmsPage');
}*/


Route::get('/', 'HomeController@index');
Route::match(['get', 'post'], '/contact', 'HomeController@contact')->name('contact');
Route::match(['get', 'post'], '/logout', 'HomeController@logout')->name('logout');



Route::match(['get', 'post'], '/pay', 'RazorpayController@pay')->name('pay');
Route::match(['get', 'post'], '/dopayment', 'RazorpayController@dopayment')->name('dopayment');




/*ajax_request_donate*/
Route::match(['get', 'post'], '/ajax_request_donate', 'HomeController@ajaxRequestDonate')->name('ajax_request_donate');

/*ajax_request_donate_cheque*/
Route::match(['get', 'post'], '/ajax_request_donate_cheque', 'HomeController@ajaxRequestDonateCheque')->name('ajax_request_donate_cheque');

Route::match(['get', 'post'], '/ajax_sponsor_meal', 'HomeController@ajaxSponsorMeal')->name('ajax_sponsor_meal');


Route::redirect('account/', 'login', 301);
Route::redirect('login', 'account/login', 301);

Route::group(['prefix' => 'account', 'as' => 'account'], function(){

    Route::match(['get', 'post'], 'login', 'AccountController@login');
    Route::match(['get', 'post'], 'register', 'AccountController@register');
    Route::match(['get', 'post'], 'verify', 'AccountController@verify');
    Route::match(['get', 'post'], 'forgot', 'AccountController@forgot');
    Route::match(['get', 'post'], 'reset', 'AccountController@reset');
    
    Route::post('ajax_login', 'AccountController@ajaxLogin');
    Route::post('ajax_register', 'AccountController@ajaxRegister');
    Route::post('ajax_forgot', 'AccountController@ajaxForgot');

    Route::get('fblogin', 'AccountController@fbLogin')->name('.fbLogin');
    Route::get('fbcallback', 'AccountController@fbCallback')->name('.fbCallback');
    Route::get('glogin', 'AccountController@googleLogin')->name('.gLogin');
});

Route::group(['prefix' => 'users', 'as' => 'users', 'middleware' => ['auth']], function(){

    Route::match(['get', 'post'], '/', 'UserController@profile');

    Route::match(['get', 'post'], 'profile', 'UserController@profile');
    Route::match(['get', 'post'], 'update', 'UserController@update');
    Route::get('addresses', 'UserController@addresses');

    Route::get('orders/{order_no?}', 'UserController@orders');
    Route::get('details', 'UserController@details');
    Route::get('wallet', 'UserController@wallet');
    Route::get('wishlist', 'UserController@wishlist');

    Route::post('get_address_form', 'UserController@getAddressForm');
    Route::post('save_address', 'UserController@saveAddress');
    
    Route::post('add_to_wishlist', 'UserController@addToWishlist');
    Route::post('delete_from_wishlist', 'UserController@deleteFromWishlist');
    
    Route::post('notify_product_size', 'UserController@notifyProductSize');
});


Route::group(['prefix' => 'common', 'as' => 'common'], function(){
    
    Route::post('ajax_load_cities', 'CommonController@ajaxLoadCities');
    Route::post('ajax_regenerate_captcha', 'CommonController@ajaxRegenerateCaptcha');
    
    Route::post('ajax_set_currency', 'CommonController@ajaxSetCurrency');
    
    Route::post('ajax_check_pincode', 'CommonController@ajaxCheckPincode');

    Route::post('get_pincode_city_state', 'CommonController@getPincodeCityState');
    Route::match(['get', 'post'], 'newsletterSubscribe', 'CommonController@newsletterSubscribe');

});

// Product
Route::group(['prefix' => 'products', 'as' => 'products' , 'middleware' => ['allowedmodule:products'] ], function() {
    Route::get('/', 'ProductController@index')->name('.list');
    Route::get('/details/{slug}', 'ProductController@details')->name('.details');

    Route::post('/ajax_get_list_by_search', 'ProductController@ajaxGetListBySearch')->name('.ajax_get_list_by_search');
    Route::post('load_more', 'ProductController@loadMore')->name('.loadMore');

    Route::post('/ajax_check_pincode', 'ProductController@ajaxCheckPincode')->name('.ajax_check_pincode');

    //save_review

    Route::group(['middleware' => ['auth']], function () {
        Route::post('save_review', 'ProductController@saveReview');
    });
});



Route::group(['prefix' => 'blogs', 'as' => 'blogs' , 'middleware' => ['allowedmodule:blogs']], function() {
    Route::get('/', 'BlogController@index');
    Route::get('/{slug}', 'BlogController@details')->name('details');
    //Route::get('/details/{slug}', 'BlogController@details')->name('details');
});

Route::group(['prefix' => 'events', 'as' => 'events' , 'middleware' => ['allowedmodule:events']], function() {
    Route::get('/', 'EventController@index');
    Route::get('/{slug}', 'EventController@details')->name('details');
    //Route::get('/details/{slug}', 'BlogController@details')->name('details');
});

Route::group(['prefix' => 'news', 'as' => 'news' , 'middleware' => ['allowedmodule:news'] ], function() {
    Route::get('/', 'NewsController@index');
    Route::get('/{slug}', 'NewsController@details')->name('details');
    //Route::get('/details/{slug}', 'BlogController@details')->name('details');
});

Route::group(['prefix' => 'testimonials', 'as' => 'testimonials.'], function() {
    Route::get('/', 'TestimonialController@index');
    Route::get('/{slug}', 'TestimonialController@details')->name('details');
    //Route::get('/details/{slug}', 'BlogController@details')->name('details');
});


Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function() {
    Route::get('/', 'GalleryController@index');
});

Route::group(['prefix' => 'videos', 'as' => 'videos.'], function() {
    Route::get('/', 'VideoController@index');
});


// Cart
Route::group(['prefix' => 'cart', 'as' => 'cart'], function() {

    Route::get('/', 'CartController@index');
    Route::get('/empty', 'CartController@empty');    
    
    Route::post('add', 'CartController@add');
    Route::post('update', 'CartController@update');
    Route::post('delete', 'CartController@delete');

    Route::group(['middleware' => ['auth']], function () {
        Route::match(['get', 'post'], 'address/{id?}', 'CartController@address');
        Route::match(['get', 'post'], 'checkout', 'CartController@checkout');
        Route::post('apply_coupon', 'CartController@applyCoupon');
        Route::post('remove_coupon', 'CartController@removeCoupon');

    });

});



// Order

Route::group(['prefix' => 'order', 'as' => 'order', 'middleware' => ['auth'] ], function() {
    Route::get('/', 'OrderController@index');
    Route::post('process', 'OrderController@process');
    Route::match(['get', 'post'], 'response', 'OrderController@response');
    Route::get('confirmation', 'OrderController@confirmation');
    Route::get('success', 'OrderController@success');
    Route::get('failed', 'OrderController@failed');
});


Route::group(['prefix' => 'test', 'as' => 'test.'], function(){
    Route::any('/upload', 'TestController@upload');    
});


Route::match(['get', 'post'], 'admin/login', 'Admin\LoginController@index');
/*Route::match(['get', 'post'], 'admin/login', function(){
    echo 'adminj/login'; die;
});
Route::get('admin/login', 'Admin\LoginController@index');
Route::post('admin/login', 'Admin\LoginController@auth');*/

$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

//prd($ADMIN_ROUTE_NAME);

// Admin
Route::group(['namespace' => 'Admin', 'prefix' => $ADMIN_ROUTE_NAME, 'as' => $ADMIN_ROUTE_NAME.'.', 'middleware' => ['authadmin']], function() {
    

    // test - URL: /admin/test
    Route::any('test', 'TestController@index');

    // logout - URL: /admin/logout
    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::match(['get','post'],'change_password','AdminController@index')->name('change_password');
    

    // Dashboard - URL: /admin
    Route::get('/', 'HomeController@index')->name('home');
    Route::match(['get', 'post'], 'verify_password', 'HomeController@verify_password');
    Route::post('ck_upload', 'HomeController@ckUpload')->name('ck_upload');


    // Customers    
    Route::group(['prefix' => 'customers', 'as' => 'customers'], function() {

        Route::get('/', 'CustomerController@index')->name('.index');

        Route::match(['get', 'post'], 'add/', 'CustomerController@add')->name('.add');

        Route::match(['get', 'post'], 'edit/{customer_id}', 'CustomerController@add')->where(['customer_id'=>'[0-9]+'])->name('.edit');

        Route::post('search/', 'CustomerController@search')->name('.search')->middleware('permission:customers.search');

        Route::match(['get', 'post'], 'wallet/{user_id}', 'CustomerController@wallet')->where(['user_id' => '[0-9]+',])->name('.wallet');

    });

     //Enquires 
    Route::group(['prefix' => 'enquiries', 'as' => 'enquiries'], function() {

       Route::get('/', 'EnquiryController@index')->name('.index');
       Route::post('/delete/{id}', 'EnquiryController@delete')->name('.delete');
       Route::get('/view/{id}', 'EnquiryController@view')->name('.view');

   }); 
    
    // Categories
    Route::group(['prefix' => 'categories', 'as' => 'categories'], function() {

        Route::get('/', 'CategoryController@index')->name('.index');

        Route::match(['get', 'post'], 'add/', 'CategoryController@add')->name('.add');

        Route::match(['get', 'post'], 'edit/{id}', 'CategoryController@add')->where(['id'=>'[0-9]+'])->name('.edit');
        
        Route::delete('delete/{id}', 'CategoryController@delete')->name('.delete');

    });


    //settings 
    Route::group(['prefix' => 'settings', 'as' => 'settings', 'middleware' => ['allowedmodule:settings'] ], function() {

        Route::match(['get', 'post'], '/{setting_id?}', 'SettingsController@index')->name('.index');
        //Route::any('/{setting_id}', 'SettingsController@index')->name('.index');
     });



    Route::group(['prefix' => 'newsletter', 'as' => 'newsletter', 'middleware' => ['allowedmodule:newsletter'] ], function() {

         Route::get('/', 'NewsletterController@index')->name('.index');
         Route::post('/delete/{id}', 'NewsletterController@delete')->name('.delete');
       
    }); 

    // for countries 
    Route::group(['prefix' => 'countries', 'as' => 'countries', 'middleware' => ['allowedmodule:countries']], function() {

        Route::get('/', 'CountryController@index')->name('.index');

        Route::match(['get', 'post'], '/save/{id?}', 'CountryController@save')->name('.save');
    });

    Route::group(['prefix' => 'states', 'as' => 'states' , 'middleware' => ['allowedmodule:states'] ], function() {

        Route::get('/', 'StateController@index')->name('.index');

        Route::match(['get', 'post'], '/save/{id?}', 'StateController@save')->name('.save');
    });  

    Route::group(['prefix' => 'cities', 'as' => 'cities' , 'middleware' => ['allowedmodule:cities'] ], function() {

        Route::get('/', 'CityController@index')->name('.index');
        Route::match(['get', 'post'], '/save/{id?}', 'CityController@save')->name('.save');
    });
      

    // Product
    Route::group(['prefix' => 'products', 'as' => 'products' , 'middleware' => ['allowedmodule:products'] ], function() {

        Route::get('/', 'ProductController@index')->name('.index');
        
        Route::match(['get', 'post'], 'add', 'ProductController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'ProductController@add')->name('.edit');

        Route::post('ajax_get_category_child', 'ProductController@ajaxGetCategoryChild')->name('.ajax_get_category_child');
        
        Route::post('ajax_get_category_attributes', 'ProductController@ajaxGetCategoryAttributes')->name('.ajax_get_category_attributes');
        Route::match(['get', 'post'], 'inventory/{product_id}/{inventory_id?}', 'ProductController@inventory')->name('.inventory');

        // Product Inventory
        Route::group(['prefix' => '{product_id}', 'as' => '.product.'], function() {
            // Inventory
            Route::group(['prefix' => 'inventory', 'as' => 'inventory'], function() {
                // Create Inventory Item - URL: /admin/products/{product_id}/inventory/
                Route::match(['get', 'post'], '/{inventory_id?}', 'ProductController@inventory');
                Route::post('/{inventory_id}/delete', 'ProductController@deleteInventory');
            });
        });

        Route::match(['get', 'post'], 'upload', 'ProductController@upload')->name('.upload');


    });

    // Forms
    Route::group(['prefix' => 'forms', 'as' => 'forms' , 'middleware' => ['allowedmodule:forms'] ], function() {

        Route::get('/', 'FormController@index')->name('.index');

        Route::match(['get', 'post'], 'add', 'FormController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'FormController@add')->name('.edit');

        Route::post('ajax_delete_image', 'FormController@ajax_delete_image')->name('.ajax_delete_image');
        Route::post('ajax_delete_element', 'FormController@ajaxDeleteElement')->name('.ajax_delete_element');

        Route::post('delete/{id}', 'FormController@delete')->name('.delete');
    });

    // Menus
    Route::group(['prefix' => 'menus', 'as' => 'menus' , 'middleware' => ['allowedmodule:menus'] ], function() {

        Route::get('/', 'MenuController@index')->name('.index');

        Route::match(['get', 'post'], 'add', 'MenuController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'MenuController@add')->name('.edit');
        Route::match(['get', 'post'], 'items/{id}/{item_id?}', 'MenuController@items')->name('.items');

        Route::post('ajax_get_link_type_list', 'MenuController@ajaxGetLinkTypeList')->name('.ajax_get_link_type_list');
        Route::post('ajax_update_items', 'MenuController@ajaxUpdateItems')->name('.ajax_update_items');
        Route::post('ajax_delete_item', 'MenuController@ajaxDeleteItem')->name('.ajax_delete_item');
        
        Route::post('ajax_delete_image', 'MenuController@ajax_delete_image')->name('.ajax_delete_image');
        Route::post('ajax_delete_element', 'MenuController@ajaxDeleteElement')->name('.ajax_delete_element');

        Route::post('delete/{id}', 'MenuController@delete')->name('.delete');
    });


    // Banners
    Route::group(['prefix' => 'banners', 'as' => 'banners' , 'middleware' => ['allowedmodule:banners'] ], function() {

        Route::get('/', 'BannerController@index')->name('.index');

        Route::match(['get', 'post'], 'add', 'BannerController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{banner_id}', 'BannerController@add')->name('.edit');

        Route::post('ajax_delete_image', 'BannerController@ajax_delete_image')->name('.ajax_delete_image');

        Route::post('delete/{banner_id}', 'BannerController@delete')->name('.delete');
    });


    // Home Images
    Route::group(['prefix' => 'home_images', 'as' => 'home_images' , 'middleware' => ['allowedmodule:home_images'] ], function() {

        Route::get('/', 'HomeImageController@index')->name('.index');

        Route::match(['get', 'post'], 'add', 'HomeImageController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'HomeImageController@add')->name('.edit');

        Route::post('ajax_delete_image', 'HomeImageController@ajax_delete_image')->name('.ajax_delete_image');

        Route::post('delete/{id}', 'HomeImageController@delete')->name('.delete');
    });

     //Pincodes
    Route::group(['prefix' => 'pincodes', 'as' => 'pincodes'], function() {

        Route::get('/', 'PincodeController@index')->name('.index');
        Route::match(['get', 'post'], '/{id?}', 'PincodeController@index')->name('.index');
        Route::post('delete/{id}', 'PincodeController@delete')->name('.delete');
    });


    // CMS Pages
    Route::group(['prefix' => 'cms', 'as' => 'cms' , 'middleware' => ['allowedmodule:cms'] ], function() {

        Route::get('/', 'CmsController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CmsController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CmsController@add')->name('.edit');
        Route::post('ajax_delete_image', 'CmsController@ajax_delete_image')->name('.ajax_delete_image');
        Route::post('delete/{id}', 'CmsController@delete')->name('.delete');
    });
    
   /* // CMS Pages
    Route::group(['prefix' => 'cms', 'as' => 'cms', 'middleware' => ['allowedmodule:cms'] ], function() {
        Route::get('/', 'CmsController@index')->name('.index');
        Route::match(['get', 'post'],'edit/{cms_id?}', 'CmsController@edit')->where('cms_id', '[0-9]+')->name('.edit');
    });*/


    // Coupon
    Route::group(['prefix' => 'coupons', 'as' => 'coupons' , 'middleware' => ['allowedmodule:coupons'] ], function() {

        Route::get('/', 'CouponController@index')->name('.index');

        Route::match(['get', 'post'], 'add', 'CouponController@add')->name('.add');

        Route::match(['get', 'post'], 'edit/{id}', 'CouponController@edit')->name('.edit');

        Route::post('delete/{id}', 'CouponController@delete')->name('.delete');
    });

    // Blog Categories
    Route::group(['prefix' => 'blogs_categories', 'as' => 'blogs_categories' , 'middleware' => ['allowedmodule:blogs_categories'] ], function() {

        Route::get('/', 'BlogCategoryController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'BlogCategoryController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'BlogCategoryController@add')->name('.edit');
        Route::post('ajax_delete_image', 'BlogCategoryController@ajax_delete_image')->name('.ajax_delete_image');
        Route::post('delete/{id}', 'BlogCategoryController@delete')->name('.delete');
    });

    // Blogs
    Route::group(['prefix' => 'blogs', 'as' => 'blogs' , 'middleware' => ['allowedmodule:blogs|news'] ], function() {
        
        Route::get('/', 'BlogController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'BlogController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'BlogController@add')->name('.edit');
        Route::post('ajax_delete_image', 'BlogController@ajax_delete_image')->name('.ajax_delete_image');
        Route::post('ajax_delete_pdf', 'BlogController@ajax_delete_pdf')->name('.ajax_delete_pdf');
        Route::post('delete/{id}', 'BlogController@delete')->name('.delete');
    });

     // Events
    Route::group(['prefix' => 'events', 'as' => 'events' , 'middleware' => ['allowedmodule:events'] ], function() {

        Route::get('/', 'EventController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'EventController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'EventController@add')->name('.edit');
        Route::post('ajax_delete_image', 'EventController@ajax_delete_image')->name('.ajax_delete_image');
        Route::post('delete/{id}', 'EventController@delete')->name('.delete');
    });

    
    // Orders
    Route::group(['prefix' => 'orders', 'as' => 'orders' , 'middleware' => ['allowedmodule:orders'] ], function() {

        Route::get('/', 'OrderController@index')->name('.index');

        Route::match(['get', 'post'], '/view/{id}', 'OrderController@view')->name('.view');

        Route::delete('delete/{id}}', 'OrderController@delete')->where(['id'=>'[0-9]+'])->name('.delete');
       
    });

    
    // Review
    Route::group(['prefix' => 'reviews', 'as' => 'reviews' , 'middleware' => ['allowedmodule:reviews'] ], function() {

        Route::get('/', 'ReviewController@index')->name('.index');
        Route::get('/{id}', 'ReviewController@view')->name('.view');
        Route::post('ajax_view', 'ReviewController@ajaxView')->name('.ajax_view');
        Route::post('change_status', 'ReviewController@changeStatus')->name('.change_status');

        Route::post('delete/{id}', 'ReviewController@delete')->name('.delete');
       
    });


    
 // Images
Route::group(['prefix' => 'images', 'as' => 'images' , 'middleware' => ['allowedmodule:images']], function() {

    Route::get('/', 'ImageController@index')->name('.index');

    Route::get('upload', 'ImageController@upload')->name('.upload');

    Route::post('ajax_check_exist', 'ImageController@ajaxCheckExist')->name('.ajax_check_exist');

    Route::post('ajax_upload', 'ImageController@ajaxUpload')->name('.ajax_upload');
    Route::post('ajax_update', 'ImageController@ajaxUpdate')->name('.ajax_update');
    Route::post('ajax_delete', 'ImageController@ajaxDelete')->name('.ajax_delete');

    Route::post('ajax_delete_images', 'ImageController@ajaxDeleteImages')->name('.ajax_delete_images');
});


 // Images
Route::group(['prefix' => 'videos', 'as' => 'videos' , 'middleware' => ['allowedmodule:videos']], function() {

    Route::get('add','VideoController@add')->name('.add');
    Route::post('ajax_save','VideoController@ajaxSave')->name('.ajax_save');
    Route::post('ajax_delete','VideoController@ajaxDelete')->name('.ajax_delete');
});

 // Testimonials
Route::group(['prefix' => 'testimonials', 'as' => 'testimonials'], function() {

    Route::get('/', 'TestimonialController@index')->name('.index');
    Route::match(['get', 'post'], 'add', 'TestimonialController@add')->name('.add');
    Route::match(['get', 'post'], 'edit/{id}', 'TestimonialController@add')->name('.edit');

    Route::post('ajax_delete_image', 'TestimonialController@ajaxDeleteImage')->name('.ajax_delete_image');
    
    Route::post('delete/{id}', 'TestimonialController@delete')->name('.delete');
});

/* End - Admin group*/
});

Route::group(['prefix' => 'forms', 'as' => 'forms'], function() {
    Route::match(['get', 'post'], '/{slug}', 'FormController@index')->name('index');
    //Route::match(['get', 'post'],'/save', 'FormController@save')->name('save');
});

//$home_slug_arr = ['about', 'returns', 'faq', 'terms', 'privacy','we-specialized-in','services'];
if(isset($segments_arr[0])){
    Route::get('/{slug}', 'HomeController@cmsPage');
}
 
