<?php

/**
 * Widget.php
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
 * widget Model
 *
 * @property widget $Parentwidget
 * @property Engadget $Engadget
 * @property Role $Role
 * @property User $User
 * @property widget $Childwidget
 */
class Widget extends AppModel
{
	public $name = "Widget";
	var $actsAs = array('Tree' => array(
			'keyPath' => null,
			'valuePath' => null,
			));
	
	function parentNode(){
		return null;
	}
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Engadget' => array(
			'className' => 'Engadget',
			'foreignKey' => 'engadget_id',
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
}
