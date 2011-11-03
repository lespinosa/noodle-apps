<?php

/**
 * content.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
class Content extends AppModel
{
	public $name = 'Content';
	var $belongsTo = array('Category', 'User', 'Role');
	var $actsAs = array('Tree' => array(
			'keyPath' => null,
			'valuePath' => null,
			));
	
	function parentNode() {
		return null;
	}
}
