<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\User;
use App\ProductImage;
use App\ColorsMaster;

use App\NewsletterSubscriber;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Storage;

use App\Helpers\CustomHelper;

use Image;
use DB;

class NewsletterController extends Controller{


    private $limit;
    private $ADMIN_ROUTE_NAME;

    public function __construct(){
        $this->limit = 20;
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

    public function index(Request $request){

        $data = [];

        $limit = $this->limit;

        $export_xls = (isset($request->export_xls))?$request->export_xls:'';

        $newsletterQuery = NewsletterSubscriber::orderBy('id', 'desc');

        $newsletters = $newsletterQuery->paginate($limit);

        $data['newsletters'] = $newsletters;
        $data['limit'] = $limit;

        if(!empty($export_xls) && ($export_xls == 1 || $export_xls == '1') ){
            //prd($newsletters);
            return $this->exportXls($newsletterQuery);
        }

        return view('admin.newsletter.index', $data);

    }

    public function delete(Request $request){

        $method = $request->method();

        if($method == 'POST'){
            //prd($request->toArray());

            $id = (isset($request->id))?$request->id:0;

            if(is_numeric($id) && $id > 0){

                $newsletter = NewsletterSubscriber::find($id);

                if(isset($newsletter->id) && $newsletter->id == $id){
                    $newsletter->delete();
                    return back()->with('alert-success', 'Newsletter Subscriber deleted successfully.');
                }
            }
        }

        return back()->with('alert-danger', 'something went wrong, please try again...');
       
    }



    private function exportXls($newsletterQuery){

        //$fieldNames = $newsletterQuery->getModel()->getFillable();

        $select = ['id', 'email'];

        $newsletters = $newsletterQuery->select($select)->get();

        $fileName = 'newsletter_'.date('Y-m-d-H-i-s').'.xlsx';

        $viewData = [];
        $viewData['newsletters'] = $newsletters;

        //$viewHtml = view('admin.newsletter._newsletter_export', $viewData)->render();

        //echo $viewHtml; die;       

        header('Content-Type: application/vnd.ms-excel');
        //tell browser what's the file name
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        //no cache
        header('Cache-Control: max-age=0');

        return view('admin.newsletter._newsletter_export', $viewData);
    }

    /* end of controller */
}