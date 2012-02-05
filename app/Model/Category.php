<?php
/**
 * Category.php
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
 * category Model
 * 
 * @property Category
 */
class Category extends AppModel
{
	public $name = 'Category';
	public $actsAs = array('Tree' => array(
			'keyPath' => null,
			'valuePath' => null,
			'spacer' => '├─ '
		)
	);
	/**
	 * hasMany associations
	 * 
	 * @var array
	 */
	public $hasMany = array (
		'Content' => array (
				'className' => 'Content',
				'foreignKey' => 'Category_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			),
	);
	/**
	 * belongsTo associations
	 * 
	 * @var array
	 */
	public $belongsTo = array(
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
}