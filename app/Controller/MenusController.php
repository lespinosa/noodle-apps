<?php
/**
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */

class MenusController extends AppController
{
	var $name = 'Menus';
	var $helpers = array('Html', 'Tree', 'Menu');
	 public $uses = array(
        'Menu',
        'Menutype',
        'Role',
    );
	function beforeFilter() {
	   parent::beforeFilter(); 
	  $this->Auth->allowedActions = array('*');
	  $this->layout = 'admin';
	
	  $this->set('location_site', 'menus');
	 // $this->Auth->allow(array('*', 'logout', 'login'));	   
	}
	function index($id = null) {
		
	}
	public function admin_index($id = 7){
		$this->set('title_layout', 'Menu Items');
 		$this->layout = 'admin';
		$menuType = $id;
        $this->Menu->recursive = 0;
		$linksTree = $this->Menu->generateTreeList(array(
				'Menu.menutype_id' => $id,
				));
		$linksStatus = $this->Menu->find('list', array(
            'conditions' => array(
                'Menu.menutype_id' => $id,
            ),
            'fields' => array(
                'Menu.id',
                'Menu.status',
            ),
        ));
		$linksMenuType = $this->Menu->find('list', array(
            'conditions' => array(
                'Menu.menutype_id' => $id,
            ),
            'fields' => array(
                'Menu.id',
                'Menu.menutype_id',
            ),
        ));
		//$this->data = $someCategories;
		$roles = $this->Role->find('list', array('order' => array('Role.id' => 'asc')));
        $this->set('menus', $this->paginate());
		$this->set(compact('linksTree', 'linksStatus', 'linksMenuType', 'menuType', 'roles'));	
		
	}
	public function admin_add($id = null){
		$this->set('title_layout', 'Add Link');
		if (!empty($this->request->data)){
			if ($this->Menu->save($this->request->data)){
				$this->Session->setFlash(__('El enlace fue salvado.', true));
				$this->redirect(array('action' => 'index', $id));
			} else {
				$this->Session->setFlash(__('El enlace no ha podido ser guardado.', true));
			}
		}
		$menuTypeId = $id;
		$menutypes = $this->Menu->Menutype->find('list');
		$parents = $this->Menu->generateTreeList(array(
				'Menu.menutype_id' => $id,
				), '_');
      	$this->set(compact('menutypes', 'menuTypeId', 'parents'));
	}
	public function admin_edit($id = null, $menuTypeId = null){
		$this->set('title_layout', 'Edit Link');
		$this->Menu->id = $id;
		if (!$this->Menu->id && empty($this->request->data)) {
			$this->Session->setFlash(__('Menu invalido.', true));
			$this->redirect(array('action' => 'index', $menuTypeId));
			
		}
		if ($this->request->is('get')) {
			$this->request->data = $this->Menu->read();
			
		} else {
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('El Menu ha sido actualizado.', true));
				$this->redirect(array('action' => 'index', $menuTypeId));
				
			}
			
		}
		$menuTypeId = $menuTypeId;
		$menutypes = $this->Menu->Menutype->find('list');
		$parentLinks = $this->Menu->generateTreeList(array(
				'Menu.menutype_id' => $menuTypeId
				), '_');
      	$this->set(compact('menutypes', 'menuTypeId', 'parentLinks'));

	}
	public function admin_delete($id = null, $menuTypeId = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for link', true));
			$this->redirect(array('action' => 'index', $menuTypeId));
		}
		if ($this->Menu->delete($id)) {
			$this->Session->setFlash(__('Link eliminado.', true));
			$this->redirect(array('action' => 'index', $menuTypeId));
		}
	}
	public function admin_movedown($linkId, $menuType, $step = 1){
		if(empty($linkId)){
			$this->Session->setFlash(__('No hay un enlace con el id' . $linkId, true));
			$this->redirect(array('acion' => 'index',$menuType), null, true);
		}
		$this->Menu->id = $linkId;
		if ($step > 0){
			$this->Menu->moveDown($this->Menu->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia abajo.', true));
		}
		$this->redirect(array('action' => 'index',$menuType), null, true);
	}
	public function admin_moveup($linkId, $menuType, $step = 1){
		if(empty($linkId)){
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
			$this->redirect(array('acion' => 'index',$menuType), null, true);
		}
		$this->Menu->id = $linkId;
		if($step > 0){
			$this->Menu->moveUp($this->Menu->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
		}
		$this->redirect(array('action' => 'index',$menuType), null, true);
	}

	
}