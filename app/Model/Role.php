<?php
/*
 * Luis Manuel
 * role.php 
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
class Role extends AppModel {
	var $name = 'Role';
	var $actsAs = array('Acl' => array('type' => 'requester'));
 
	function parentNode() {
	    return null;
	}
	function bindNode($user) {
	    return array('model' => 'Role', 'foreign_key' => $user['User']['role_id']);
	}
	
}