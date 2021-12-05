<?php
namespace App\Http\Controllers\Admin;

use App\Menu;
use App\MenuItem;
use App\Category;
use App\Blog;
use App\Event;
use App\CmsPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Helpers\CustomHelper;

use Validator;

class MenuController extends Controller{

	private $limit;

	private $ADMIN_ROUTE_NAME;

	public function __construct(){
		$this->limit = 20;
		$this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

	}


	public function index(){ 
		$data = [];

		$limit = $this->limit;

		$menus = Menu::orderBy('id', 'desc')->paginate($limit);

		$data['menus'] = $menus;

		return view('admin.menus.index', $data);
	}


	public function add(Request $request){

		 // Creating the object User model 
		$data = [];

		$id = (isset($request->id))?$request->id:0;

		//prd($id);

		$menu = '';

		if(is_numeric($id) && $id > 0){
			$menu = Menu::find($id);
			if(!isset($menu->id) && $menu->id != $id){
				return back();
			}
		}

		if($request->method() == 'POST'){
			return $this->save($request, $id);
		}

		$page_heading = 'Add Menu';

		if(isset($menu->title)){
			$page_heading = 'Update Menu ('.$menu->title.')';
		}


		$data['page_heading'] = $page_heading;

		$data['menu'] = $menu;


		return view('admin.menus.form', $data);

	}
	
	
	private function save($request, $id=''){
		//echo 'save';
		//prd($request->toArray());

		$rules = [];
		$validation_msg = [];

		$rules['title'] = 'required';
		$rules['position'] = 'required';
		$rules['status'] = 'required|numeric';

		$this->validate($request, $rules, $validation_msg);

		$data = $request->except(['_token', 'id', 'back_url']);

		$title = $request->title;
		$back_url = $request->back_url;

		if(empty($back_url)){
			$back_url = $this->ADMIN_ROUTE_NAME.'/menus';
		}

		$slug = CustomHelper::GetSlug('menus', 'id', $id, $title);

		$data['slug'] = $slug;

		//prd($data);

		$menu = new Menu;

		if(is_numeric($id) && $id > 0){
			$exist = Menu::find($id);

			if(isset($exist->id) && $exist->id == $id){
				$menu = $exist;
			}
		}

		foreach($data as $key=>$val){
			$menu->$key = $val;
		}

		$isSaved = $menu->save();

		if($isSaved){
			return redirect(url($back_url))->with('alert-success', 'Menu has been saved successfully.');
		}
		else{
			return back()->withInput()->with('alert-danger', 'something went wrong, please try again.');
		}

	}

	// For Deleting
public function delete(Request $request, $id='')
{
	$logged_user_info=Common::UserData();
	if(Adminhelper::check_permission(array('delete'),$logged_user_info['permissions'], true)==false)
	{
		return redirect('admin/dashboard'); 

	} 

	$Model= new menu; 
	$MenuInfo=$Model ->find($id);
	$Model->destroy($id);

	   // Saving the log
	$Logged_User= Common::userdata(); 
	$action= 'Deleted the menu-'.$MenuInfo->title;
	Activitylog::saveLogs($user_id=$Logged_User['user_id'], $name=$Logged_User['user_name'], $email=$Logged_User['email'], $module_name='Menu', $action);

	DB::table('tbl_menus_items')->where(array('menu_id'=>$id))->delete();
	$request->session()->flash('succ_mess', 'Menu deleted successfully.');
	return redirect('admin/menus'); 
}


public function items(Request $request){

	$data = [];

	$id = (isset($request->id))?$request->id:0;
	$item_id = (isset($request->id))?$request->item_id:0;

	$menu = '';
	$menuItem = '';

	if(is_numeric($item_id) && $item_id > 0){
		$menuItem = MenuItem::find($item_id);
		if(!isset($menuItem->id) && $menuItem->id != $item_id){
			return back();
		}
	}

	//pr($menuItem->toArray());

	

	if(is_numeric($id) && $id > 0){
		$menu = Menu::find($id);

	}
	if(!isset($menu->id) && $menu->id != $id){
		return back();
	}

	if($request->method() == 'POST'){
		return $this->saveMenuItems($request, $id, $item_id);
	}

	$page_heading = $menu->title;

	$data['menu'] = $menu;
	$data['menuItem'] = $menuItem;
	$data['page_heading'] = $page_heading;

	return view('admin.menus.items', $data);

}

private function saveMenuItems($request, $id, $item_id=''){
		//echo 'saveMenuItems';
		//prd($request->toArray());

		$rules = [];
		$validation_msg = [];

		$rules['title'] = 'required';
		//$rules['position'] = 'required';
		//$rules['status'] = 'required|numeric';

		$this->validate($request, $rules, $validation_msg);

		//prd($request->toArray());

		$data = $request->except(['_token', 'id', 'back_url', 'item_id']);

		$title = $request->title;
		$back_url = $request->back_url;

		if(empty($back_url)){
			$back_url = $this->ADMIN_ROUTE_NAME.'/menus';
		}

		$slug = CustomHelper::GetSlug('menu_items', 'id', $item_id, $title);

		$data['slug'] = $slug;

		//prd($data);

		$menuItem = new MenuItem;

		if(is_numeric($item_id) && $item_id > 0){
			$exist = MenuItem::find($item_id);

			if(isset($exist->id) && $exist->id == $item_id){
				$menuItem = $exist;
			}
		}

		$menuItem->menu_id = $id;

		foreach($data as $key=>$val){
			$menuItem->$key = $val;
		}

		//prd($menuItem->toArray());

		$isSaved = $menuItem->save();

		if($isSaved){
			return redirect(url('admin/menus/items/'.$id))->with('alert-success', 'Menu Item(s) has been saved successfully.');
		}
		else{
			return back()->withInput()->with('alert-danger', 'something went wrong, please try again.');
		}

	}

	// ajax_get_link_type_list
public function ajaxGetLinkTypeList(Request $request){
	//prd($request->toArray());

	$response = [];
	$response['success'] = false;

	$link_type = (isset($request->link_type))?$request->link_type:'';
	$page_id = (isset($request->page_id))?$request->page_id:'';

	if(!empty($link_type)){

		$categories = '';
		$blogs = '';
		$news = '';
		$events = '';
		$cms_pages = '';

		if($link_type == 'category'){
			$categories = Category::where('status', 1)->get();
		}
		elseif($link_type == 'blog'){
			$blogs = Blog::where(['status'=>1, 'type'=>'blogs'])->get();
		}
		elseif($link_type == 'news'){
			$news = Blog::where(['status'=>1, 'type'=>'news'])->get();
		}
		elseif($link_type == 'event'){
			$events = Event::where(['status'=>1])->get();
		}
		elseif($link_type == 'cms'){
			$cms_pages = CmsPages::where(['status'=>1])->get();
		}

		$viewData = [];
		$viewData['link_type'] = $link_type;
		$viewData['page_id'] = $page_id;
		$viewData['categories'] = $categories;
		$viewData['blogs'] = $blogs;
		$viewData['news'] = $news;
		$viewData['events'] = $events;
		$viewData['cms_pages'] = $cms_pages;

		$list = view('admin.menus._link_type_list', $viewData)->render();

		$response['list'] = $list;
		$response['success'] = true;
	}


	return response()->json($response);
}




	// ajax_update_items
public function ajaxUpdateItems(Request $request){
	//prd($request->toArray());

	$response = [];
	$response['success'] = false;

	$item_id_arr = (isset($request->item_id))?$request->item_id:[];

	$save_count = 0;

	$message = '';

	if(!empty($item_id_arr) && count($item_id_arr) > 0){
		foreach($item_id_arr as $item_id=>$parent_id){

			$menuItem = MenuItem::find($item_id);

			if(isset($menuItem->id) && $menuItem->id == $item_id){
				$menuItem->parent_id = $parent_id;

				$isSaved = $menuItem->save();

				if($isSaved){
					$save_count++;
				}
			}
		}
	}

	if($save_count > 0){
		$message = '<div class="alert alert-success">Menu Items has been updated. </div>';
		$response['success'] = true;
	}
	else{
		$message = '<div class="alert alert-danger">something went wrong, please try again. </div>';
	}

	session()->flash('flash_msg', $message);

	$response['msg'] = $message;


	return response()->json($response);
}


	// ajax_delete_item
public function ajaxDeleteItem(Request $request){
	//prd($request->toArray());

	$response = [];
	$response['success'] = false;

	$item_id = (isset($request->id))?$request->id:0;

	$isDeleted = '';
	$message = '';

	if(is_numeric($item_id) && $item_id > 0){
		$menuItem = MenuItem::find($item_id);

		if(isset($menuItem->id) && $menuItem->id == $item_id){
			$isDeleted = $menuItem->delete();
			if($isDeleted){
				MenuItem::where('parent_id', $item_id)->delete();
			}
		}
	}

	if($isDeleted){
		$message = '<div class="alert alert-success">Menu Item(s) has been deleted. </div>';
		$response['success'] = true;
	}
	else{
		$message = '<div class="alert alert-danger">something went wrong, please try again. </div>';
	}

	session()->flash('flash_msg', $message);

	//$response['msg'] = $message;


	return response()->json($response);
}



	

/* end of controller */
}  