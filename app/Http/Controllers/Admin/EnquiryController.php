<?php

namespace App\Http\Controllers\Admin;

use App\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EnquiryController extends Controller
{
    private $limit;

    public function __construct()
    {
        $this->limit = 20;
    }

    public function index(Request $request)
    {

        $data = [];

        $limit = $this->limit;
        $s_query = Enquiry::orderBy('id', 'desc');
        $enquiries = $s_query->paginate($limit);
        $data['res'] = $enquiries;     
        $data['limit'] = $limit;

        return view('admin.enquiries.list', $data);

    }

    public function view(Request $request)
    {   
        $data = [];
        $id = isset($request->id)?$request->id:0;

        if(is_numeric($id) && $id > 0){
            $enquiry = Enquiry::find($id);
        }
        $data['enquiry'] = $enquiry;
        return view('admin.enquiries.view', $data);

    }


    public function delete(Request $request)
    {   
        $id = isset($request->id)?$request->id:0;
        //prd($id);
        if(is_numeric($id) && $id > 0){
        $model = Enquiry::find($id);
        $model->delete();
        return back()->with('alert-success', 'Enquiry deleted successfully.');
        }

        else{
            return back()->with('alert-danger', 'The Enquiry cannot be Deleted, please try again or contact the administrator.');
        }
       
    }

    /* end of controller */
}