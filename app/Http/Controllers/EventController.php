<?php

namespace App\Http\Controllers;

use App\Event;
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


class EventController extends Controller {

    private $limit = 20;
    private $THEME_NAME;

    public function __construct(){
        
        $this->THEME_NAME = CustomHelper::getThemeName();
    }

    public function index(Request $request){
        $data = [];

        $limit = $this->limit;

        $event_query = Event::where('status', 1);
        $event_query->orderBy('created_at', 'desc');

        $events = $event_query->paginate($limit);

        $data['events'] = $events;


        $isMobile = CustomHelper::isMobile();
        $bannerType = 'desktop';
        if($isMobile){
            $bannerType = 'mobile';
        }
        $bannerWhere = [];
        $bannerWhere['page'] = 'event';
        $bannerWhere['status'] = 1;
        $bannerWhere['device_type'] = $bannerType;
        $banners = Banner::where($bannerWhere)->orderBy('sort_order')->limit($limit)->get();
        
        $data['banners'] = $banners;
        $data['meta_title'] = 'Events';
        $data['meta_keyword'] = 'Events';
        $data['meta_description'] = 'Events';
        
        //return view('blogs.index', $data);
        return view('themes.'.$this->THEME_NAME.'.events.index', $data);
    }


    public function details(Request $request){

        //prd($request->toArray());
        //prd($request->slug);

        $data = [];

        $slug = (isset($request->slug))?$request->slug:'';

        if(!empty($slug)){
            $event = Event::where('slug', $slug)->first();

            if(isset($event->slug) && $event->slug == $slug){

                $data['event'] = $event;
                $data['meta_title'] = 'Events - '.$event->meta_title;
                $data['meta_keyword'] = $event->meta_keyword;
                $data['meta_description'] = $event->meta_description;

                //return view('blogs.details', $data);
                return view('themes.'.$this->THEME_NAME.'.events.details', $data);                
            }
        }

        return back();

    }



/* End of Controller */
}