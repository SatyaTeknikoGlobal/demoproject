<?php

namespace App\Http\Controllers;

use App\CommonImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\CustomHelper;
use Mail;
use Validator;
use DB;


class GalleryController extends Controller {

    private $limit = 100;
    private $THEME_NAME;

    public function __construct(){
        
        $this->THEME_NAME = CustomHelper::getThemeName();
    }

    public function index(Request $request){
        $data = [];

        $limit = $this->limit;

        $query = CommonImage::where(['tbl_name'=>'gallery','tbl_id'=>0]);
        $query->orderBy('created_at', 'desc');

        $images = $query->paginate($limit);

        $data['images'] = $images;
    
        $data['meta_title'] = 'Gallery';
        $data['meta_keyword'] = 'Gallery';
        $data['meta_description'] = 'Gallery';

        return view('themes.'.$this->THEME_NAME.'.gallery.index', $data);
    }


/* End of Controller */
}