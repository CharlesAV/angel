/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	
	// CSS
	config.contentsCss = ['/css/master.css'];

	// The toolbar groups arrangement, optimized for a single toolbar row.
	/*config.toolbarGroups = [
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'forms' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }
	];

	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	config.removeButtons = 'Subscript,Superscript';*/
	
	config.toolbar = 'Medium';
	config.toolbar_Medium =
	[
		['Source'],
		['Cut','Copy','Paste','RemoveFormat'],
		['Bold','Italic','Underline','Strike'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Outdent','Indent'],
		'/',
		['NumberedList','BulletedList'],
		['Image','Table','SpecialChar'],
		['Link','Unlink','Anchor'],
		['TextColor'],
		['Format','FontSize']
	];

	// Se the most common block elements.
	config.format_tags = 'p;h1;h2;h3;h4;h5;h6';
	
	// FontSizes
	config.fontSize_Sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;28/28px;36/36px';

	// Dialog windows are also simplified.
	//config.removeDialogTabs = 'link:advanced';

	// KCFinder
	config.filebrowserBrowseUrl 	 = window.config.base_url + 'packages/angel/core/js/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = window.config.base_url + 'packages/angel/core/js/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = window.config.base_url + 'packages/angel/core/js/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl 	 = window.config.base_url + 'packages/angel/core/js/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = window.config.base_url + 'packages/angel/core/js/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = window.config.base_url + 'packages/angel/core/js/kcfinder/upload.php?type=flash';

	// Remove filter
	config.allowedContent = true;

	config.baseHref = '';
};
