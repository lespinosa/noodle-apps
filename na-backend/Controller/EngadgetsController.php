<?php
/**
 * EngadgetsController.php
 * Luis Manuel
 * @package  Noodle
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Engadgets Controller
 *
 * @property Engadget $Engadget
 */
class EngadgetsController extends AppController
{
	public $name = 'Engadgets';
	var $components = array('Noodle');
	var $paginate = array(
		'limit' => 25,
		'order' => array(
			'Engadget.name' => 'asc'
		) 
	);
	var $zipStatus;
	var $fileSetup = '';
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow(array('*', 'view'));
	}
	public function admin_index(){
		$this->set('location_site', 'Engadget_install');
		$this->set('title_layout', 'Engadget Install');	
		
	}
	public function admin_manager(){
		$this->set('location_site', 'Engadget_Manager');
		$this->set('title_layout', 'Engadget Manager');
		
		$this->Engadget->recursive = 0;
		$this->set('engadgets', $this->paginate());
	}
/**
 * install method
 * 
 * @return void
 */
	public function admin_install()
	{
		$this->set('location_site', 'Engadget_install');
		$this->set('title_layout', 'Engadget install');	
		$file = $this->request->data['Engadget']['file'];
		if ($file['error'] === UPLOAD_ERR_OK){
			$tmp = APP . 'tmp' . DS;
			$uploaddir = $tmp . 'engadgets' . DS;
			$uploadfile = $uploaddir . basename($this->request->data['Engadget']['file']['name']);			
			$ext = strtolower(strrchr($file['name'], '.'));
			
			switch ($ext) {
			  case '.zip':
				  	$foder = new Folder();
			  		$foder->delete($uploaddir);
				  	$foder->create($uploaddir);
					$zip = new ZipArchive;
					//extraemos el zip
					if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
					  	if($zip->open($uploaddir . $file['name']) === TRUE) {
							$zip->extractTo($uploaddir);
							$zip->close();
							$dir = new Folder($uploaddir);
							$fileSetup = $dir->find('.*\.yml');
							$fileSetup = $fileSetup[0];
							//incluimos la libreria Spyc, para leer el file setup
							App::import('Lib', 'Spyc/Spyc');
							// intaciamos el fileSetup
							$ymlSetup = Spyc::YAMLLoad($uploaddir . $fileSetup);
							//GET Type
							$engadgetType = $ymlSetup['info']['type'];
							//GET Method
							$method = $ymlSetup['info']['method'];
							
							switch ($engadgetType) {
							  case 'widget':
									 // verificamos donde se instalara el widget
									 if ($ymlSetup['info']['location'] == 'site') {
											$dest = ROOT . DS . 'Widgets' . DS;
									 }
									 if ($ymlSetup['info']['location'] == 'admin') {
											$dest = ROOT . DS . APP_DIR . DS . 'Widgets' . DS;							  
									 }		
									 $foderWidget = new Folder($uploaddir . $ymlSetup['info']['name'], true, 0777);
									 for ($i=0; $i < count($ymlSetup['folders']); $i++) {
								
										 	 $foderCopy = new Folder($uploaddir . $ymlSetup['info']['name'] .DS. $ymlSetup['folders'][$i], true, 0777);
											 $foderCopy->copy(array(
											 	'to' => $uploaddir . $ymlSetup['info']['name'].DS. $ymlSetup['folders'][$i],
											 	'from' => $uploaddir . $ymlSetup['folders'][$i],
											 	'mode' => 0755
											 ));
									 }
									 for ($i=0; $i < count($ymlSetup['files']); $i++) {
									 		$fileCopy = new File($uploaddir . $ymlSetup['files'][$i]);
										 	$fileCopy->copy($uploaddir . $ymlSetup['info']['name'] . DS .  $ymlSetup['files'][$i], true);									   
									 }
									 //movemos la carpeta al location install
									 $folder = new Folder($dest . $ymlSetup['info']['name']);
									 $foder->move(array(
									 	'to' => $dest . $ymlSetup['info']['name'],
									 	'from' => $uploaddir . $ymlSetup['info']['name'],
									 	'mode' => 0755
									 ));
									 // install widget
									 $this->Engadget->install($ymlSetup, $engadgetType, $method);
									 
								
								break;
							  
							case 'plugin':
								 	// verificamos donde se instalara el widget
									if(!empty($ymlSetup['site'])){
										$folder = new Folder(ROOT . DS . 'plugin' . DS . 'site');
										$foder->move(array(
										 	'to' => ROOT . DS . 'plugin' . DS . $ymlSetup['info']['name'],
										 	'from' => $uploaddir . 'site',
										 	'mode' => 0755
										));	
									}
									if(!empty($ymlSetup['admin'])){
										$folder = new Folder(APP . 'plugin' . DS . 'admin');
										$foder->move(array(
										 	'to' => APP . 'plugin' . DS . $ymlSetup['info']['name'],
										 	'from' => $uploaddir . 'admin',
										 	'mode' => 0755
										));							
									}
									// install plugin
									$this->Engadget->install($ymlSetup, $engadgetType, $method);
								break;
							}
							return true;
						} else {
							$this->invalidate('file', 'Failed to upload file');       
							return false;
						}
					}
			}
			
		}
		
		
	}
	public function admin_uninstall($id = null){
		//$id = array_keys($this->request->data('Engadgets.checkbox'));		
		$engadget = $this->Engadget->find('first', array(
			'conditions' => array(
				'Engadget.id' => $id
			)
		));
		if($id != $engadget['Engadget']['id']){
			$this->Session->setFlash(__('Invalid id for Engadget'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'manager'));
		}
		//GET Location
		if($engadget['Engadget']['location'] == 'site'){
			$appPath = ROOT . DS;
		}
		if($engadget['Engadget']['location'] == 'admin'){
			$appPath = ROOT . DS . APP_DIR . DS;
		}
		
		$type = strtolower($engadget['Engadget']['type']);
		$nameWidget = $engadget['Engadget']['name'];
		switch ($type) {
			case 'plugin':
				$this->Engadget->id = $id;
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
				if ($this->Engadget->delete()) {
				  	$this->Session->setFlash(__('Plugin has been delete'));
					$this->redirect(array('action' => 'manager'));
				}
				
				break;
			
			case 'widget':
				$souser = $appPath . 'Widgets' . DS . $nameWidget;
				$this->Noodle->clearAll($souser, false);
				$this->Noodle->uninstall($id, $type);
				$this->Session->setFlash(__('Widget has been delete'));
				$this->redirect(array('action' => 'manager'));
				
				break;
			case 'theme':
				break;
			case 'language':
				break;
		}
	}
/**
 * process method
 * 
 * @return void
 */
	public function admin_batch_process(){
		//GET Action		
		$action = $this->request->data['Engadget']['action'];
		//Declare var
		$ids = array();
		$types = array();
		$name = array();
		$location = array();
		foreach ($this->request->data['Engadget'] as $id => $value) {

			if($id != 'action' && $value['id'] == 1) {
				$ids[] = $id;
				$engadget = $this->Engadget->find('first', array(
					'conditions' => array(
						'Engadget.id' => $id
					)
				));
				$name[] = $engadget['Engadget']['name'];
				$location[] = $engadget['Engadget']['location'];
				$types[] = $engadget['Engadget']['type'];				
			}				  
		}
		if (count($ids) == 0 || $action == null) {
			$this->Session->setFlash(__('No items selected.'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'manager'));
		}
		if ($action == 'publish'){
			echo ' es publish ';
		}
		if ($action == 'delete') {
				$this->Engadget->uninstallAll($ids, $types);         	
				for ($i=0; $i < count($ids); $i++) {					
					$this->Engadget->delFolder($name[$i], $location[$i],$types[$i]);
				}
				$this->Session->setFlash(__('Engadget Uninstall.'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'manager'));		
		}
	}

	
}
