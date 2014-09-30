<?php namespace Angel\Core;

use Auth, View, Validator, Input, Redirect;

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
			return Redirect::intended($redirect);
		}

		return Redirect::to($url)->withInput()->withErrors('Login attempt failed.');
	}
}