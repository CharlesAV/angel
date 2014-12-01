<?php namespace Angel\Core;

use Illuminate\Database\Eloquent\Collection;
use Mobile_Detect, ToolBelt, ReflectionClass;
use Input, Session, App, Config, Auth;

class AngelController extends \BaseController {

	protected $settings;

	protected $data = array(
		'error'   => array(),
		'success' => array(),
		'mobile'  => false
	);

	protected $mobile = false;

	public function __construct()
	{
		// Call the parent's (BaseController's) constructor if it exists
		$reflection = new ReflectionClass(__CLASS__);
		if (method_exists($reflection->getParentClass()->name, '__construct')) {
			parent::__construct();
		}

		// Are we on a mobile device?
		$detect = new Mobile_Detect;
		if (($detect->isMobile() || Input::get('mobile')) && !Input::get('desktop')) {
			$this->mobile         = true;
			$this->data['mobile'] = true;
		}

		// Get all error and success messages for alerting the user
		// (In alerts.blade.php, which is loaded into both the front-end and admin templates)
		if (Session::has('errors')) {
			foreach(Session::get('errors')->all() as $message) {
				$this->data['error'][] = $message;
			}
		}
		if (Session::has('success')) {
			if (is_array(Session::get('success'))) {
				$this->data['success'] = Session::get('success');
			} else {
				$this->data['success'][] = Session::get('success');
			}
		}

		///////////////////////////////////////////////
		//               Global Input                //
		///////////////////////////////////////////////
		if (Input::exists('pq') && Auth::check() && Auth::user()->is_superadmin()) {
			App::after(function() {
				ToolBelt::print_queries();
			});
		}
		if (Input::exists('ps') && Auth::check() && Auth::user()->is_superadmin()) {
			ToolBelt::debug(Session::all());
		}
		if (Input::exists('fs')) {
			Session::flush();
		}

		///////////////////////////////////////////////
		//           Global View Bindings            //
		///////////////////////////////////////////////
		$this->data['Menu'] = App::make('Menu');

		///////////////////////////////////////////////
		//                Settings                   //
		///////////////////////////////////////////////
		$Setting                = App::make('Setting');
		$this->settings         = $Setting::currentSettings();
		$this->data['settings'] = $this->settings;
	}

	public function global_search($search)
	{
		$results = new Collection;

		$terms = explode(' ', $search);
		if (!count($terms)) return $results;

		foreach ($terms as &$term) {
			$term = '%' . $term . '%';
		}

		foreach (Config::get('core::linkable_models') as $model=>$uri) {
			$Model = App::make($model);

			$Model->search($terms)->each(function($result) use ($results) {
				$results->add($result);
			});
		}

		return $results;
	}
	
	function file_upload($file,$path) {
		if(!$file or !$path) return;
		
		// Path
		$path_public = public_path();
		$path = str_replace($path_public,'',$path);
		if(substr($path,0,1) != "/") $path = "/".$path;
		if(substr($path,-1) != "/") $path .= "/";
		
		// Extension
		$extension = $file->getClientOriginalExtension();
		
		// Name
		$name = $file->getClientOriginalName();
		$name_base = basename($name ,".".$extension);
		
		// Exists?
		$x = 0;
		while(file_exists($path_public.$path.$name)) {
			$name = $name_base.'_'.$x.'.'.$extension;
			$x++;
		}
		
		// Move
		try {
			$file->move($path_public.$path,$name);
		}
		catch(Exception $e) {
			//print "error uploading file: ".$e->getMessage()."<br />";
			//exit;
		}
		
		// Return
		return $path.$name;
	}

}