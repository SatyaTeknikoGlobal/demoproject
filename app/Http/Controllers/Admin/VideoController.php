<?php

namespace App\Http\Controllers\Admin;

use App\CommonVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\CustomHelper;
use Illuminate\Validation\Rule;

use Validator;
use DB;
use Storage;
use Image;
use Hash;

class VideoController extends Controller {

    private $limit;
    private $ADMIN_ROUTE_NAME;

    private static $_invalidCharacters = array('*', ':', '/', '\\', '?', '[', ']');

    public function __construct(){
        //die;
        $this->limit = 20;

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }


    public function add(Request $request){
        //prd($request->toArray());
        $data = [];
        $videos = '';

        $tbl_id = (isset($request->tid))?$request->tid:0;
        $tbl_name = (isset($request->tbl))?$request->tbl:'';

        $videos = CommonVideo::where(['tbl_id'=>$tbl_id, 'tbl_name'=>$tbl_name])->get();

        $data['page_heading'] = 'Upload Images';
        $data['tbl_id'] = $tbl_id;
        $data['tbl_name'] = $tbl_name;
        $data['videos'] = $videos;
        return view('admin.videos.index', $data);
       
    }

    /* ajax_save */
    public function ajaxSave(Request $request){
        //prd($request->toArray());

        $response = [];
        $response['success'] = false;

        $method = $request->method();

        $isSaved = false;

        if($method == 'POST' || $method == 'post'){
            //prd($request->toArray());

            $ids_arr = (isset($request->ids))?$request->ids:[];
            $title_arr = (isset($request->title))?$request->title:[];
            $link_arr = (isset($request->link))?$request->link:[];
            $sort_order_arr = (isset($request->sort_order))?$request->sort_order:[];
            $featured_arr = (isset($request->featured))?$request->featured:[];

            $vid = (isset($request->vid))?$request->vid:0;
            $tbl = (isset($request->tbl))?$request->tbl:'';

            $isSaved = false;


            foreach($title_arr as $title_key=>$title_val){

                $title = trim($title_val);
                $link = (isset($link_arr[$title_key]))?$link_arr[$title_key]:'';
                $sort_order = (isset($sort_order_arr[$title_key]))?$sort_order_arr[$title_key]:'';
                $featured = (isset($featured_arr[$title_key]))?$featured_arr[$title_key]:'';

                $id = (isset($ids_arr[$title_key]))?$ids_arr[$title_key]:0;

                $tbl_name = (isset($tbl))?$tbl:'';
                $vid = (isset($vid))?$vid:'';

                $videoData = [];

                $video = new CommonVideo;

                if(is_numeric($id) && $id > 0){
                    $exist = CommonVideo::find($id);
                    if(isset($exist->id) && $exist->id == $id){
                        $video = $exist;
                    }
                }

                $video->tbl_id = $vid;
                $video->tbl_name = $tbl_name;
                $video->title = $title;
                $video->link = $link;
                $video->sort_order = $sort_order;
                $video->featured = $featured;
                $isSaved = $video->save();

            }

            if($isSaved){
                $response['success'] = true;
            }
           
        }

        return response()->json($response);
    }



    /* ajax_delete_video */
    public function ajaxDelete(Request $request){
        //prd($request->toArray());

        $response = [];
        $response['success'] = false;

        $video_id = (isset($request->video_id))?$request->video_id:'';

        if(is_numeric($video_id) && $video_id > 0){

            $is_deleted = '';
            $video = CommonVideo::find($video_id);

            if(!empty($video) && count($video) > 0){
               $is_deleted = $video->delete();
            }

            if($is_deleted){
                $response['success'] = true;
            }
        }

        return response()->json($response);
    }


/* End of controller */
}