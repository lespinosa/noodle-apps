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
App::uses('Folder', 'Utility');
/**
 * engadget Model
 *
 * @property Widget $Widget
 */
class Engadget extends AppModel
{
	public $name = 'Engadget';
	public $uses = array('Widget');
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
/**
 * uninstall all method
 * 
 * @param array $ids
 * @param array $types
 * @return void
 */
	public function uninstallAll($ids, $types){
	
		if ($this->deleteAll(array('Engadget.id' => $ids), true, true)) {
			//GET Engadget
			if (in_array('widget', $types)) {
				//Delete all widget
				App::import('Model', 'Widget');
				$widget = new Widget;					
				$widget->deleteAll(array('Widget.engadget_id' => $ids), true, true);
				
			}
		}
	}
/**
 * delWidget method
 * 
 * @param string $name
 * @param string $location
 * @param string $types
 * @return void
 */
	public function delWidget($name, $location, $types){
		if($location == 'site'){
			$appPath = ROOT . DS;
		}
		if($location == 'admin'){
			$appPath = ROOT . DS . APP_DIR . DS;
		}
	
		$folder = new Folder($appPath.'Widgets'.DS.$name);
		if ($folder->delete()) {
			print $name . 'delted';
		}
		
	}
	
}