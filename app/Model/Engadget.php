<?php
/**
 * Engadget.php
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
 * engadget Model
 *
 * @property Widget $Widget
 */
class Engadget extends AppModel
{
	public $name = 'Engadget';
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Widget' => array(
			'className' => 'Widget',
			'foreignKey' => 'engadget_id',
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