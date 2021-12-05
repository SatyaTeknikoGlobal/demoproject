<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\CustomHelper;
use Mail;
use Validator;
use DB;


class NewsController extends Controller {

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

        $isMobile = CustomHelper::isMobile();
        $bannerType = 'desktop';
        if($isMobile){
            $bannerType = 'mobile';
        }
        $bannerWhere = [];
        $bannerWhere['page'] = 'news';
        $bannerWhere['status'] = 1;
        $bannerWhere['device_type'] = $bannerType;
        $banners = Banner::where($bannerWhere)->orderBy('sort_order')->limit($limit)->get();

        $news_query = Blog::where(['status'=>1,'type'=>'news']);
        $news_query->orderBy('created_at', 'desc');

        /*if(!empty($cat_slug)){
            $blog_query->whereHas('Category', function ($query) use ($cat_slug){
                $query->where('slug', $cat_slug);
            });
        }
*/
        if(!empty($keyword)){
            $news_query->where('title', 'like', '%'.$keyword.'%');
        }

        $newsData = $news_query->paginate($limit);

        //prd($blogs->toArray());

        $newsCategoryQuery = BlogCategory::where(['status'=>1])->orderBy('sort_order')->limit(6);

        if(!empty($cat_slug)){
            $newsCategoryQuery->where('slug', $cat_slug);
        }
        
        $newsCategoryQuery->has('blogs', '>', 0);
        $newsCategories = $newsCategoryQuery->get();

        $data['newsData'] = $newsData;
        $data['newsCategories'] = $newsCategories;
        $data['cat_slug'] = $cat_slug;
        $data['banners'] = $banners;

        $data['meta_title'] = 'News';
        $data['meta_keyword'] = 'News';
        $data['meta_description'] = 'News';
        
        //return view('blogs.index', $data);
        return view('themes.'.$this->THEME_NAME.'.news.index', $data);
    }


    public function details(Request $request){

        //prd($request->toArray());
        //prd($request->slug);

        $data = [];

        $slug = (isset($request->slug))?$request->slug:'';

        if(!empty($slug)){
            $news = Blog::where(['slug'=>$slug, 'type'=>'news'])->first();

            //prd($news);

            if(isset($news->slug) && $news->slug == $slug){

                //$newsCategories = BlogCategory::where(['status'=>1,'type'=>'news'])->orderBy('name')->limit(6)->get();

                $recent_news = Blog::where('id', '!=', $news->id)->where(['status'=>1, 'type'=>'news'])->orderBy('created_at', 'desc')->limit(6)->get();

                $data['news'] = $news;
                //$data['BlogCategories'] = $BlogCategories;
                //$data['recent_blogs'] = $recent_blogs;
                 $data['recent_news'] = $recent_news;

                $data['meta_title'] = 'News - '.$news->meta_title;
                $data['meta_keyword'] = $news->meta_keyword;
                $data['meta_description'] = $news->meta_description;

                //return view('blogs.details', $data);
                return view('themes.'.$this->THEME_NAME.'.news.details', $data);                
            }
        }

        return back();

    }



/* End of Controller */
}