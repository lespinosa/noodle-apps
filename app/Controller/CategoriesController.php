<?php

/**
 * CategoriesController.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
class CategoriesController extends AppController
{
	public $name = 'Categories';
	public $uses = array(
		'Category',
		'User',
		'Role'
	);
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allowedActions = array('*');
		
		$this->set('location_site', 'categories');
	}
	public function admin_index($id = null)
	{
		$this->layout = 'admin';
		$this->set('title_layout', 'Category Manager');
		$this->Category->recursive = 0;
		$categoryTree = $this->Category->generateTreeList(null);
		$this->set('categories', $this->paginate());
		$this->set(compact('categoryTree'));
		// Filtle
		$filter_title	= $this->request->data('Category.filter_search');
		$filter_status	= $this->request->data('Category.filter_status');
		$filter_access	= $this->request->data('Category.filter_role');
		$filter_lang	= $this->request->data('Category.filter_language');
	
		// title condition
		if(!empty($filter_title)) {
			$titleData = $this->Category->find('all', array('order' => array('Category.title' => 'desc'),
			'conditions' => array('Category.title LIKE' => "%$filter_title%")));
			$this->set('categoryTree', $titleData);
		}
		// status condition
		if($filter_status >= 1 or $filter_access > 0 or $filter_lang > 0) {
			
			// Codition Status
			if($filter_status >= 1) {
				$condition_status = array('Category.status' => (int)$filter_status);
			} else {
				$condition_status = null;
			}
			
			// Codition Access
			if($filter_access > 0) {
				$condition_access = array('Category.role_id' => (int)$filter_access);
			} else {
				$condition_access = null;
			}
			
			// Codition Language
			if($filter_lang > 0) {
				$condition_lang = array('Category.user_id' => (int)$filter_lang);
			} else {
				$condition_lang = null;
			}
		
			$categoryTree = $this->Category->generateTreeList(array(
					$condition_status,
					$condition_access,
					$condition_lang,
					
			));
			$this->set(compact('categoryTree'));
		}
		$categoryStatus = $this->Category->find('list');
		$categoryLeft = $this->Category->find('list', array(
				'fields' => array(
					'Category.lft'
					), 
			));
		$roles = $this->Category->Role->find('list');		
		$this->set(compact('categoryLeft', 'roles'));
	}
	
	
	public function admin_add()
	{
		$this->layout = 'admin';
		$this->set('title_layout', 'Category Manager: Add Category');
		
		if(!empty($this->request->data)) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('Your Category has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please try again.', true));
			}
		}
		$parents = $this->Category->generateTreeList(null, '_');
		$roles = $this->Category->Role->find('list');
		$this->set(compact('parents', 'roles'));
	}
	public function admin_edit($id = null) {
		$this->layout = 'admin';
		$this->set('title_layout', 'Category Manager: Edit Category');
		$this->Category->id = $id;
		if (!$this->Category->id && empty($this->request->data)) {
			$this->Session->setFlash(__(' Invalid Category id', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('get')) {
			$this->request->data = $this->Category->read();
		} else {
			if($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		$parents = $this->Category->generateTreeList(null, '_');
		$roles = $this->Category->Role->find('list');
		$this->set(compact('parents', 'roles'));
		
	}
	public function admin_delete($id = null) {
		$this->layout = 'admin';
		$this->Category->id = $id;
		if (!$this->Category->id) {
			$this->Session->setFlash(__('Invalid Id for Category', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The Category has been deleted.'));
			$this->redirect(array('action' => 'index'));
		}
	}
	public function admin_movedown($id, $step = 1) {
		if(empty($id)) {
			$this->Session->setFlash(__('Invalid id for Category'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Category->id = $id;
		if ($step > 0) {
			$this->Category->moveDown($this->Category->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que la categoria debe ser movida hacia abajo.', true));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
	public function admin_moveup($id, $step = 1){
		if(empty($id)){
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
			$this->redirect(array('acion' => 'index'), null, true);
		}
		$this->Category->id = $id;
		if($step > 0){
			$this->Category->moveUp($this->Category->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
}