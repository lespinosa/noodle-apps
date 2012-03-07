<?php 
$this->Ckeditor->basePath ='/js/ckeditor/';
$this->Ckeditor->config['width'] = '97%';

	switch ($type) {
	  case 'Full':
		$this->Ckeditor->config['toolbar'] = array(
			array('Source', '-', 'DocProps','Preview','Print','-','Templates'),
			array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
			array('Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'),
			array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'),
			array('NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-'
			,'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl'),
			array('Link','Unlink','Anchor'),
			array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'),
			array('Styles','Format','Font','FontSize'),
			array('TextColor','BGColor'),
			array('Maximize', 'ShowBlocks','-','About')
		);
		break;
	  
	  default:
	  case 'Basic':
		$this->Ckeditor->config['toolbar'] = 'Basic';
		break;
	}
$this->Ckeditor->replace($replace);
?>