<?php

/**
 * 
 * User.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel
{
	public $belongsTo = array('Role');
	public $actsAs = array('Acl' => array('type' => 'requester'), 'Translate' => array('name'));
	
	public function beforeSave() {
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}
	
	public function parentNode() {
	    if (!$this->id && empty($this->data)) {
	        return null;
	    }
	    if (isset($this->data['User']['role_id'])) {
	    $roleId = $this->data['User']['role_id'];
	    } else {
	        $roleId = $this->field('role_id');
	    }
	    if (!$roleId) {
	    	return null;
	    } else {
	        return array('Role' => array('id' => $roleId));
	    }
	}
	/**
	 * implement bindNode() method
	 * only permissions per-role
	 * 
	 * @return void
	 */
	public function bindNode($user) {		
	    return array('model' => 'Role', 'foreign_key' => $user['User']['role_id']);
	}
}