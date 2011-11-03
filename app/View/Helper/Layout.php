<?php

/**
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('Role', 'Model');
class LayoutHelper extends Helper
{
	
	var $helpers = array('Html', 'Session', 'Form');

	/*function __construct($argument) {
		
	}*/
	public function getStatus($value, $type = ''){
		switch ($type) {
			case 'img':
				if($value == 1){
					$output = '<div class="status">'. $this->Html->image('admin/icons/tick.png', array('alt' => 'Published')) . '</div>';
				} else {
					$output = '<div class="status">'. $this->Html->image('admin/icons/cross.png', array('alt' => 'Unpublished')) . '</div>';
				}
				return $output;			
				break;
			
			default:
			case 'text':
				if($value == 1){
					$output = "Published";
				} else {
					$output = 'Unpublished';
				}
				return $output;
				break;
		}
	}
	public function getFeatured($value, $type = ''){
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
	public function getCategory($id) {
		App::import('Controller', 'Categories');
		$Content = new CategoriesController;
		$output = $Content->Category->find('first', array(
				'conditions' => array('Category.id' => $id)));
		return '<span>'.$output['Category']['title']. '</span>';
		
	}
	public function getAccess($id, $type = null){
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
	public function getAuthor($modelName, $uid = null, $type = null){
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
	public function getOrdering($modelName = null, $Id, $linksMenuType = null, $type = null, $lft = null){
		switch ($type) {
			case 'img':
				$output = "<ul class='ordering'>";
				$output .= "<li>";
				$output .= $this->Html->link($this->Html->image('admin/icons/up_icon.png', array(
								'alt' => 'Move Up')), array('action' => 'moveup', $Id, $linksMenuType),
								array('escape' => false));
				$output .= "</li>";
				$output .= "<li>";
				$output .= $this->Html->link($this->Html->image('admin/icons/down_icon.png', array(
								'alt' => 'Move Down')), array('action' => 'movedown', $Id, $linksMenuType),
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
	public function getMenu(){
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
	public function getSubnav($location){
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

				case 'engadget install':
					echo "<li class='active'>".__('Install', true) . "</li>";
					echo "<li>". $this->Html->link(__('Engadgets Manager', true), array('controller' => 'engadgets', 'action' => 'manager')). "</li>";
					break;
				case 'engadget manager':
					echo "<li>". $this->Html->link(__('Install', true), array('controller' => 'engadgets', 'action' => 'index')). "</li>";
					echo "<li class='active'>".__('Engadgets Manager', true) . "</li>";
					
					break;
		}
	}
	
}
