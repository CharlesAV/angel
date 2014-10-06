<?php namespace Angel\Core;

use Auth, View, Validator, Input, Redirect, App, Hash;

class UserController extends AngelController {

	public function signin()
	{
		return View::make('core::admin.signin', $this->data);
	}

	public function login()
	{
		return View::make('core::login', $this->data);
	}

	public function signout()
	{
		// Redirect
		$redirect = Input::get('redirect');
		if(!$redirect) $redirect = admin_uri();
		
		Auth::logout();
		return Redirect::to($redirect)->with('success', 'You have been signed out.');
	}
	
	public function attempt_signin()
	{
		// URL
		$url = Input::get('url');
		if(!$url) $url = admin_uri();
		
		// Redirect
		$redirect = Input::get('redirect');
		if(!$redirect) $redirect = admin_uri();
		
		Auth::logout();

		$rules = array(
			'loguser' => 'required',
			'logpass' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to($url)->withInput()->withErrors($validator);
		}

		// Users can use either their username or their email to login, so
		// we'll have to do 2 checks.
		$usernameCheck = array(
			'username' => Input::get('loguser'),
			'password' => Input::get('logpass')
		);
		$emailCheck = array(
			'email'    => Input::get('loguser'),
			'password' => Input::get('logpass')
		);

		if (Auth::attempt($usernameCheck, Input::get('remember')) ||
			Auth::attempt($emailCheck, Input::get('remember'))) {
			return Redirect::intended($redirect)->with('success', 'You have successfully logged in.');
		}

		return Redirect::to($url)->withInput()->withErrors('Login attempt failed.');
	}

	public function register()
	{
		return View::make('core::register', $this->data);
	}

	function attempt_register() {
		// Validate
		$validate = array(
			'email' => 'required',
			'username' => 'required',
			'password' => 'required|confirmed'
		);
		$validator = Validator::make(Input::all(), $validate);
		$errors = ($validator->fails()) ? $validator->messages()->toArray() : array();
		if (count($errors)) {
			return Redirect::to($this->uri('add'))->withInput()->withErrors($errors);
		}
		
		// Save
		$User = App::make('User');
		$user = new $User;
		$columns = array(
			'email',
			'username',
			'password',
			'type'
		);
		foreach($columns as $column) {
			$value = Input::get($column);
			if(is_array($value)) $value = json_encode($value);
			if($column == "password") $value = Hash::make($value);
			$user->{$column} = $value;
		}
		if(!$user->type) $user->type = "user";
		$user->save();
		
		// Login
		Auth::loginUsingId($user->id);
		
		// Redirect
		$redirect = Input::get('redirect');
		if(!$redirect) $redirect = "/";
		return Redirect::to($redirect)->with('success',"You've sucessfully registered!");
	}
}