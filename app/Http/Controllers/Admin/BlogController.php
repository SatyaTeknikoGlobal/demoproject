<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\BlogImage;
use App\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Validator;
use Storage;
use Image;

class BlogController extends Controller
{
    private $limit;
    private $typeArr;
    private $ADMIN_ROUTE_NAME;

    public function __construct(){
        $this->limit = 20;
        $this->typeArr = config('custom.blog_type_arr');

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
        $type = (request()->has('type'))?request('type'):'';

        $this->middleware('allowedmodule:'.$type);

       if(empty($type) || !in_array($type, $this->typeArr)){
            return redirect(url($this->ADMIN_ROUTE_NAME));
        }
    }

    public function index(Request $request){

        $data = [];
        $limit = $this->limit;
        $type = (isset($request->type))?$request->type:'';

       // if($type == 'blogs' || $type == 'news'){

        $blog_query = Blog::orderBy('created_at','desc');      
        if($type !='')
        {
            $blog_query->where('type', $type);
        }
        $blogs = $blog_query->paginate($limit);
        $data['blogs'] = $blogs;
        $data['type'] = $type;

        return view('admin.blogs.index', $data);
        //}
        //else{
           //return redirect(url($this->ADMIN_ROUTE_NAME)); 
        //}
    }

    public function add(Request $request){

        $type = (isset($request->type))?$request->type:'';

        //if($type == 'blogs' || $type == 'news'){

        $id = (isset($request->id))?$request->id:0;
        $type = (isset($request->type))?$request->type:'';
        $blog = '';
        $blog_images = '';
        $title = '';

        if($type == 'blogs'){
            $title = 'Add Blog';
        }
        elseif($type == 'news'){
            $title = 'Add News';
        }

        $categories = BlogCategory::where('type',$type)->orderBy('created_at','desc')->get();

        if(is_numeric($id) && $id > 0){
            $blog = Blog::find($id);
            $blog_images = BlogImage::where('blog_id', $id)->get();
            $title = 'Edit ('.$blog->title." )";
        }
        if($request->method() == 'POST' || $request->method() == 'post'){

            //prd($request->toArray());         
            $ext = 'jpg,jpeg,png,gif';

            $rules['title'] = 'required';
            $rules['category_id'] = 'required';
            $rules['status'] = 'required';
            $rules['image.*'] = 'nullable|image|mimes:'.$ext;

            $this->validate($request, $rules);
            $req_data = [];
            $req_data = $request->except(['_token', 'image', 'back_url', 'old_image','old_pdf','blog_id','featured']);
            $slug = CustomHelper::GetSlug('blogs', 'id', $id, $request->title);

            $req_data['slug'] = $slug;
            $req_data['featured'] = (isset($request->featured)) ? 1:0;
            $blog_date = (isset($request->blog_date))?$request->blog_date:'';
            $date = CustomHelper::DateFormat($blog_date, 'Y-m-d H:i:s', 'd/m/y');
            $req_data['blog_date'] = $date;
            //prd($req_data);
            if(!empty($blog) && count($blog) > 0){
                $isSaved = Blog::where(['id'=>$blog->id,'type'=>$type])->update($req_data);
                $msg = ucwords($type)." has been updated successfully.";
            }
            else{
                $isSaved = Blog::create($req_data);
                $id = $isSaved->id;
                $msg = ucwords($type)." has been added successfully.";
            }

            if($request->hasFile('image')) {
                $files = $request->file('image');

                if(!empty($files) && count($files)){
                    foreach($files as $file){
                        $images_result = $this->saveImage($id, $file);
                    }
                    if($images_result['success']== false){
                        session()->flash('alert-danger', 'Image could not be added');
                    }
                }
            }

            if($request->hasFile('pdf')) {
                $file = $request->file('pdf');

                if(!empty($file)){
                    $pdf_result = $this->savePdf($file,$id);
                    //prd($pdf_result);
                    if($pdf_result['success']== false){
                        session()->flash('alert-danger', 'Pdf could not be added');
                    }
                }
            }

            if ($isSaved) {

                cache()->forget('blogs');

                return redirect(url($this->ADMIN_ROUTE_NAME.'/blogs?type='.$type))->with('alert-success', $msg);
            } else {
                return back()->with('alert-danger', ucwords($type). 'could be added, please try again or contact the administrator.');
            }
        }

        $data = [];
        $data['page_heading'] = $title;
        $data['blog'] = $blog;
        $data['blog_images'] = $blog_images;
        $data['categories'] = $categories;
        $data['id'] = $id;

        return view('admin.blogs.form', $data);
      //}
      //else{
        //return redirect(url($this->ADMIN_ROUTE_NAME));
      //}
    }


    private function saveImage($id, $file){

        if ($file) {
            $path = 'blogs/';
            $thumb_path = 'blogs/thumb/';
            $storage = Storage::disk('public');
            //prd($storage);

            $IMG_HEIGHT = CustomHelper::WebsiteSettings('BLOG_IMG_HEIGHT');
            $IMG_WIDTH = CustomHelper::WebsiteSettings('BLOG_IMG_WIDTH');
            $THUMB_HEIGHT = CustomHelper::WebsiteSettings('BLOG_THUMB_WIDTH');
            $THUMB_WIDTH = CustomHelper::WebsiteSettings('BLOG_THUMB_HEIGHT');

            $IMG_WIDTH = (!empty($IMG_WIDTH))?$IMG_WIDTH:768;
            $IMG_HEIGHT = (!empty($IMG_HEIGHT))?$IMG_HEIGHT:768;
            $THUMB_WIDTH = (!empty($THUMB_WIDTH))?$THUMB_WIDTH:336;
            $THUMB_HEIGHT = (!empty($THUMB_HEIGHT))?$IMG_WIDTH:336;

            $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);


            if($uploaded_data['success']){

                $image = $uploaded_data['file_name'];
                $blogImage = new BlogImage;
                $blogImage->blog_id = $id;
                $blogImage->image = $image;
                $blogImage->save();         
            }

            if(!empty($uploaded_data)){   
                return $uploaded_data;
            }  

        }
    }
    

    public function ajax_delete_image(Request $request){

        $result['success'] = false;

        $image_id = ($request->has('image_id'))?$request->image_id:0;

        if (is_numeric($image_id) && $image_id > 0) {
            $is_img_deleted = $this->delete_blogs_images($image_id);
            if($is_img_deleted)
            {
                $result['success'] = true;
                $result['msg'] = '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Blog image has been delete successfully.</div>';
            }
        }

        if($result['success'] == false){
            $result['msg'] = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong, please try again.</div>';
        }
        return response()->json($result);
    }


    public function delete(Request $request){
        
        $id = $request->id;
        $type = $request->type;
        $method = $request->method();
        $is_deleted = 0;

        if($method=="POST"){
            if(is_numeric($id) && $id > 0)
            {
                $blog = Blog::find($id);
                $blog_img = BlogImage::where('blog_id',$id)->get();
                //prd($blog_img);
                if(!empty($blog_img) && count($blog_img) > 0)
                {
                    foreach ($blog_img as $img) {
                        $image_id = $img->id;
                        $this->delete_blogs_images($image_id);
                    }
                }
                $is_deleted = $blog->delete();
            }
        }
        
        if($is_deleted){
            return redirect(url($this->ADMIN_ROUTE_NAME.'/blogs?type='.$type))->with('alert-success', ucwords($type).' has been deleted successfully.');
        }else
        {
            return redirect(url($this->ADMIN_ROUTE_NAME.'/blogs?type='.$type))->with('alert-danger', ucwords($type).' cannot be deleted, please try again or contact the administrator.');
        }

    }

    public function delete_blogs_images($id)
    {  
        //echo $id; die;
        $storage = Storage::disk('public');
        $path = 'blogs/';
        $blog = BlogImage::find($id);
        $image = (isset($blog->image))?$blog->image:'';

        $is_deleted = $blog->delete();

        if($is_deleted){
            if(!empty($image) && $storage->exists($path.'thumb/'.$image))
            {
                $is_deleted = $storage->delete($path.'thumb/'.$image);
            }
            if(!empty($image) && $storage->exists($path.$image))
            {
                $is_deleted = $storage->delete($path.$image);
            }
            return true;
        }else
        {
            return false;
        }
    }


    public function savePdf($file, $id){
        //prd($file); 
        //echo $id; die;
        $result['org_name'] = '';
        $result['file_name'] = '';

        if ($file) 
        {
            $path = 'blogs/pdf';
            
            $uploaded_data = CustomHelper::UploadFile($file, $path, $ext='');

            if($uploaded_data['success']){
                $new_pdf = $uploaded_data['file_name'];

                if(is_numeric($id) && $id > 0){
                    $blog = Blog::find($id);

                    if(!empty($blog) && count($blog) > 0){

                        $storage = Storage::disk('public');

                        $old_pdf = $blog->pdf;

                        $blog->pdf = $new_pdf;

                        $isUpdated = $blog->save();

                        if($isUpdated){

                            if(!empty($old_pdf) && $storage->exists($path.$old_pdf)){
                                $storage->delete($path.$old_pdf);
                            }
                        }
                    }
                }
            }

            if(!empty($uploaded_data))
            {   
                return $uploaded_data;
            }
        }
    }

    public function ajax_delete_pdf(Request $request){

        $result['success'] = false;

        $id = ($request->has('id'))?$request->id:0;

        //prd($id);

        if (is_numeric($id) && $id > 0) {
            $is_pdf_deleted = $this->delete_pdf($id);
            if($is_pdf_deleted)
            {
                $result['success'] = true;
                $result['msg'] = '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pdf has been delete successfully.</div>';
            }
        }

        if($result['success'] == false){
            $result['msg'] = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong, please try again.</div>';
        }
        return response()->json($result);
    }



    public function delete_pdf($id)
    {   
        $is_deleted = '';
        $is_updated = '';
        $storage = Storage::disk('public');
        $path = 'blogs/pdf/';
        $blog = Blog::find($id);
        
        $pdf = (isset($blog->pdf))?$blog->pdf:'';

        if(!empty($pdf) && $storage->exists($path.$pdf))
        {
            $is_deleted = $storage->delete($path.$pdf);
        }
        if($is_deleted){
           $blog->pdf = '';
           $is_updated = $blog->save();

       }
       return $is_updated;
   }

    /* end of controller */
}