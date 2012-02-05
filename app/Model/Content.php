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
App::uses('AppModel', 'Model');
/**
 * content Model
 * 
 * @property Content
 */
class Content extends AppModel
{
	public $name = 'Content';
	var $actsAs = array('Tree' => array(
			'keyPath' => null,
			'valuePath' => null,
			));
	/**
	 * belongsTo associations
	 * 
	 * @var array
	 */
	public $belongsTo = array(
		'Category' => array (
			'className' => 'Category',
			'foreignKey' => 'Category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array (
			'className' => 'User',
			'foreignKey' => 'User_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Role' => array (
			'className' => 'Role',
			'foreignKey' => 'Role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	
	function parentNode() {
		return null;
	}
}
