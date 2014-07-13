<?php namespace Angel\Core;

use App, Input, Redirect;

class AdminMenuItemController extends AdminCrudController {

	protected $model	= 'MenuItem';
	protected $uri		= 'menus/items';
	protected $plural	= 'items';
	protected $singular	= 'item';
	protected $package	= 'core';

	public function attempt_add()
	{
		$menuItemModel = App::make('MenuItem');

		$order = $menuItemModel::where('menu_id', Input::get('menu_id'))->count();

		$menu_item = new $menuItemModel;
		$menu_item->order	= $order;
		$menu_item->menu_id = Input::get('menu_id');
		$menu_item->fmodel	= Input::get('fmodel');
		$menu_item->fid		= Input::get('fid');
		$menu_item->save();

		return Redirect::to(admin_uri('menus'))->with('success', '
			<p>Link created.</p>
		');
	}

	/**
	 * AJAX for reordering menu items
	 */
	public function order()
	{
		$menuItemModel = App::make('MenuItem');

		$orders = Input::get('orders');
		$menu_items = $menuItemModel::whereIn('id', array_keys($orders))->get();
		foreach($menu_items as $menu_item) {
			$menu_item->order = $orders[$menu_item->id];
			//echo "Item: " . $menu_item->id . " | Order: " . $orders[$menu_item->id] . "\n";
			$menu_item->save();
		}
		return 1;
	}

	public function edit($id)
	{
		$menuModel = App::make('Menu');

		$menus = $menuModel::all();
		$menu_list = array(''=>'None');
		foreach ($menus as $menu) {
			$menu_list[$menu->id] = $menu->name;
		}
		$this->data['menu_list'] = $menu_list;

		return parent::edit($id);
	}

	/**
	 * @param array &$errors - The array of failed validation errors.
	 * @return array - A key/value associative array of custom values.
	 */
	public function validate_custom($id = null, &$errors)
	{
		$menuItemModel = App::make('MenuItem');

		//if (!$id) return array();
		$menu_item = $menuItemModel::findOrFail($id);
		if (Input::get('child_menu_id') == $menu_item->menu_id) {
			$errors[] = 'The child menu cannot be the same as the parent menu.  A recursive loop would occur.';
		}
		if ($menuItemModel::where('child_menu_id', $menu_item->menu_id)->count()) {
			$errors[] = 'A child menu cannot have a child menu nested within it.';
		}
		if (!Input::get('child_menu_id')) {
			return array(
				'child_menu_id' => null
			);
		}
	}
}