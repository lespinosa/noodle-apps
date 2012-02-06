<?php
/**
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 * 
 * @property Menu $Menu
 */
class MenusController extends AppController
{
	public $name = 'Menus';
	var $helpers = array('Html', 'Tree', 'Menu');
	
	function beforeFilter() {
	   parent::beforeFilter(); 
	  $this->Auth->allowedActions = array('*');	
	  $this->set('location_site', 'menus');
	 // $this->Auth->allow(array('*', 'logout', 'login'));	   
	}
/**
 * admin index method
 * 
 * @param int id
 * @return void
 */
	public function admin_index($id = 7){
		//Filter Conditions  
		if ($id == null) {
			$menuId = $this->request->data('Menu.filter_menutype');
		} elseif($this->request->data('Menu.filter_menutype') == 0) {
			$menuId = $id;
		} else {
			$menuId = $this->request->data('Menu.filter_menutype');
		}
		$this->set('title_layout', 'Menu Manager: Menu Items');
 		
		$menuType = $menuId;
        $this->Menu->recursive = 0;
		//GET All Menu
		$linksTree = $this->Menu->generateTreeList(array(
				'Menu.menutype_id' => $menuId,
				));
		//GET all Menu 
		$linksMenuType = $this->Menu->find('list', array(
            'conditions' => array(
                'Menu.menutype_id' => $menuId,
            ),
            'fields' => array(
                'Menu.id',
                'Menu.menutype_id',
            ),
        ));
		//GET all Role
		$roles = $this->Menu->Role->find('list', array('order' => array('Role.id' => 'asc')));
		$menutypes = $this->Menu->Menutype->find('list');
        $this->set('menus', $this->paginate());
		$this->set(compact('linksTree', 'linksMenuType', 'menuType', 'roles', 'menutypes'));
				
		// GET all Data Filtle
		$filter_title		= $this->request->data('Menu.filter_search');
		$filter_status		= $this->request->data('Menu.filter_status');
		$filter_menutype	= $this->request->data('Menu.filter_menutype');
		$filter_access		= $this->request->data('Menu.filter_role');
		$filter_lang		= $this->request->data('Menu.filter_language');

		// title condition
		if(!empty($filter_title)) {
			$titleData = $this->Menu->find('all', array('order' => array('Menu.title' => 'desc'),
			'conditions' => array('Menu.title LIKE' => "%$filter_title%")));
			$this->set('menus', $titleData);
		}
		// status condition
		if($filter_status >= 1 or $filter_menutype > 0 or $filter_access > 0 or $filter_lang > 0) {
			
			// Codition Status
			if($filter_status >= 1) {
				$condition_status = array('Menu.status' => (int)$filter_status);
			} else {
				$condition_status = null;
			}
			// Codition menutype
			if($filter_menutype > 0) {
				$condition_menutype = array('Menu.menutype_id' => (int)$filter_menutype);
			} else {
				$condition_menutype = null;
			}
			// Codition Access
			if($filter_access > 0) {
				$condition_access = array('Menu.role_id' => (int)$filter_access);
			} else {
				$condition_access = null;
			}
			
			// Codition Language
			if($filter_lang > 0) {
				$condition_lang = array('Menu.user_id' => (int)$filter_lang);
			} else {
				$condition_lang = null;
			}
			$linksTree = $this->Menu->generateTreeList(array(
					$condition_status,
					$condition_menutype,
					$condition_access,
					$condition_lang,
					
			));
			
			$this->set(compact('linksTree'));
		}		
	}
/**
 * admin listtype method
 * 
 * @param init $id
 * @param ini $menuTypeId
 * @param string $link_type
 * @return ajax void
 */
	public function admin_liststype($id = null, $menuTypeId = null, $link_type = null){
		$this->set('title_layout', '');
		$this->layout = 'clear';
		$itemId = $id;
		$this->set(compact('itemId', 'menuTypeId', '$link_type'));
	}
/**
 * admin add method
 * 
 * @param init $id
 * @param ini $menuTypeId
 * @param string $linkType
 * @return void
 */
	public function admin_add($id = null, $menuTypeId = null, $linkType = null){
		$this->set('title_layout', 'Menu Manager: Add Link');
		$itemId = $id;
		$link_type = $linkType;
		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
			  	$this->Session->setFlash(__('The link has been saved.'));
				$this->redirect(array('action' => 'index', $id));
			} else {
			  	$this->Session->setFlash(__('The link could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}			
		}		
		$menuTypeId = $id;
		//GET all Menutype
		$menutypes = $this->Menu->Menutype->find('list');
		//GET all Menu Items
		$parentLinks = $this->Menu->generateTreeList(array(
				'Menu.menutype_id' => $menuTypeId
				), '_');
		//GET all Users
      	$users = $this->Menu->User->find('list');
		//GET all Roles
		$roles = $this->Menu->Role->find('list', array('order' => array('Role.id' => 'asc')));
		//SET all variable
      	$this->set(compact('menutypes', 'menuTypeId', 'parentLinks', 'roles', 'users', 'link_type', 'itemId'));
		
		
	}
/**
 * admin edit method
 * 
 * @param init $id
 * @param ini $menuTypeId
 * @param string $linkType
 * @return void
 */
	public function admin_edit($id = null, $menuTypeId = null, $linkType = null){
		$this->set('title_layout', 'Menu Manager: Edit Link');
		$data = new stdClass();
		$data->param1 = $this->request->data('Menu.param1');
		$data->param2 = $this->request->data('Menu.param2');
		//$this->request->data('Menu.param', json_encode($data));
		//$this->Form->input('params', array('value' => json_encode($data)));
		$this->Menu->id = $id;
		$itemId = $id;
		if($linkType == null){
			$link_type = $this->request->data('Menu.link_type');
		} else {
			$link_type = $linkType;
		}		
		if (!$this->Menu->exists()) {
			$this->Session->setFlash(__('Menu invalido.', true), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index', $menuTypeId));			
		}
		if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Menu->save($this->request->data)) {
					//SAVE all Params
					$this->Menu->saveField('params', json_encode($data));
					$this->Session->setFlash(__('The link has been update.', true));
					$this->redirect(array('action' => 'index', $menuTypeId));				
				} else {
				  	$this->Session->setFlash(__('The link could not be update. Please, try again.'), 'default', array('class' => 'error'));
				}			
		} else {
			$this->request->data = $this->Menu->read(null, $id);
		}
		$menuTypeId = $menuTypeId;
		// GET all Roles
		$roles = $this->Menu->Role->find('list', array('order' => array('Role.id' => 'asc')));
		// GET all Menutype
		$menutypes = $this->Menu->Menutype->find('list');
		// GET all Menu Items
		$parentLinks = $this->Menu->generateTreeList(array(
				'Menu.menutype_id' => $menuTypeId
				), '_');				
		//SET all Variable
      	$this->set(compact('menutypes', 'menuTypeId', 'parentLinks', 'roles', 'link_type', 'itemId'));
	}
/**
 * admin delete method
 * 
 * @param init $id
 * @param init $menuTypeId
 * @return void
 */
	public function admin_delete($id = null, $menuTypeId = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
		  	$this->Session->setFlash(__('Invalid id for link', true), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index', $menuTypeId));
		}
		if($this->Menu->delete()){
			$this->Session->setFlash(__('Link eliminado.', true));
			$this->redirect(array('action' => 'index', $menuTypeId));
		}
		$this->Session->setFlash(__('Link was not deleted'), 'defualt', array('action' => 'error'));
		$this->redirect(array('action' => 'index', $menuTypeId));
	}
/**
 * admin movedown method
 * 
 * @param string $title
 * @param init $menuTypeId
 * @return void
 */
	public function admin_movedown($title = null, $menuType, $step = 1){
		$link = $this->Menu->findByTitle($title);
		if(empty($link)){
			$this->Session->setFlash(__('No hay un enlace con el titulo' . $link, true));
			$this->redirect(array('acion' => 'index',$menuType), null, true);
		}
		$this->Menu->id = $link['Menu']['id'];
		if ($step > 0){
			$this->Menu->moveDown($this->Menu->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia abajo.', true));
		}
		$this->redirect(array('action' => 'index',$menuType), null, true);
	}
/**
 * admin moveup method
 * 
 * @param string $title
 * @param init $menuTypeId
 * @return void
 */
	public function admin_moveup($title = null, $menuType, $step = 1){
		$link = $this->Menu->findByTitle($title);
		if(empty($link)){
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
			$this->redirect(array('acion' => 'index',$menuType), null, true);
		}
		$this->Menu->id = $link['Menu']['id'];
		if($step > 0){
			$this->Menu->moveUp($this->Menu->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
		}
		$this->redirect(array('action' => 'index',$menuType), null, true);
	}	
}