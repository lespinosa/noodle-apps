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
	public function admin_install()
	{
		
		$this->set('location_site', 'Engadget_install');
		$this->set('title_layout', 'Engadget install');	
		
	//$ext = strtolower(strrchr($this->request->data['Engadget']['file']['name'], '.'));
		$tmp = ROOT . DS . APP_DIR . DS . 'tmp' . DS;
		$uploaddir = $tmp . 'engadgets' . DS;
		$uploadfile = $uploaddir . basename($this->request->data['Engadget']['file']['name']);
		$packName = $this->request->data['Engadget']['file']['name'];
		$packError = $this->request->data['Engadget']['file']['error'];
		$ext = strtolower(strrchr($packName, '.'));
		
		if ($ext == '.zip') {
			//Clear Temp folder
			$this->Noodle->clearAll($uploaddir, false);
			mkdir($uploaddir, 0755);
			
			switch ($ext) {
				case '.zip':				
					if (move_uploaded_file($this->request->data['Engadget']['file']['tmp_name'], $uploadfile)) {
						$zip = new ZipArchive;						
						if ($zip->open($uploaddir . $packName) == TRUE) {
							for ($i = 0; $i < $zip->numFiles; $i++){								
								$fileName = $zip->getNameIndex($i);
								//verificamos los archivos
								$extPerm = strtolower(strrchr($fileName, '.'));
								//buscamos el archivo de instalacion
								if ($extPerm == '.yml'){
									$this->fileSetup = $fileName;
								}
								// verificamos si existe un .exe o .lnk
								if ($extPerm == '.exe' or $extPerm == '.lnk') {
									$this->Session->setFlash(__('Existe un archivo malicioso, dentro del zip', true));
									$this->redirect(array('action' => 'index'));
								}
							}
							$zip->extractTo($uploaddir);
							$zip->close();
							$this->zipStatus = 1;
						} else {
							$this->zipStatus = 0;
						}
						if($this->zipStatus == 1 && $packError == 0){
							App::import('Lib', 'Spyc/Spyc');
							$ymlSetup = Spyc::YAMLLoad($uploaddir . $this->fileSetup);
							var_dump($ymlSetup);
							//GET type							
							$engadgetType = $ymlSetup['info']['type'];
							
							// verificamos donde se instalara el widget
							if ($ymlSetup['info']['location'] == 'site') {
								$dest = ROOT . DS . 'Widgets' . DS;
							}
							if ($ymlSetup['info']['location'] == 'admin') {
								$dest = ROOT . DS . APP_DIR . DS . 'Widgets' . DS;							  
							}					
							unlink($uploaddir . $packName); // delete zip file
							//Endgaget Type
							switch ($engadgetType) {
								case 'plugin':
									
									break;
								
								case 'widget':
									//$dirExt = mkdir($dest.$xmlSetup->info->name, 0755);
									$source = $uploaddir;
									$folderWidget = $dest .strtolower($ymlSetup['info']['name']);
									$this->Noodle->fullMove($source, $folderWidget);
									//Clear Temp folder
									$this->Noodle->clearAll($uploaddir, false);
									mkdir($uploaddir, 0755);
									$this->Noodle->install($ymlSetup, 'widget');
									break;
								case 'theme':
									
									break;
								case 'language':
									
									break;
							}
						}
					    $this->Session->setFlash(__('El Widget %s fue instalado corretamente', $ymlSetup['info']['title']));
					} else {
						$this->Session->setFlash(__('El Widget %s no pudo ser instalado', $ymlSetup['info']['title']));
					}					
					break;
				
				case '.tar':
					
					break;
			}
			
		} else {
			$this->Session->setFlash(__('Package no valido', true));
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
			$this->Session->setFlash(__('Invalid id for Engadget'));
			$this->redirect(array('action' => 'manager'));
		}
		$appPath = ROOT . DS . APP_DIR . DS;
		$type = strtolower($engadget['Engadget']['type']);
		$nameWidget = $engadget['Engadget']['name'];
		switch ($type) {
			case 'plugin':
				
				break;
			
			case 'widget':
				$souser = $appPath . 'Widgets' . DS . $nameWidget;
				$this->Noodle->clearAll($souser, false);
				$this->Noodle->uninstall($id, $type);
				$this->redirect(array('action' => 'manager'));
				
				break;
			case 'theme':
				break;
			case 'language':
				break;
		}
	}

	
}
