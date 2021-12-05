<?php
namespace App\Http\Controllers\Admin;

use App\Form;
use App\FormElement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Storage;
use DB;

class FormController  extends Controller {

    //protected $foo;

   protected $select_cols;
   protected $ADMIN_ROUTE_NAME;
   private $limit;

    public function __construct(){
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
        $this->limit = 20;
    }

    public function index(Request $request) {

        $data = [];
        $limit = $this->limit;
        $parent_id = (isset($request->parent_id))?$request->parent_id:0;

        $form_query = Form::orderBy('created_at','desc');      
        $forms = $form_query->paginate($limit);

        $data['forms'] = $forms;
        
        return view('admin.forms.index',$data);
    }


    public function add(Request $request){
        $id = (isset($request->id))?$request->id:0;
        $parent_id = (isset($request->parent_id))?$request->parent_id:0;
        $form = [];
        $title = '';
     
        if(is_numeric($id) && $id > 0){
            $form = Form::find($id);
            $title = 'Edit Form('.$form->name." )";
        }
        else{
            $title = 'Add Form';
        }

        if($request->method() == 'POST' || $request->method() == 'post'){
            //prd($request->toArray());
            return $this->save($request, $form, $id);
        }
        $data = [];
        $data['page_heading'] = $title;
        $data['form'] = $form;
        $data['id'] = $id;
        $data['parent_id'] = $parent_id;

        $formElementQuery = DB::table('form_elements');

        $formElementQuery->where('is_static',1);

        if(isset($form->id) && $form->id == $id){
            
            $formElementQuery->orWhere('form_id',$id);
        }

        $formElements = $formElementQuery->get();

        //prd($formElements->toArray());

        // Fixed Fields
        $data['form_elements'][] = (object) array('field_label'=>'Name','field_type'=>'1','validations'=>'required','data'=>'','id'=>'');
        $data['form_elements'][] = (object) array('field_label'=>'Email','field_type'=>'8','validations'=>'required','data'=>'','id'=>'');
        $data['form_elements'][] = (object) array('field_label'=>'Phone','field_type'=>'1','validations'=>'required','data'=>'','id'=>'');

        $data['formElements'] = $formElements;
        $data['form_attribute'] = DB::table('form_attributes')->where('status',1)->get();

        return view('admin.forms.form', $data);
    }


    public function save(Request $request, $form, $id){
        //prd($request->toArray());

        $back_url = (isset($request->back_url))?$request->back_url:'';
        if(empty($back_url)){
            $back_url = 'admin/forms';
        }

        $rules = [];
        $validation_msg = [];

        //$rules['type'] = 'required';
        $rules['name'] = 'required';
        $rules['status'] = 'required';
        $rules['template'] = 'required';
        $this->validate($request, $rules, $validation_msg);

        $req_data = [];

        //$req_data = $request->except(['_token', 'id','back_url']);

        $slug = CustomHelper::GetSlug('forms', 'id', $id, $request->name);

        $req_data['slug'] = $slug;
        $req_data['name'] = $request->name;
        $req_data['thank_you_msg'] = $request->thank_you_msg;
        $req_data['lat_lang'] = $request->lat_lang;
        $req_data['top_left_content'] = $request->top_left_content;
        $req_data['top_right_content'] = $request->top_right_content;
        $req_data['bottom_content'] = $request->bottom_content;
        $req_data['template'] = $request->template;
        $req_data['captcha'] = $request->captcha;
        $req_data['status'] = $request->status;
        //prd($req_data);

        if(!empty($form) && count($form) > 0 && $form->id == $id){
            $isSaved = Form::where('id', $form->id)->update($req_data);
        }
        else{
            $isSaved = Form::create($req_data);
            $id = $isSaved->id;
        }

        if(is_numeric($id) && $id > 0){
            
            $is_static_arr = (isset($request->is_static))?$request->is_static:[];
            $field_label_arr = (isset($request->field_label))?$request->field_label:[];
            $field_type_arr = (isset($request->field_type))?$request->field_type:[];
            $validations_arr = (isset($request->validations))?$request->validations:[];
            $data_arr = (isset($request->data))?$request->data:[];

            $form_element_ids_arr = (isset($request->form_element_ids))?$request->form_element_ids:[];

            foreach ($field_label_arr as $fKey => $label){

                //$field_label = (isset($field_label_arr[$fKey]))?$field_label_arr[$fKey]:'';
                $field_type = (isset($field_type_arr[$fKey]))?$field_type_arr[$fKey]:'';
                $validation = (isset($validations_arr[$fKey]))?$validations_arr[$fKey]:'';
                $data = (isset($data_arr[$fKey]))?$data_arr[$fKey]:'';

                $is_static = (isset($is_static_arr[$fKey]))?$is_static_arr[$fKey]:0;
                $element_id = (isset($form_element_ids_arr[$fKey]))?$form_element_ids_arr[$fKey]:'';
                
                $elementData = [];

                $element = new FormElement;

                if(is_numeric($element_id) && count($element_id) > 0){
                    $exist = FormElement::find($element_id);

                    if(isset($exist->id) && $exist->id == $element_id){
                        $element = $exist;
                    }
                }

                if(!isset($element->is_static) || $element->is_static != '1'){
                    $element->form_id = $id;
                }

                $element->label = $label;
                $element->type = $field_type;
                $element->validation = $validation;
                $element->is_static = $is_static;
                $element->data = $data;
                

                $isSaved = $element->save();

            }
        }
       
        if ($isSaved) {
            //$this->saveCategories($request, $product_id);
            return redirect(url($back_url))->with('alert-success', 'The Form has been saved successfully.');
        }
        else{
            return back()->with('alert-danger', 'The Form cannot be added, please try again or contact the administrator.');
        }

    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $method = $request->method();
        $is_deleted = 0;

        if($method=="POST"){
         if(is_numeric($id) && $id > 0)
         {
            $form = Form::find($id);
            if(!empty($form) && count($form) > 0){

                $formEle = FormElement::where('form_id',$id)->delete();
                $is_deleted = $form->delete();
            }
        }
    }
         
    if($is_deleted){
        return redirect(url($this->ADMIN_ROUTE_NAME.'/forms'))->with('alert-success', 'The Form has been deleted successfully.');
    }else
    {
        return redirect(url($this->ADMIN_ROUTE_NAME.'/forms'))->with('alert-danger', 'The Form cannot be deleted, please try again or contact the administrator.');
    }

}

    /* ajax_delete_element */
    public function ajaxDeleteElement(Request $request){
        //prd($request->toArray());

        $response = [];
        $response['success'] = false;

        $form_element_id = (isset($request->form_element_id))?$request->form_element_id:0;

        if(is_numeric($form_element_id) && $form_element_id > 0){
            $formElement = FormElement::find($form_element_id);

            if(isset($formElement->id) && $formElement->id == $form_element_id){
                $isDeleted = $formElement->delete();

                if($isDeleted){
                    $response['success'] = true;
                }
            }
        }

        return response()->json($response);
    }


// End of controller
}
?>