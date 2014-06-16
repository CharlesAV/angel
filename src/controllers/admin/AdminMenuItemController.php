<?php

class AdminMenuItemController extends AdminCrudController {

	public $model		= 'MenuItem';
	public $uri			= 'menus';
	public $sub_uri		= 'items';
	public $plural		= 'items';
	public $singular	= 'item';
	public $package		= 'core';

	/**
	 * AJAX for reordering menu items
	 */
	public function order()
	{
		$orders = Input::get('orders');
		$menu_items = MenuItem::whereIn('id', array_keys($orders))->get();
		foreach($menu_items as $menu_item) {
			$menu_item->order = $orders[$menu_item->id];
			//echo "Item: " . $menu_item->id . " | Order: " . $orders[$menu_item->id] . "\n";
			$menu_item->save();
		}
		return 1;
	}

	public function edit($id)
	{
		$menus = Menu::all();
		$menu_list = array('0'=>'None');
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
		if (!$id) return array();
		$menu_item = MenuItem::findOrFail($id);
		if (Input::get('child_menu_id') == $menu_item->menu_id) {
			$errors[] = 'The child menu cannot be the same as the parent menu. (Recursive loop)';
		}
	}
}