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
	public $actsAs = array('Tree' => array(
			'keyPath' => null,
			'valuePath' => null,
			));
	/**
	 * belongsTo associations
	 * 
	 * @var array
	 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/*'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'language_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),*/
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	function parentNode() {
		return null;
	}
/**
 * Find alia method
 * 
 * @param string $arg
 * @param string $field
 * @return coid
 */
	public function findAlia($arg, $field = ''){
		//recivimso el alia y le eliminamos posible extension
		$alia = str_replace('.html', '', $arg);
		//buscamos el link_type_id
	
		$data = $this->findByAlias($alia);
		switch ($field) {
		  case 'id':
			return $data['Content']['id'];
			break;
		  case 'title':
			return $data['Content']['title'];
			break;
		  default:
			
			break;
		}

	}
}
