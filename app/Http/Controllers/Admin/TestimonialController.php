<?php

namespace App\Http\Controllers\Admin;

use App\Testimonial;
use App\UsersWallet;
use App\Helpers\CustomHelper;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use DB;
use Auth;

use Validator;
use Storage;


class TestimonialController extends Controller{

    private $limit;
    private $ADMIN_ROUTE_NAME;

    public function __construct(){
        $this->limit = 20;
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

    public function index(Request $request){
        $data = [];
        $limit = $this->limit;

        $testimonial_query = Testimonial::orderBy('id', 'desc');

        $testimonials = $testimonial_query->paginate($limit);

        $data['testimonials'] = $testimonials;

        return view('admin.testimonials.index', $data);

    }

    public function add(Request $request){
        $data = [];

        $id = (isset($request->id))?$request->id:0;

        $testimonial = '';
        if(is_numeric($id) && $id > 0){
            $testimonial = Testimonial::find($id);
            if(empty($testimonial)){
                return redirect($this->ADMIN_ROUTE_NAME.'/testimonials');
            }
        }

        if($request->method() == 'POST' || $request->method() == 'post'){

            //prd($request->toArray());

            $back_url = (isset($request->back_url))?$request->back_url:'';

            if(empty($back_url)){
                $back_url = $this->ADMIN_ROUTE_NAME.'/testimonials';
            }

            $name = (isset($request->name))?$request->name:'';
            

            $rules = [];

            $rules['name'] = 'required';
            $rules['description'] = 'required';

            $this->validate($request, $rules);

            $createdTestimonial = $this->save($request, $id);

            if ($createdTestimonial) {
                $alert_msg = 'Testimonial has been added successfully.';
                if(is_numeric($id) && $id > 0){
                    $alert_msg = 'Testimonial has been updated successfully.';
                }
                return redirect(url($back_url))->with('alert-success', $alert_msg);
            } else {
                return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
            }
        }

       
        $testimonial_name = '';

        $page_heading = 'Add Testimonial';

        if(isset($testimonial->name)){
            $testimonial_name = $testimonial->name;
            $page_heading = 'Update Testimonial - '.$testimonial_name;
        }  

        $data['page_heading'] = $page_heading;
        $data['id'] = $id;
        $data['testimonial'] = $testimonial;
        $data['testimonial_name'] = $testimonial_name;

        return view('admin.testimonials.form', $data);

    }


    public function save(Request $request, $id=0){

        $data = $request->except(['_token', 'back_url', 'image']);

        $date_on = (isset($request->date_on))?$request->date_on:'';

        $date_on = CustomHelper::DateFormat($date_on, 'Y-m-d', 'd/m/Y');

        $data['date_on'] = $date_on;

        //prd($request->toArray());

        $oldImg = '';

        $testimonial = new Testimonial;

        if(is_numeric($id) && $id > 0){
            $exist = Testimonial::find($id);

            if(isset($exist->id) && $exist->id == $id){
                $testimonial = $exist;

                $oldImg = $exist->image;
            }
        }
        //prd($oldImg);

        foreach($data as $key=>$val){
            $testimonial->$key = $val;
        }

        $isSaved = $testimonial->save();

        if($isSaved){
            $this->saveImage($request, $testimonial, $oldImg);
        }

        return $isSaved;
    }

    private function saveImage($request, $testimonial, $oldImg=''){

        $file = $request->file('image');

        //prd($old_file);

        if ($file) {
            $path = 'testimonials/';
            $thumb_path = 'testimonials/thumb/';
            $storage = Storage::disk('public');
            //prd($storage);

            $IMG_HEIGHT = CustomHelper::WebsiteSettings('TESTIMONIAL_IMG_HEIGHT');
            $IMG_WIDTH = CustomHelper::WebsiteSettings('TESTIMONIAL_IMG_WIDTH');
            $THUMB_HEIGHT = CustomHelper::WebsiteSettings('TESTIMONIAL_THUMB_WIDTH');
            $THUMB_WIDTH = CustomHelper::WebsiteSettings('TESTIMONIAL_THUMB_HEIGHT');

            $IMG_WIDTH = (!empty($IMG_WIDTH))?$IMG_WIDTH:768;
            $IMG_HEIGHT = (!empty($IMG_HEIGHT))?$IMG_HEIGHT:768;
            $THUMB_WIDTH = (!empty($THUMB_WIDTH))?$THUMB_WIDTH:336;
            $THUMB_HEIGHT = (!empty($THUMB_HEIGHT))?$IMG_WIDTH:336;

            $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);


            if($uploaded_data['success']){

                if(!empty($oldImg)){
                    if($storage->exists($path.$oldImg)){
                        $storage->delete($path.$oldImg);
                    }
                    if($storage->exists($thumb_path.$oldImg)){
                        $storage->delete($thumb_path.$oldImg);
                    }
                }

                $image = $uploaded_data['file_name'];

                $testimonial->image = $image;
                $testimonial->save();         
            }

            if(!empty($uploaded_data)){   
                return $uploaded_data;
            }  

        }

    }


    public function delete(Request $request){

        //prd($request->toArray());

        $id = (isset($request->id))?$request->id:0;

        $is_delete = '';

        if(is_numeric($id) && $id > 0){
            $is_delete = Testimonial::where('id', $id)->delete();
        }

        if(!empty($is_delete)){
            return back()->with('alert-success', 'Testimonial has been deleted successfully.');
        }
        else{
            return back()->with('alert-danger', 'something went wrong, please try again...');
        }
    }

    /* ajax_delete_image */
    public function ajaxDeleteImage(Request $request){

        //prd($request->toArray());

        $response['success'] = false;

        $id = ($request->has('id'))?$request->id:0;

        if (is_numeric($id) && $id > 0) {
            $testimonial = Testimonial::find($id);

            if(isset($testimonial->id) && $testimonial->id == $id){

                $path = 'testimonials/';
                $thumb_path = 'testimonials/thumb/';
                $storage = Storage::disk('public');

                $image = $testimonial->image;

                $isImgDeleted = false;

                if(!empty($image)){
                    if($storage->exists($path.$image)){
                        $isImgDeleted = $storage->delete($path.$image);
                    }
                    if($storage->exists($thumb_path.$image)){
                        $isImgDeleted = $storage->delete($thumb_path.$image);
                    }
                }

                if($isImgDeleted){
                    $response['success'] = true;
                }
            }

        }

        return response()->json($response);
    }

    
/* end of controller */
}