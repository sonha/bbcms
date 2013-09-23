/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
		{ name: 'styles' },
		{ name: 'colors' }
	];
	config.toolbar = [
		{ name: 'document', groups: [ 'mode', 'document' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo', 'align' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] }
	];


	// BinhBEER config toolbar
	config.toolbar_CusToolbar = [
		{ name: 'document', groups: [ 'mode', 'document' ], items: [ 'Source' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'align' ], items: [ 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'paragraph',   groups: [ 'list' ], items: [ 'NumberedList', 'BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'styles', items: [ 'Styles', 'Format' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'mediaembed', items: [ 'MediaEmbed' ] },
	];

	// BinhBEER config toolbar
	config.toolbar_MinToolbar = [
		{ name: 'clipboard', groups: [ 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', ] },
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'insert', items: [ 'Image' ] },
		{ name: 'mediaembed', items: [ 'MediaEmbed' ] },
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';
};
