<?php
/**
 * Noodle.php
 * Luis Manuel
 * @package  Noodle
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
define('ROOT_WIDGETS', APP.'widgets'.DS);

class NoodleHelper extends AppHelper
{
	var $helpers = array('Html', 'Session', 'Form', 'Menus');
	
	function getListType($itemId, $menuTypeId){
		$output = "<fieldset class='link_type'>";
		$output .= "<div id='list_type'>";
		$output .= "<ul class='list-type'>";
		$output .= "<li>".__('Pages',true)."</li>";
		$output .= "<li>".__('Articles',true)."</li>";
		$output .= "<li>".__('Categories',true)."</li>";
		$output .= "<li>".__('Blog',true)."</li>";
		$output .= "</ul>";
		$output .= "</div>";
		$output .= "</fieldset>";
		
		return $output;
	}
	function getLinkSettings($link_type = null, $itemId = null){
		App::import('Controller', 'Menus');
		$dataMenu = new MenusController;
		$item = $dataMenu->Menu->find('first', array(
					'conditions' => array(
						'Menu.id' => $itemId,
						),
					'fields' => 'Menu.link_type',
				));
		if($link_type == null){
			$value  = strtolower($item['Menu']['link_type']);
		} else {
			$value = strtolower($link_type);
		}
		App::import('Controller', 'Contents');
		$data = new ContentsController;
		switch ($value) {
			case 'single_article':
				$output = $data->Content->find('list', array(
					'conditions' => array('Content.status' => 1),
					'order' => array('Content.title' => 'Desc'),
					'fields' => 'Content.title',
					));
				return $this->Form->input('Menu.link_type_id', array('div' => false, 'label'=> false,'options' => array(0 => 'Select Article', 'Articles List' => $output)));
				break;
			
			case 'featured_articles':
				
				break;
			case 'Submit_Article':
				
				break;
		}
	}
	function getLink($link_type = null){
		$value = strtolower($link_type);
		switch ($value) {
			case 'single_article':
				$output = $this->Form->input('link', array('value' => $this->setLink('', array(
							'controller' => 'contents', 'action' => 'view', 'admin' => false))
				));
				return $output;
				break;
			
			case 'featured_articles':
				
				break;
			case 'Submit_Article':
				
				break;
		}
	}
	public function setLink($title, $url = null, $options = array(), $confirmMessage = false) {
			$escapeTitle = true;
			if ($url !== null) {
				$url = $this->url($url);
			} else {
				$url = $this->url($title);
				$title = $url;
				$escapeTitle = false;
			}
	
			if (isset($options['escape'])) {
				$escapeTitle = $options['escape'];
			}
	
			if ($escapeTitle === true) {
				$title = h($title);
			} elseif (is_string($escapeTitle)) {
				$title = htmlentities($title, ENT_QUOTES, $escapeTitle);
			}
	
			if (!empty($options['confirm'])) {
				$confirmMessage = $options['confirm'];
				unset($options['confirm']);
			}
			if ($confirmMessage) {
				$confirmMessage = str_replace("'", "\'", $confirmMessage);
				$confirmMessage = str_replace('"', '\"', $confirmMessage);
				$options['onclick'] = "return confirm('{$confirmMessage}');";
			} elseif (isset($options['default']) && $options['default'] == false) {
				if (isset($options['onclick'])) {
					$options['onclick'] .= ' event.returnValue = false; return false;';
				} else {
					$options['onclick'] = 'event.returnValue = false; return false;';
				}
				unset($options['default']);
			}
			return sprintf($url, $this->_parseAttributes($options), $title);
	}
	public function import($type = null, $modName, $fileName){
		switch ($type) {
			case 'Helper':
				require_once ROOT_WIDGETS.$modName.DS.'helper'.DS.$fileName.'.php';
				break;
			
			default:
				
				break;
		}
	}
	public function modOptions($type = null){
		switch ($type) {
			case 'tab-links':				
				return $this->Menus->getTabLink();
				break;
			
			case 'tab-contents':
				return $this->Menus->getTabContents();
				break;
		}		
	
	}
	
	// Get params $this->Noodle->params('menutype', array('type'=>'text', 'label' => 'sample'), 'set');
	public function params($fieldName = null, $options = array()){
		$getparams = new stdClass();		
		$datajSon = $this->request->data('Widget.params');
		$params = json_decode($datajSon);	
		
		if($datajSon == null or empty($params->$fieldName)){
			return $this->Form->input('Params.'.$fieldName, $options);
		} else {
			$option = array_replace($options, array('value' => $params->$fieldName));
			return $this->Form->input('Params.'.$fieldName, $option);
					
		}			
	}
	public function getParams(){
		echo $this->params(NULL, null, 'get');
		
	}
}
