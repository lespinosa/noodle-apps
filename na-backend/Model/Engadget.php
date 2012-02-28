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
 * install method
 * 
 * @param array $ymlSetup
 * @param string $type
 * @param string $method
 * @return void
 */
	public function install($ymlSetup, $type, $method){
		switch ($type) {
		  case 'widget':
			  if($method == 'upgrade'){
			  		$engadget = $this->findByName($ymlSetup['info']['name']);
				  	$this->read(null, $engadget['Engadget']['id']);
					$this->set($ymlSetup['info']);
				 	$this->save();
			  }
			  if($method == 'install'){
			  		$this->set($ymlSetup['info']);
				 	$this->save();
			  }			
			break;
		case 'plugin':
			  if($method == 'upgrade'){
			  		$engadget = $this->findByName($ymlSetup['info']['name']);
					$data = array_merge($ymlSetup['info'], array(
						'params' => json_encode($ymlSetup['config'])
					));
				  	$this->read(null, $engadget['Engadget']['id']);
					$this->set($data);					
				 	$this->save();
			  }
			  if($method == 'install'){
			  		$data = array_merge($ymlSetup['info'], array(
						'params' => json_encode($ymlSetup['config'])
					));
			  		$this->set($data);
				 	$this->save();
			  }
			
			break;
		}
		
	}
/**
 * uninstall method
 * 
 * @param string $name
 * @param string $location
 * @param string $type
 * @return void
 */
	public function uninstall($id, $type){
		$engadget = $this->find('first', array(
			'conditions' => array(
				'Engadget.id' => $id
			)
		));
		
		//GET Location
		if($engadget['Engadget']['location'] == 'site'){
			$appPath = ROOT . DS;
		}
		if($engadget['Engadget']['location'] == 'admin'){
			$appPath = ROOT . DS . APP_DIR . DS;
		}
		switch ($type) {
		  case 'widget':
		  	App::import('Model', 'Widget');
			$widget = new Widget;
			$name = $engadget['Engadget']['name'];	
			$widget->deleteAll(array('Widget.engadget_id' => $id), true);
			$folder = new Folder($appPath.'Widgets'.DS.$name);
			$folder->delete();
			$this->id = $id;
			$this->delete();
			break;		  
		  case 'plugin':			 	
				$dirName = $engadget['Engadget']['name'];
				$path = array('admin', 'site');
				$folder = new Folder();
				for ($i=0; $i < 2; $i++) {
					if ($path[$i] == 'admin') {
					  	$dir = APP . 'Plugin' . DS . $dirName;
					}
					if ($path[$i] == 'site') {
					  	$dir = ROOT . DS . 'Plugin' . DS . $dirName;	
					}				
					$folder->delete($dir);			  
				}
				$this->id = $id;
				$this->delete();				
			break;
		}		
	}		
}