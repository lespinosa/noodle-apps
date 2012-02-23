<?php
/*
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('AppModel', 'Model');
/**
 * menutype Model
 *
 * @property Menu $Menu
 */
class Menutype extends AppModel
{
	public $name = 'Menutype';
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Menu' => array(
			'className' => 'Menu',
			'foreignKey' => 'menutype_id',
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
 * parentNode() method
 * 
 * @return void
 */
	public function parentNode() {
	    return null;
	}	
}