<?php
/*
 * Luis Manuel
 * role.php 
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('AppModel', 'Model');
class Role extends AppModel {
	var $actsAs = array('Acl' => array('type' => 'requester')); 
	public function parentNode() {
	    return null;
	}	
}