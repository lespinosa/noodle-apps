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
 * Validate field
 */
/*public $validate = array(
	'alias' => array(
		'rule' => 'isUnique',
		'message' => 'This Alia has already been taken.',
	)
);*/
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Parentcategory' => array(
			'className' => 'category',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Childcategory' => array(
			'className' => 'category',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Content' => array(
			'className' => 'Content',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
/**
 * find alia category method
 * 
 * @param string $arg
 * @param $string $field
 */
	public function findAliaCategory($arg, $field = '') {
		$alia = str_replace('.html', '', $arg);
		$categoy = $this->findByAlias($alia);
		switch ($field) {
		  case 'id':
		  		return $categoy['Category']['id'];			
			break;
		  
		  default:
			
			break;
		}
		
	}
}