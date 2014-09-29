<?php

///////////////////////////////////////////////
//                  Admin                    //
///////////////////////////////////////////////

Route::group(array('prefix' => Config::get('core::admin_prefix'), 'before' => 'admin'), function() {
	Route::get('/', function() {
		Session::reflash();
		return Redirect::to(admin_uri('pages'));
	});

	//------------------------
	// AdminUserController
	//------------------------
	Route::group(array('prefix' => 'users'), function() {

		$controller = 'AdminUserController';

		Route::get('/', array(
			'uses' => $controller . '@index'
		));
		Route::get('add', array(
			'uses' => $controller . '@add'
		));
		Route::post('add', array(
			'before' => 'csrf',
			'uses' => $controller . '@attempt_add'
		));
		Route::get('edit/{id}', array(
			'uses' => $controller . '@edit'
		));
		Route::post('edit/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@attempt_edit'
		));
		Route::post('delete/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@delete'
		));
	});

	//------------------------
	// AdminSettingController
	//------------------------
	Route::group(array('prefix' => 'settings'), function() {

		$controller = 'AdminSettingController';

		Route::get('/', array(
			'uses' => $controller . '@index'
		));
		Route::post('/', array(
			'uses' => $controller . '@update'
		));
	});

	//------------------------
	// AdminPageController
	//------------------------
	Route::group(array('prefix' => 'pages'), function() {

		$controller = 'AdminPageController';

		Route::get('/', array(
			'uses' => $controller . '@index'
		));
		Route::get('add', array(
			'uses' => $controller . '@add'
		));
		Route::post('add', array(
			'before' => 'csrf',
			'uses' => $controller . '@attempt_add'
		));
		Route::get('edit/{id}', array(
			'uses' => $controller . '@edit'
		));
		Route::post('edit/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@attempt_edit'
		));
		Route::post('delete/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@delete'
		));
		Route::post('delete/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@delete'
		));
		Route::get('restore/{id}', array(
			'uses' => $controller . '@restore'
		));
		Route::post('copy', array(
			'before' => 'csrf',
			'uses' => $controller . '@copy'
		));
	});

	//------------------------
	// AdminMenuController
	//------------------------
	Route::group(array('prefix' => 'menus'), function() {

		$controller = 'AdminMenuController';

		Route::get('/', array(
			'uses' => $controller . '@index'
		));
		Route::get('add', array(
			'uses' => $controller . '@add'
		));
		Route::post('add', array(
			'before' => 'csrf',
			'uses' => $controller . '@attempt_add'
		));
		Route::get('edit/{id}', array(
			'uses' => $controller . '@edit'
		));
		Route::post('edit/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@attempt_edit'
		));
		Route::post('delete/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@delete'
		));
		Route::post('model-drop-down', array( // AJAX
			'uses' => $controller . '@model_drop_down'
		));

		Route::group(array('prefix' => 'items'), function() {

			$controller = 'AdminMenuItemController';

			Route::get('/', function() {
				Session::reflash();
				return Redirect::to(admin_uri('menus'));
			});
			Route::post('add', array(
				'before' => 'csrf',
				'uses' => $controller . '@attempt_add'
			));
			Route::post('order', array( // AJAX
				'uses' => $controller . '@order'
			));
			Route::get('edit/{id}', array(
				'uses' => $controller . '@edit'
			));
			Route::post('edit/{id}', array(
				'before' => 'csrf',
				'uses' => $controller . '@attempt_edit'
			));
			Route::post('delete/{id}/{ajax?}', array( // AJAX
				'uses' => $controller . '@delete'
			));
		});
	});

	//------------------------
	// AdminLinkController
	//------------------------
	Route::group(array('prefix' => 'links'), function() {

		$controller = 'AdminLinkController';

		Route::get('/', array(
			'uses' => $controller . '@index'
		));
		Route::get('add', array(
			'uses' => $controller . '@add'
		));
		Route::post('add', array(
			'before' => 'csrf',
			'uses' => $controller . '@attempt_add'
		));
		Route::get('edit/{id}', array(
			'uses' => $controller . '@edit'
		));
		Route::post('edit/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@attempt_edit'
		));
		Route::post('delete/{id}', array(
			'before' => 'csrf',
			'uses' => $controller . '@delete'
		));
	});
});

///////////////////////////////////////////////
//                Front End                  //
///////////////////////////////////////////////

//------------------------
// UserController
//------------------------
Route::get('signin', array(
	'before' => 'nonadmin',
	'uses' => 'UserController@signin'
));
Route::post('signin', array(
	'before' => 'csrf',
	'uses' => 'UserController@attempt_signin'
));
Route::get('signout', array(
	'before' => 'auth',
	'uses' => 'UserController@signout'
));
Route::get('login', array(
	'before' => 'guest',
	'uses' => 'UserController@login'
));
Route::group(array('before' => 'guest'), function() {
	Route::controller('password','RemindersController');
});

Route::get('/', 'PageController@show');

// We need to ensure that this is the -absolute- last route, otherwise
// we'll get caught in it before the router reaches other packages, due to the base-level URI variables.
// Thus far, wrapping it in an App::before seems to do the trick.
App::before(function() {
	Route::get('{url}/{section?}', 'PageController@show');
});

App::missing(function($exception) {
	$PageController = App::make('PageController');
	return $PageController->page_missing();
});

App::error(function(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
	$PageController = App::make('PageController');
	return $PageController->page_missing();
});