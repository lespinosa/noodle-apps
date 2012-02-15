<?php

/**
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */

App::uses('Sanitize', 'Utility');
class LayoutHelper extends AppHelper
{
	
	var $helpers = array('Html', 'Session', 'Form', 'Widgets');

	/*function __construct($argument) {
		
	}*/
	function getStatus($ctlName = '', $modelName = '', $statusValue, $type = ''){
		
		if(!empty($ctlName) && !empty($modelName)){
			App::import('Controller', '$ctlName');
			$ctlValue = $ctlName.'Controller';
			$app = new $ctlValue;
			$value = $app->$modelName->find('first', array(
						'conditions' => array(
							$modelName.'.id' => $statusValue,
						),
					));
			$status = $value[$modelName]['status'];
		} else {
			$status = $statusValue;
		}
				
		switch ($type) {
			case 'img':
				if($status == 1){
					$output = '<div class="status">'. $this->Html->image('admin/icons/tick.png', array('alt' => 'Published')) . '</div>';
				} else {
					$output = '<div class="status">'. $this->Html->image('admin/icons/cross.png', array('alt' => 'Unpublished')) . '</div>';
				}
				return $output;			
				break;
			
			default:
			case 'text':
				if($status == 1){
					$output = "Published";
				} else {
					$output = 'Unpublished';
				}
				return $output;
				break;
		}
	}
	function getFeatured($value, $type = ''){
		switch ($type) {
			case 'img':
				if($value  == 1){
					$output = '<div class="featured">'. $this->Html->image('admin/icons/on_star_icon.png', array('alt' => 'Featured')) . '</div>';
				} else {
					$output = '<div class="featured">'. $this->Html->image('admin/icons/off_star_icon.png', array('alt' => 'Featured')) . '</div>';
				}
				return $output;		
				break;
			
			default:
			case 'text':
				if($value == 1){
					$output = "Yes";
				} else {
					$output = 'No';
				}
				return $output;
				break;
		}
	}
	function getCategory($id) {
		App::import('Controller', 'Categories');
		$Content = new CategoriesController;
		$output = $Content->Category->find('first', array(
				'conditions' => array('Category.id' => $id)));
		return '<span>'.$output['Category']['title']. '</span>';
		
	}
	function getContent($id) {
		App::import('Controller', 'Contents');
		$data = new ContentsController;
		$output = $data->Content->find('first', array(
				'conditions' => array('Content.id' => $id)));
		return '<span>'.$output['Content']['title']. '</span>';
		
	}
	function getMenuItem($id) {
		App::import('Controller', 'Menus');
		$data = new MenusController;
		$output = $data->Menu->find('first', array(
				'conditions' => array('Menu.id' => $id)));
		return '<span>'.$output['Menu']['title']. '</span>';
		
	}
	//GET all Widget
	//Nota: remplace la antigua getWidget por getAllWidget, buscar mas abajo getAllWidget
	function getWidget($id) {
		App::import('Controller', 'Widgets');
		$data = new WidgetsController;
		$output = $data->Widget->find('first', array(
				'conditions' => array('Widget.id' => $id)));
		return '<span>'.$output['Widget']['title']. '</span>';
		
	}
	function getAccess($id, $type = null){
		App::import('Controller', 'Roles');
		switch ($type) {
			case 'img':
				
				break;
			
			default:
			case 'text':				
				$data = new RolesController;
				$output = $data->Role->find('first', array(
						'conditions' => array('Role.id' => $id)));
				return '<span>'.$output['Role']['name']. '</span>';
				break;
		}
		
	}
	function getAuthor($modelName, $uid = null, $type = null){
		App::import('Controller', 'Users');
		$data	= new UsersController;
		switch ($type) {
			case 'modified':
					$output = $data->User->find('first', array(
							'conditions' => array('User.id' => $uid)));
					$modified = $this->request->data($modelName.'.modified_by');
			
					if($modified > 0) {
						return $output['User']['name'];	
					} else {
						return __('This %s not has been Modified', $modelName, true);
					}						
				break;
			default:
			case 'created':
					return $this->request->data($modelName.'.created_by');;
				break;
		}
	
	}
	function getLeft($ctlName, $modelName, $Id = null){
		App::import('Controller', $ctlName);
		$ctl = $ctlName.'Controller';
		$data = new $ctl;
		$left = $data->$modelName->find('first', array(
					'conditions' => array($modelName.'.id' => $Id),
					'fields' => $modelName.'.lft'
				));
		return $left[$modelName]['lft'];
		
	}
	function getOrdering($modelName = null, $Id, $linksMenuType = null, $type = null, $lft = null){
		if ($modelName == 'Category'){
			$title = Sanitize::clean($this->getCategory($Id), array('remove_html' => true));
		}
		if ($modelName == 'Content') {
			$title = Sanitize::clean($this->getContent($Id), array('remove_html' => true));
		}
		if ($modelName == 'Menu') {
			$title = Sanitize::clean($this->getMenuItem($Id), array('remove_html' => true));
		}
		if ($modelName == 'Widget') {
			$title = Sanitize::clean($this->getWidget($Id), array('remove_html' => true));
		}
		switch ($type) {
			case 'img':
				$output = "<ul class='ordering'>";
				$output .= "<li>";
				$output .= $this->Html->link($this->Html->image('admin/icons/up_icon.png', array(
								'alt' => 'Move Up')), array('action' => 'moveup', $title, $linksMenuType),
								array('escape' => false));
				$output .= "</li>";
				$output .= "<li>";
				$output .= $this->Html->link($this->Html->image('admin/icons/down_icon.png', array(
								'alt' => 'Move Down')), array('action' => 'movedown', $title, $linksMenuType),
								array('escape' => false));
				$output .= "</li>";
				$output .= "<li>";
				$output .=  $this->Form->input($modelName.'.lft', array('value' => $lft));
				$output .= "</li>";
				$output .= "</ul>";
				return $output;
				break;
			
			default :
			case 'text':
				$output = "<ul class='ordering'>";
				$output .= "<li>";
				$output .= $this->Html->link('Move Up', array('action' => 'moveup', $Id, $linksMenuType) );
				$output .= "</li>";
				$output .= "<li>";
				$output .= $this->Html->link('Move Down', array('action' => 'movedown', $Id, $linksMenuType) );
				$output .= "</li>";
				$output .= "<li>";
				$output .=  $this->Form->input('lft', array('value' => $lft));
				$output .= "</li>";
				$output .= "</ul>";
				return $output;
				break;
		}		
	}
	function getMenu(){
		App::import('Controller', 'menutypes');
		$app = new MenutypesController;
		$menus = $app->Menutype->find('all', array(
					'conditions' => array(
							'Menutype.status' => 1
						),
					'order' => array(
							'Menutype.alias' => 'asc'
						)
				));
		foreach ($menus as $menu){
			echo '<li>';
			echo $this->Html->link($menu['Menutype']['title'], array('controller' => 'menus', 'action' => 'index', $menu['Menutype']['id'])) . '</li>';
			
		}
	}
	function getSubnav($location= null){
		$locatinNav = strtolower($location);
		switch ($locatinNav) {
			case 'contents':
				echo "<li class='active'>".__('Contents', true) . "</li>";
				echo "<li>". $this->Html->link(__('Categories', true), array('controller' => 'categories', 'action' => 'index')). "</li>";
				break;
			
			case 'categories':
				echo "<li>". $this->Html->link(__('Contents', true), array('controller' => 'contents', 'action' => 'index')). "</li>";
				echo "<li class='active'>".__('Categories', true) . "</li>";
				break;
			case 'menutypes':
				echo "<li class='active'>".__('Menus', true) . "</li>";
				echo "<li>". $this->Html->link(__('Menu Items', true), array('controller' => 'menus', 'action' => 'index')). "</li>";
				
				break;
			case 'menus':
				echo "<li>". $this->Html->link(__('Menus', true), array('controller' => 'menutypes', 'action' => 'index')). "</li>";
				echo "<li class='active'>".__('Menus Items', true) . "</li>";
				
				break;
			
			case 'users':
				echo "<li class='active'>".__('Users Manager', true) . "</li>";
				echo "<li>". $this->Html->link(__('Roles Manager', true), array('controller' => 'roles', 'action' => 'index')). "</li>";
				echo "<li>". $this->Html->link(__('Acl Manager', true), array('controller' => 'acl', 'action' => 'index')). "</li>";
				break;
			case 'roles':
				echo "<li>". $this->Html->link(__('Users Manager', true), array('controller' => 'users', 'action' => 'index')). "</li>";
				echo "<li class='active'>".__('Roles Manager', true) . "</li>";
				echo "<li>". $this->Html->link(__('Acl Manager', true), array('controller' => 'acl', 'action' => 'index')). "</li>";
				break;
			case 'acl':
				echo "<li>". $this->Html->link(__('Users Manager', true), array('controller' => 'users', 'action' => 'index')). "</li>";
				echo "<li>". $this->Html->link(__('Roles Manager', true), array('controller' => 'roles', 'action' => 'index')). "</li>";
				echo "<li class='active'>".__('Acl Manager', true) . "</li>";
				break;

				case 'engadget_install':
					echo "<li class='active'>".__('Install', true) . "</li>";
					echo "<li>". $this->Html->link(__('Engadgets Manager', true), array('controller' => 'engadgets', 'action' => 'manager')). "</li>";
					echo "<li>". $this->Html->link(__('Widgets Manager', true), array('controller' => 'widgets', 'action' => 'index')). "</li>";
					break;
				case 'engadget_manager':
					echo "<li>". $this->Html->link(__('Install', true), array('controller' => 'engadgets', 'action' => 'index')). "</li>";
					echo "<li class='active'>".__('Engadgets Manager', true) . "</li>";
					echo "<li>". $this->Html->link(__('Widgets Manager', true), array('controller' => 'widgets', 'action' => 'index')). "</li>";					
					break;
				
				case 'widgets_manager':
					echo "<li>". $this->Html->link(__('Install', true), array('controller' => 'engadgets', 'action' => 'index')). "</li>";
					echo "<li>". $this->Html->link(__('Engadgets Manager', true), array('controller' => 'engadgets', 'action' => 'manager')). "</li>";
					echo "<li class='active'>".__('Widgets Manager', true) . "</li>";					
					break;
		}
	}
/**
 * getTitle() method
 * 
 * @param string $layout_title
 * @param string  $layout_title
 * @return void
 */
	public function getTitle($layout_title, $location_site) {
		$ctlName = strtolower($location_site);
		$class = $ctlName."_title";
		$output = "<h2 class='$class'>";
		$output .= $layout_title;
		$output .= "</h2>";
		return $output;
	}	
/**
 * Nested Links
 * 
 * @param array $links
 * @param array $options
 */
	public function nestedLinks($links, $options = array()){
		// pasamos todos los atributos a un array;
		 $linkAttr = array(
		 	'id' => 'link-' . $links['Menu']['id'],
			'rel' => $links['Menu']['rel'],
			'target' => $links['Menu']['target'],
			'title' => $links['Menu']['title'],
			'alias' => $links['Menu']['alias'],
			'class' => $links['Menu']['link_class'],
			'image' => $links['Menu']['link_image']
         );
		//obtenemos los enlaces y lo descodificamos
		$type = json_decode($links['Menu']['link']);

		switch ($type->controller) {
		  case 'categories':
			return $this->Html->link($linkAttr['title'], array());
			break;
		  case 'pages':
			return $this->Html->link($linkAttr['title'], array(
					'controller' => $type->controller,
					'action' => $type->action,
					'slug' => 'home'
				),$linkAttr
			);
			break;
		 case 'contents':
			return $this->Html->link($linkAttr['title'], array(
					'controller' => $type->controller,
					'action' => $type->action,
					'slug' => $linkAttr['alias'],
					'ext' => 'html'
				),$linkAttr
			);
			break;
		}
	}
	
/**
 * getBlock method
 * 
 * @param string $name
 * @param string $style
 * @param array $options
 * @return void
 */
	public function getBlock($name, $style, $options = array()){
		
	}
	
	
}
