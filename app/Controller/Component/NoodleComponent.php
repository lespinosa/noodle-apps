<?php

/**
 * NoodleComponent.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
class NoodleComponent extends Component
{
	public $components = array('Acl', 'Auth', 'Session');
    public $helpers = array('Html', 'Form', 'Session', 'Paginator', 'Layout', 'Js' => 'Jquery');
	//instar engadget
	function install($xmlSetup, $type = ''){
		switch ($type) {
			case 'plugin':
				
				break;
			
			case 'widget':
				App::import('Controller', 'Engadgets');
				$app = new EngadgetsController;
				$app->Engadget->set(array(
					'name' => $xmlSetup->info->name,
					'location' => $xmlSetup->info->location,
					'status' => $xmlSetup->info->status,
					'type' => $xmlSetup->info->type,
					'version' => $xmlSetup->info->version,
					'date' => $xmlSetup->info->date,
					'author' => $xmlSetup->info->author,
					'folder' => $xmlSetup->info->folder	
				));
				$app->Engadget->save();

				break;
			case 'theme':
				break;
			case 'language':
				break;
		}
		//print_r ($xmlSetup->info);
	}
	//Uninstall Engadget
	function uninstall($Id, $type= ''){
		App::import('Controller', 'Engadgets');
		$app = new EngadgetsController;
		$app->Engadget->id = $Id;
		if (!$app->Engadget->id) {
			$this->Session->setFlash(__('Invalid id for Engadget'));
		}
		if ($app->Engadget->delete()){
			$this->Session->setFlash(__('The Engadget has been uninstall'));
			switch ($type) {
				case 'plugin':
					
					break;
				
				case 'widget':
					App::import('Controller', 'Widgets');
					$appW = new WidgetsController;
					$appW->Widget->deleteAll(array('Widget.engadget_id' => $Id), true);
					break;
				case 'theme':
					break;
				case 'language':
					break;
			}
			
		}
	}
	// Move all file and Directry a new Directry
	function fullMove($source, $folderWidget) {
		$target = $folderWidget;
	    if (is_dir($source)){
	        @mkdir($target);
	        $d = dir($source);
	        while (FALSE !== ($entry = $d->read())){
	            if ($entry == '.' || $entry == '..'){
	                continue;
	            }
	            $Entry = $source . '/' . $entry;
	            if (is_dir($Entry)) {
	                $this->fullMove($Entry, $target . '/' . $entry);
	                continue;
	            }
	            rename($Entry, $target . '/' . $entry);
	        }	
	        $d->close();
	    }else {
	        rename($source, $target);
	    }
	}
	// clear All  File and Folder.
	function clearAll($directory, $empty = false){
		if(substr($directory, -1) == "/") {
			$directory = substr($directory, 0, -1);
		}
		if(!file_exists($directory) && !is_dir($directory)){
			return false;
		} elseif (!is_readable($directory)) {
			return false;
		} else {
			$directoryHandle = opendir($directory);
			
			while ($contents = readdir($directoryHandle)){
				if($contents != '.' && $contents != '..'){
					$path = $directory . "/" . $contents;
					
					if(is_dir($path)){
						$this->clearAll($path);
					} else {
						unlink($path);
					}
				}
			}
			closedir($directoryHandle);
			if($empty == false){
				if(!rmdir($directory)){
					return false;
				}
			}
			return true;
		}
	}
}
