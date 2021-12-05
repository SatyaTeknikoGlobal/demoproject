<?php

namespace App\Http\Controllers;

use App\Form;
use App\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\CustomHelper;
use Mail;
use Validator;
use DB;
use Storage;

class FormController extends Controller {

    private $limit = 20;
    private $THEME_NAME;
    private $ADMIN_ROUTE_NAME;

    public function __construct(){
        
        $this->THEME_NAME = 'themes.'.CustomHelper::getThemeName();
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

    public function index(Request $request){

        //prd($request->toArray());
        //prd($request->slug);
        $data = [];
        $slug = (isset($request->slug))?$request->slug:'';


        if(!empty($slug)){
            $form = Form::where(['slug'=>$slug, 'status'=>1])->first();

            if(isset($form->slug) && $form->slug == $slug){

             if($request->method() == 'POST' || $request->method() == 'post'){
                return $this->save($request, $form);
            }
                $formElementQuery = DB::table('form_elements');

                $formElementQuery->where('is_static',1);

                if(isset($form->id) && $form->id > 0){

                    $formElementQuery->orWhere('form_id',$form->id);
                }

                $formElements = $formElementQuery->get();
                $data['formElements'] = $formElements;

                $data['form'] = $form;
                $data['meta_title'] = 'forms';
                $data['meta_keyword'] = 'forms';
                $data['meta_description'] = 'forms';

                if(!empty($form->template)){
                return view($this->THEME_NAME.'.templates.'.$form->template, $data);
                }

                //return view('blogs.details', $data);
                return view($this->THEME_NAME.'.templates.forms.default', $data);                
            }
        }

        return back();
    }

    private function save($request, $form){

        $isSaved = '';
        //prd($request->all());
        //if($request->method() == 'POST' || $request->method() == 'post'){
            $dataArr = [];

            $elementIdsArr = [];
            foreach($request->toArray() as $inpKey=>$inpVal){
                $eleId = str_replace('input','',$inpKey);
                if(is_numeric($eleId) && $eleId > 0){
                    $elementIdsArr[] = $eleId;
                }
            }

            $rules = [];
            $attributesNames = [];
            $message = [];

            if(!empty($elementIdsArr) && count($elementIdsArr) > 0){
                $formElements = DB::table('form_elements')->whereIn('id', $elementIdsArr)->get();

                if(!empty($formElements) && count($formElements) > 0){
                    foreach($formElements as $fe){
                        $dataArr[] = ['label'=>$fe->label, 'value'=>$request['input'.$fe->id], 'type'=>$fe->type];
                        if($fe->validation == 'required'){
                            $rules['input'.$fe->id] = 'required';

                            $attributesNames['input'.$fe->id] = $fe->label;
                        }
                    }
                }
            }

            if($form->captcha =='1'){
               $rules['scode'] = 'required|captcha';
               $message['scode.captcha'] = "Invalid Captcha";
            }
            //prd($dataArr);
            
            //prd($request->file());
            
            $validation_msg = [];

            //$this->validate($request, $rules, $validation_msg);

            $validator = Validator::make($request->all(), $rules,$message);

            $validator->setAttributeNames($attributesNames);

            if($validator->fails()){
                return back()->withInput()->withErrors($validator->errors());
            }
            else{

                $filename = '';
                if($request->file()){
                    foreach($request->file() as $inputName=>$file){
                        $filename = $inputName;
                        $file = $file;
                    }
                }

                 //prd($file);

                $reqData = [];
                $data = [];
                $reqData = $request->except(['_token','submit',$filename,'form_id']);
                $serilizeData = serialize($reqData);
                //prd($reqData);
                $data['data'] = $serilizeData;
                $data['form_id'] = $request->form_id;

                $isSaved = Enquiry::create($data);
                $id = $isSaved->id;
                
            }
            if ($isSaved) {

                if(!empty($request->hasFile($filename))){
                    $file = $request->file($filename);

                    if(!empty($file)){
                        $pdf_result = $this->savePdf($file,$id);
                        if($pdf_result['success']){
                            $file_name = $pdf_result['file_name'];
                        }
                    }
                }
                
                $params = [];
                $subject = 'Contact Form';
                
                $emailData['dataArr'] = $dataArr;

                $ADMIN_EMAIL = CustomHelper::WebsiteSettings('ADMIN_EMAIL');
                if(empty($ADMIN_EMAIL)){
                    $ADMIN_EMAIL = config('custom.admin_email');
                }

                $from_email = $ADMIN_EMAIL;
                $email = '';
                $to_email = $ADMIN_EMAIL;

                if(!empty($file_name)){
                    $file_path = public_path('storage/careers/'.$file_name);
                    //prd($file_path);
                    $params['attachment'] = $file_path;
                }
                //$view_html = view('emails.contact',$emailData)->render();

                //echo $view_html; die;

                $isMail = CustomHelper::sendEmail('emails.contact', $emailData, $to=$to_email, $from_email, $replyTo = $from_email, $subject,$params);
                //prd($isMail);
                $msg = $form->thank_you_msg;
                return back()->with('alert-success', $msg);
            } else {
               
            }
        //}
    }


    public function savePdf($file, $id){
        //pr($file); 
        //echo $id; die;
        $result['org_name'] = '';
        $result['file_name'] = '';

        if ($file) 
        {
            $path = 'careers';
            
            $uploaded_data = CustomHelper::UploadFile($file, $path, $ext='');

            if($uploaded_data['success']){
                $new_pdf = $uploaded_data['file_name'];

                if(is_numeric($id) && $id > 0){
                    $enquiry = Enquiry::find($id);

                    if(!empty($enquiry) && count($enquiry) > 0){

                        $storage = Storage::disk('public');

                        $enquiry->document = $new_pdf;

                        $isUpdated = $enquiry->save();

                        /*if($isUpdated){

                            if(!empty($old_pdf) && $storage->exists($path.$old_pdf)){
                                $storage->delete($path.$old_pdf);
                            }
                        }*/
                    }
                }
            }

            if(!empty($uploaded_data))
            {   
                return $uploaded_data;
            }
        }
    }


/* End of Controller */
}