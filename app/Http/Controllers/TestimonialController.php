<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\CustomHelper;
use Mail;
use Validator;
use DB;


class TestimonialController extends Controller {

    private $limit = 20;
    private $THEME_NAME;

    public function __construct(){
        
        $this->THEME_NAME = CustomHelper::getThemeName();
    }

    public function index(Request $request){
        $data = [];

        $limit = $this->limit;

        $keyword = (isset($request->keyword))?$request->keyword:'';
        $cat_slug = (isset($request->category))?$request->category:'';

        $testimonial_query = Testimonial::where('status', 1);
        $testimonial_query->orderBy('created_at', 'desc');

        if(!empty($keyword)){
            $testimonial_query->where('title', 'like', '%'.$keyword.'%');
        }

        $testimonials = $testimonial_query->paginate($limit);

        $data['testimonials'] = $testimonials;
        $data['cat_slug'] = $cat_slug;

        $data['meta_title'] = 'Testimonials';
        $data['meta_keyword'] = 'Testimonials';
        $data['meta_description'] = 'Testimonials';
        
        //return view('blogs.index', $data);
        return view('themes.'.$this->THEME_NAME.'.testimonials.index', $data);
    }


    public function details(Request $request){

        //prd($request->toArray());
        //prd($request->slug);

        $data = [];

        $slug = (isset($request->slug))?$request->slug:'';

        if(!empty($slug)){
            $testimonial = Testimonial::where('slug', $slug)->first();

            if(isset($testimonial->slug) && $testimonial->slug == $slug){

                $BlogCategories = BlogCategory::where(['status'=>1])->orderBy('name')->limit(6)->get();

                //$recent_blogs = Testimonial::where('id', '!=', $blog->id)->where(['status'=>1])->orderBy('created_at', 'desc')->limit(4)->get();

                $data['testimonial'] = $testimonial;
                $data['BlogCategories'] = $BlogCategories;
                $data['recent_blogs'] = $recent_blogs;

                $data['meta_title'] = 'Blogs - '.$blog->meta_title;
                $data['meta_keyword'] = $blog->meta_keyword;
                $data['meta_description'] = $blog->meta_description;

                //return view('blogs.details', $data);
                return view('themes.'.$this->THEME_NAME.'.testimonials.details', $data);                
            }
        }

        return back();

    }



/* End of Controller */
}