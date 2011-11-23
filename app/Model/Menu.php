<?php
/**
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
class Menu extends AppModel
{
	var $name = 'Menu';
	var $belongsTo = array('Menutype', 'User', 'Role');
	var $actsAs = array('Tree' => array(
			'keyPath' => null,
			'valuePath' => null,
			'spacer' => '├─ '
			));	

}