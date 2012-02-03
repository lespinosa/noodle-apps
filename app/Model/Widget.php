<?php

/**
 * Widget.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
class Widget extends AppModel
{
	public $name = "Widget";
	var $belongsTo = array('Engadget', 'User', 'Role');
	
	function parentNode(){
		return null;
	}
}
