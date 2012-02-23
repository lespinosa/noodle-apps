/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.height = 250;

	//config.toolbar = 'Full';
	config.uiColor = '#F6F6F6';
	config.toolbar_Full =
		[
		    { name: 'document',    items : [ 'Source','-','DocProps','Preview','Print','-','Templates' ] },
		    { name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		    { name: 'editing',     items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },		    '/',
		    { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','-','RemoveFormat' ] },
		    { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		    { name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
		    { name: 'insert',      items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
		
		    { name: 'styles',      items : [ 'Styles','Format' ] },
		    { name: 'colors',      items : [ 'TextColor','BGColor' ] },
		    { name: 'tools',       items : [ 'Maximize', 'ShowBlocks','-','About' ] }
		];
};
