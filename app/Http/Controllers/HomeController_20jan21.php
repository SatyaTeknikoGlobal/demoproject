<?php

namespace App\Http\Controllers;

use App\CmsPages;

use App\Category;
use App\Country;
use App\Product;
use App\Banner;
use App\HomeImage;
use App\Brand;
use App\UserCart;
use App\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CustomHelper;

use App\Libraries\InstagramApi;

use DB;
use Validator;


class HomeController extends Controller {

	private $limit;
    /**
     * Homepage
     * URL: /
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    private $THEME_NAME;

    public function __construct(){
    	$this->limit = 20;
        $this->THEME_NAME = 'themes./'.CustomHelper::getThemeName();
    }

    public function index(){   

        $data = [];
        $limit = $this->limit;

        $isMobile = CustomHelper::isMobile();

        $bannerType = 'desktop';
        
        if($isMobile){
            $bannerType = 'mobile';
        }

        $bannerWhere = [];
        $bannerWhere['page'] = 'home';
        $bannerWhere['status'] = 1;
        $bannerWhere['device_type'] = $bannerType;

        $banners = Banner::where($bannerWhere)->orderBy('sort_order')->limit($limit)->get();

        $productsTrending = Product::where(['trending'=>1, 'status'=>1])->orderBy('sort_order')->limit(3)->get();
        $productsBestSeller = Product::where(['featured'=>1, 'status'=>1])->orderBy('sort_order')->limit(10)->get();
        $brands = Brand::where(['featured'=>1, 'status'=>1])->orderBy('sort_order')->limit(6)->get();
        $HomeImages = HomeImage::where(['status'=>1])->where('image', '!=', "")->whereNotNull('image')->orderBy('sort_order')->limit(6)->get();
        //pr($brands->toArray());
        $instaMedia = '';

        $insta = new InstagramApi();

        $instaMedia = $insta->userMedia();

        $data['meta_title'] = '';
        $data['banners'] = $banners;
        $data['productsTrending'] = $productsTrending;
        $data['productsBestSeller'] = $productsBestSeller;
        $data['brands'] = $brands;
        $data['HomeImages'] = $HomeImages;
        $data['instaMedia'] = $instaMedia;
        
        return view($this->THEME_NAME.'.home.index', $data);
        //return view('home.index', $data);
    }


    public function logout(Request $request){
        
        $method = $request->method();

        /*$userId = 0;
        if(auth()->check()){
            $userId = auth()->user()->id;
        }*/

        //if($method == 'POST'){
            Auth::logout();

            if(!auth()->check()){
                session()->flush();
                if (session()->has('couponData')) {
                    session()->forget('couponData');
                }

                session()->flush();
        
               /* $sessionToken = csrf_token();

                if(is_numeric($userId) && $userId > 0){
                    UserCart::where(['session_token'=>$sessionToken, 'user_id'=>$userId])->update(['session_token'=>'']);
                }*/
            }

            return redirect(url(''))->with('alert-success', 'You have successfully logged out!');

            //return redirect(url('account/login'))->with('alert-success', 'You have successfully logged out!');
        //}
    }

 /*   public function contact(Request $request){
        //phpinfo(); die;
        $countries = DB::table('countries')->orderBy('name')->get();
        $data = [];

        //echo date('d M Y H:i A'); die;

        $select_cols = '*';

        $page_name = 'contact_us';
        $cms_data = CustomHelper::GetCMSPage($page_name, $select_cols);

        $data = array_merge($data, $cms_data);

        if($request->method() == 'POST' || $request->method() == 'post'){
            $attributes['scode'] = 'Security Code';

            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
            $rules['message'] = 'required';
            $rules['scode'] = 'required|captcha';

            $message['scode.captcha'] = "Invalid Captcha";

            $validator = Validator::make($request->all(), $rules, $message);

            $validator->setAttributeNames($attributes);

            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }
            else{
                $email_subject = "Contact us From :: SlumberJill";
                $ADMIN_EMAIL = CustomHelper::WebsiteSettings('ADMIN_EMAIL');
                //$STORE_EMAIL = "ashishkb@ehostinguk.com"; 

                $emailData['name']= $name = $request->name;
                $emailData['email'] = $request->email;
                $emailData['phone'] = $request->phone;
                $emailData['subject'] = $request->subject;
                $emailData['msg'] = $request->message;

                $viewHtml = view('emails.contact', $emailData)->render();

                prd($viewHtml);

                $query_email = CustomHelper::sendEmail('emails.contact', $emailData, $ADMIN_EMAIL, $ADMIN_EMAIL, $ADMIN_EMAIL, $email_subject);

                if($query_email){
                    return redirect(url('contact'))->with('alert-success', 'Thanks for visiting and giving us an opportunity to serve you. We will be back with the answer of your query with in next 24 business hours.');
                }
                else{
                    return redirect(url('contact'))->with('alert-danger', '<b>Opps! something went wrong. Your enquiry could not be submitted successfully.</b>');
                }
            }
            
        }

        //prd(captcha());
        $data['countries'] = $countries;
        $data['captcha_img'] = captcha_img('custom');

        return view($this->THEME_NAME.'.home.contact', $data);
    }*/


    public function contact(Request $request){
        
        //prd($request->toArray());

        $data = [];
        $response = [];
        $isContact = true;
        $data['isContact'] = $isContact;
        $data['meta_title'] = "Contact us";
        $message = [];
        $attributes = [];

        if($request->method() == 'POST' || $request->method() == 'post'){
            //prd($request->toArray());

            //$attributes['scode'] = 'Security Code';
            
            $rules['name'] = 'required';
            $rules['contact_email'] = 'required|email';
            //$rules['comment'] = 'required';
            $rules['subject'] = 'required';
            $rules['phone'] = 'required';
            //$rules['scode'] = 'required|captcha';

            //$message['scode.captcha'] = "Invalid Captcha";

            $validator = Validator::make($request->all(), $rules, $message);

            $validator->setAttributeNames($attributes);

            if ($validator->fails()){
                $response['errors'] = $validator->errors();

            }
            else{

                $forSub = (isset($request->forSub))?$request->forSub:'';

                $email_subject = "Contact Enquiry :: ".config('app.name');
                
                if($forSub == 'contact-us'){
                    $email_subject = "Contact Enquiry :: ".config('app.name');
                }
                elseif($forSub == 'volunteer'){
                    $email_subject = "Volunteer Enquiry :: ".config('app.name');
                }



                $ADMIN_EMAIL = CustomHelper::WebsiteSettings('ADMIN_EMAIL');
                //$ADMIN_EMAIL = "ramji@indiaint.com";
                if(empty($ADMIN_EMAIL)){
                    $ADMIN_EMAIL = config('custom.admin_email');
                }

                $emailData['type']= 'contact';
                $emailData['name']= $request->name;
                $emailData['subject']= $request->subject;
                $emailData['phone']= $request->phone;
                $email = $request->contact_email;
                $emailData['email'] = $email;
                $emailData['comment'] = $request->comment;

                //$viewHtml = view('emails.contact', $emailData)->render();

                //prd($emailData);
                $REPLYTO = $email;

                $viewArr = ['emails.contact', 'emails.contact_text'];

                //$query_email = CustomHelper::sendEmail($viewArr, $emailData, $ADMIN_EMAIL, $ADMIN_EMAIL, $REPLYTO, $email_subject);

                $html = view('emails.contact', $emailData)->render();

                $plainText = 'Please Send Email To Admin';

                $query_email = CustomHelper::sendEmailRaw($html, $plainText, $ADMIN_EMAIL, $ADMIN_EMAIL, $REPLYTO, $email_subject);

                $isSaved = Enquiry::create($emailData);
                //$isSaved = DB::table('enquiries')->insert($emailData);

                //prd($isSaved);
                if($query_email){
                 $response['message'] = '<div class="alert alert-success"> Thanking for filling out the form. We will get in touch with you soon. </div>';
                 $response['success'] = true;
             }
             else{
                 $response['message'] = 'Error in submitting form.';
             }
         }
         return response()->json($response);
     }

        //prd(captcha());
        //$data['countries'] = $countries;
     //return view('home.contact', $data);
 }

    /* ajax_request_donate */
    public function ajaxRequestDonate(Request $request){

        $response = [];
        $response['success'] = false;
        $message = [];
        $attributes = [];

        if($request->method() == 'POST' || $request->method() == 'post'){

            //prd($request->toArray());

            $rules = [];
            //$attributes['scode'] = 'Security Code';
            
            $rules['donation'] = 'required';
            $rules['name'] = 'required';
            $rules['contact_email'] = 'required|email';
            $rules['phone'] = 'required|numeric';
            $rules['address'] = 'required';
            $rules['transaction_id'] = 'required';
            //$rules['payment_option'] = 'required';
            //$rules['scode'] = 'required|captcha';

            //$message['scode.captcha'] = "Invalid Captcha";

            $validator = Validator::make($request->all(), $rules, $message);

            $validator->setAttributeNames($attributes);

            if ($validator->fails()){
                $response['errors'] = $validator->errors();

            }
            else{

            //prd($request->name);
                $req_data = [];
                $emailData = [];

                $donation = isset($request->donation)?$request->donation:'';
                $name = isset($request->name)?$request->name:'';
                $contact_email = isset($request->contact_email)?$request->contact_email:'';
                $phone = isset($request->phone)?$request->phone:'';
                $address = isset($request->address)?$request->address:'';
                $comment = isset($request->comment)?$request->comment:'';
                $payment_option = isset($request->payment_option)?$request->payment_option:'online';
                $transaction_id = isset($request->transaction_id)?$request->transaction_id:'online';
                $amount = isset($request->amount)?$request->amount:'';

                $req_data['type'] = 'donation';
                $req_data['donation'] = $donation;
                $req_data['name'] = $name;
                $req_data['email'] = $contact_email;
                $req_data['phone'] = $phone;
                $req_data['address'] = $address;
                $req_data['comment'] = $comment;
                $req_data['payment_option'] = $payment_option;
                $req_data['transaction_id'] = $transaction_id;
                $req_data['amount'] = $amount;

                $email_subject = "Donation Enquiry :: ".config('app.name');
                $req_data['subject'] = $email_subject;

                $ADMIN_EMAIL = CustomHelper::WebsiteSettings('ADMIN_EMAIL');

                if(empty($ADMIN_EMAIL)){
                    $ADMIN_EMAIL = config('custom.admin_email');
                }

                $from_email = config('custom.from_email');

                $emailData = $req_data;

                $viewHtml = view('emails.donation', $emailData)->render();

                //prd($viewHtml);

                $is_mail = CustomHelper::sendEmail('emails.donation', $emailData, $ADMIN_EMAIL, $from_email, $ADMIN_EMAIL, $email_subject);
                //prd($is_mail);
                if($is_mail){

                    $isSaved = Enquiry::create($emailData);

                   $response['message'] = 'Thank You for connecting Us.';
                   $response['success'] = true;
               }
               else{
                   $response['message'] = 'Error in submitting form.';
               }
            }
            
        }

        $response['message'] = $message;

        return response()->json($response);
    }


    /* ajax_request_donate_cheque */
    public function ajaxRequestDonateCheque(Request $request){

        $response = [];
        $response['success'] = false;
        $message = [];
        $attributes = [];

        if($request->method() == 'POST' || $request->method() == 'post'){

            //prd($request->toArray());

            $rules = [];
            //$attributes['scode'] = 'Security Code';
            
            $rules['payment_option'] = 'required';
            $rules['name'] = 'required';
            $rules['contact_email'] = 'required|email';
            $rules['phone'] = 'required|numeric';
            $rules['address'] = 'required';
            //$rules['scode'] = 'required|captcha';

            //$message['scode.captcha'] = "Invalid Captcha";

            $validator = Validator::make($request->all(), $rules, $message);

            $validator->setAttributeNames($attributes);

            if ($validator->fails()){
                $response['errors'] = $validator->errors();

            }
            else{

            //prd($request->name);
                $req_data = [];
                $emailData = [];

                $payment_option = isset($request->payment_option)?$request->payment_option:'';
                $name = isset($request->name)?$request->name:'';
                $contact_email = isset($request->contact_email)?$request->contact_email:'';
                $phone = isset($request->phone)?$request->phone:'';
                $address = isset($request->address)?$request->address:'';
                $country = isset($request->country)?$request->country:'';
                $state = isset($request->state)?$request->state:'';
                $address = isset($request->address)?$request->address:'';

                $req_data['type'] = 'donation';
                $req_data['payment_option'] = $payment_option;
                $req_data['name'] = $name;
                $req_data['email'] = $contact_email;
                $req_data['phone'] = $phone;
                $req_data['address'] = $address;
                $req_data['country'] = $country;
                $req_data['state'] = $state;
                $req_data['address'] = $address;

                $email_subject = "Donation Enquiry :: ".config('app.name');
                $req_data['subject'] = $email_subject;

                $ADMIN_EMAIL = CustomHelper::WebsiteSettings('ADMIN_EMAIL');

                if(empty($ADMIN_EMAIL)){
                    $ADMIN_EMAIL = config('custom.admin_email');
                }

                $from_email = config('custom.from_email');

                $emailData = $req_data;

                //$viewHtml = view('emails.donation_cheque', $emailData)->render();

                //prd($viewHtml);

                $is_mail = CustomHelper::sendEmail('emails.donation_cheque', $emailData, $ADMIN_EMAIL, $from_email, $ADMIN_EMAIL, $email_subject);
                //prd($is_mail);
                if($is_mail){

                    $isSaved = Enquiry::create($emailData);

                   $response['message'] = 'Thank You for connecting Us.';
                   $response['success'] = true;
               }
               else{
                   $response['message'] = 'Error in submitting form.';
               }
            }
            
        }

        $response['message'] = $message;

        return response()->json($response);
    }


/* ajax_sponsor_meal */
public function ajaxSponsorMeal(Request $request){

    $response = [];
    $response['success'] = false;
    $message = [];
    $attributes = [];

    if($request->method() == 'POST' || $request->method() == 'post'){

        //prd($request->toArray());

        $rules = [];
        //$attributes['scode'] = 'Security Code';
        $rules['name'] = 'required';
        $rules['contact_email'] = 'required|email';
        $rules['phone'] = 'required|numeric';
        $rules['address'] = 'required';
        //$rules['scode'] = 'required|captcha';

        //$message['scode.captcha'] = "Invalid Captcha";

        $validator = Validator::make($request->all(), $rules, $message);

        $validator->setAttributeNames($attributes);

        if ($validator->fails()){
            $response['errors'] = $validator->errors();

        }
        else{

        //prd($request->name);
            $req_data = [];
            $emailData = [];

            $name = isset($request->name)?$request->name:'';
            $contact_email = isset($request->contact_email)?$request->contact_email:'';
            $phone = isset($request->phone)?$request->phone:'';
            //$date_of_booking = isset($request->date_of_booking)?$request->date_of_booking:'';
            $booking_day = isset($request->booking_day)?$request->booking_day:'';
            $booking_month = isset($request->booking_month)?$request->booking_month:'';
            $booking_year = isset($request->booking_year)?$request->booking_year:'';

            $date_of_booking = $booking_day.'/'.$booking_month.'/'.$booking_year;

            //prd($date_of_booking);
            $address = isset($request->address)?$request->address:'';
            $type_of_meal = isset($request->type_of_meal)?$request->type_of_meal:'';
            $book_for = isset($request->book_for)?$request->book_for:'';

            //$payment_option = isset($request->payment_option)?$request->payment_option:'online';
            $transaction_id = isset($request->transaction_id)?$request->transaction_id:'';

            $payment_option = 'Later';

            if(!empty($transaction_id)){
                $payment_option = 'Online';
            }

            $req_data['name'] = $name;
            $req_data['email'] = $contact_email;
            $req_data['phone'] = $phone;
            $req_data['date_of_booking'] = $date_of_booking;
            $req_data['type_of_meal'] = $type_of_meal;
            $req_data['book_for'] = $book_for;
            $req_data['address'] = $address;
            $req_data['transaction_id'] = $transaction_id;
            $req_data['payment_option'] = $payment_option;

            $email_subject = "One-time Meal Enquiry :: ".config('app.name');
            $req_data['subject'] = $email_subject;

            $ADMIN_EMAIL = CustomHelper::WebsiteSettings('ADMIN_EMAIL');

            if(empty($ADMIN_EMAIL)){
                $ADMIN_EMAIL = config('custom.admin_email');
            }
            
            $from_email = config('custom.from_email');

            $emailData = $req_data;

            //prd($emailData);

            //$viewHtml = view('emails.donation_cheque', $emailData)->render();

            //prd($viewHtml);

            $is_mail = CustomHelper::sendEmail('emails.sponsor_meal_form', $emailData, $ADMIN_EMAIL, $from_email, $ADMIN_EMAIL, $email_subject);
            //prd($is_mail);
            if($is_mail){

                $emailData['type'] = 'one_time_meal';
                $isSaved = Enquiry::create($emailData);

               $response['message'] = 'Thank You for connecting Us.';
               $response['success'] = true;
           }
           else{
               $response['message'] = 'Error in submitting form.';
           }
        }
        
    }

    $response['message'] = $message;

    return response()->json($response);
}



 public function cmsPage(Request $request){

        $segments1 = $request->segment(1);

        //prd($segments1);

        $data = [];

        $select_cols = '*';

        if(!empty($segments1)){

            $page_name = $segments1;

            $cms_data = CustomHelper::getCMSPage($page_name, $select_cols);
            //prd($cms_data);
            $countries = Country::where('status',1)->orderBy('name')->get();

            if(isset($cms_data['cms']) && !empty($cms_data) && count($cms_data) > 0){

                $meta_title = (isset($cms_data['meta_title']))?$cms_data['meta_title']:'';

                if(empty($meta_title)){
                    $meta_title = (isset($cms_data['title']))?$cms_data['title']:'';
                }

                $data['meta_title'] = $meta_title;
                $data['cms'] = $cms_data;
                $data['countries'] = $countries;
            //prd($cms_data);
                if(!empty($cms_data['template'])){
                   return view($this->THEME_NAME.'.templates.'.$cms_data['template'], $data); 
               }
               if(empty($cms_data['parent_id'])){
                $cmsData = CmsPages::where('parent_id', $cms_data['id'])->get();
                if(!empty($cmsData) && count($cmsData) > 0){

                    $meta_title = (isset($cmsData['meta_title']))?$cmsData['meta_title']:'';

                    if(empty($meta_title)){
                        $meta_title = (isset($cmsData['title']))?$cmsData['title']:'';
                    }

                    $data['meta_title'] = $meta_title;
                    $data['cmsData'] = $cmsData;
                    $data['countries'] = $countries;
                    return view($this->THEME_NAME.'.templates.listing', $data);
                }
            }
            
            return view($this->THEME_NAME.'.home.cms_page', $data);
        }
        else{
            return redirect(url('/'));
        }

    } 

        abort(404);
    }


/* end of controller */
}
