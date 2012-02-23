<?php
/**
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('AppModel', 'Model');
/**
 * menu Model
 *
 * @property menu $Parentmenu
 * @property Menutype $Menutype
 * @property LinkType $LinkType
 * @property Role $Role
 * @property User $User
 * @property menu $Childmenu
 */
class Menu extends AppModel
{
	public $name = 'Menu';

	var $actsAs = array('Tree' => array(
			'keyPath' => null,
			'valuePath' => null,
			'spacer' => '├─ '
			));

/**
 * Validate field
 */
public $validate = array(
	'alias' => array(
		'rule' => 'isUnique',
		'message' => 'This Alia has already been taken.',
	)
);
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Parentmenu' => array(
			'className' => 'Menu',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Menutype' => array(
			'className' => 'Menutype',
			'foreignKey' => 'menutype_id',
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
		'Childmenu' => array(
			'className' => 'Menu',
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
		)
	);
/**
 * Find alia Menu method
 * 
 * @param string $alias
 */
	public function findAliaMenu($alia){
		
	}
}