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

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class NoodleHelper extends AppHelper
{
	var $helpers = array('Html', 'Session', 'Form', 'WidgetMenu');
	public $helperName;
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
/**
 * Required Settings
 * getLinkSettings method
 * 
 * @param string $link_type 
 * @param string $itemId
 * @return void
 */
	public function getLinkSettings($link_type = null, $itemId = null){
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
		App::import('Controller', 'Categories');
		$data = new ContentsController;
		$dataCat = new CategoriesController;
		switch ($value) {
			case 'home':
				$output = $data->Content->find('list', array(
					'conditions' => array('Content.status' => 1),
					'order' => array('Content.title' => 'Desc'),
					'fields' => 'Content.title',
					));
				return $this->Form->input('Menu.link_type_id', array('div' => false, 'label'=> false,'options' => array(0 => 'Select Article', 'Articles List' => $output)));
				break;
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
			case 'category_blog':
				$category = $dataCat->Category->find('list', array(
					'conditions' => array('Category.status' => 1),
					'order' => array('Category.title' => 'Desc'),
					'fields' => 'Category.title',
					));
				return $this->Form->input('Menu.link_type_id', array('div' => false, 'label'=> false,'options' => array(0 => 'Select Category', 'Category List' => $category)));
				break;
		}
	}
/**
 * getLink() method
 * 
 * @param string $link_type
 * @return void
 */
	public function getLink($link_type = null){
		$value = strtolower($link_type);
		switch ($value) {
			case 'home':
				$output = $this->Form->input('link', array('value' =>'{"controller":"pages","action":"display"}'));
				return $output;
				break;
			case 'single_article':
				$output = $this->Form->input('link', array('value' =>'{"controller":"sitecontents","action":"view"}')
				);			
				return $output;
				break;
			case 'category_blog':
				$output = $this->Form->input('link', array('value' =>'{"controller":"sitecategories","action":"category"}')
				);			
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

	public function modOptions($type = null, $wHelper = ''){
		$dir = new Folder (ROOT_WIDGETS.$wHelper.DS.'Helper');
		$helperFile = $dir->find('.*\.php');
		foreach ($helperFile as $key => $value) {
			$this->helperName = $value;
		}
		$widgetHelper = str_replace('Helper.php', '', $this->helperName);
		switch ($type) {
			case 'tab-links':				
				return $this->$widgetHelper->getTabLink();
				break;
			
			case 'tab-contents':
				return $this->$widgetHelper->getTabContents();
				break;
		}	
	}
	public function assignment(){
		return$this->getAllMenuType();
	}
	public function getAllMenuType(){
		App::import('Controller', 'Menutypes');
		$data = new MenutypesController;
		$data->Menutype->recursive = 0;
		$menus = $data->Menutype->find('all', array(
				'conditions' => array(
					'Menutype.status' => 1,
				),
				'fields' => array ('Menutype.id', 'Menutype.title'),
				'order'	=> array(
					'Menutype.id' => 'ASC'
				)
			)
		);
		$output = '<ul>'; 
		for ($i=0; $i < count($menus); $i++) {
			$output .= '<li><a href="#tabs-'.$i.'">' .$menus[$i]['Menutype']['title'] .'</a></li>';
		}
		$output .= '</ul>';		
		for ($i=0; $i < count($menus); $i++) {
			$id = $menus[$i]['Menutype']['id'];
			$menuItem = $this->getAllMenuItems($id);
			$output .= '<div id="tabs-'.$i.'">';
			foreach ($menuItem as $itemId => $itemTitle) {				
			 //	$output .= $this->Form->select('', array($itemTitle));
			 	$output .= $this->Form->input('Assignment.'.$itemId, array('type' => 'checkbox', 'label' => $itemTitle, 'value' => $itemId));
				//$this->params('menutype_id', array('label' => 'Select Menu','options' => array(0 => 'Select Menu', 'Menu List' => $list)));
			}
			$output .= '</div>';			
		}
		return $output;
		
	}
	public function getAllMenuItems($id){
		App::import('Controller', 'Menus');
		$data = new MenusController;
		
		$menuItem = $data->Menu->generateTreeList(array(
					'Menu.menutype_id' => $id,
					'Menu.status' => 1,
				)
		);
		return $menuItem;

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
