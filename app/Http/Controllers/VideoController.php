<?php

namespace App\Http\Controllers;

use App\CommonVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\CustomHelper;
use Mail;
use Validator;
use DB;


class VideoController extends Controller {

    private $limit = 20;
    private $THEME_NAME;

    public function __construct(){
        
        $this->THEME_NAME = CustomHelper::getThemeName();
    }

    public function index(Request $request){
        $data = [];

        $limit = $this->limit;

        $query = CommonVideo::where(['tbl_name'=>'gallery','tbl_id'=>0]);
        $query->orderBy('created_at', 'desc');

        $videos = $query->paginate($limit);

        $data['videos'] = $videos;
    
        $data['meta_title'] = 'Videos';
        $data['meta_keyword'] = 'Videos';
        $data['meta_description'] = 'Videos';

        return view('themes.'.$this->THEME_NAME.'.videos.index', $data);
    }


/* End of Controller */
}