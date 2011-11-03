<?php

/**
 * ContentsController.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('Sanitize', 'Utility');
class ContentsController extends AppController
{
	public $name = 'Contents';
	var $paginate = array(
		'limit' => 25,
		'order' => array(
			'Content.lft' => 'asc'
		)
	);
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->set('location_site', 'contents');
		$this->Auth->allowedActions = array('*');	
		//$this->Auth->allow(array('*', 'view'));
		
	}
	public function index(){
		$this->set('title_layout', 'Articles Lists');
		$this->Content->recursive = 0;
		$contents = $this->Content->find('all');
		$this->set('contents', $contents);
	}
	public function admin_index(){
		$this->layout = 'admin';
		$this->set('title_layout', 'Articles Manager');
		$this->Content->recursive = 0;
		$this->set('contents', $this->paginate());
		
		// Filtle
		$filter_title	= $this->request->data('Content.filter_search');
		$filter_status	= $this->request->data('Content.filter_status');
		$filter_cat		= $this->request->data('Content.filter_category');
		$filter_access	= $this->request->data('Content.filter_role');
		$filter_author	= $this->request->data('Content.filter_author');
		$filter_lang	= $this->request->data('Content.filter_language');
	
		// title condition
		if(!empty($filter_title)) {
			$titleData = $this->Content->find('all', array('order' => array('Content.title' => 'desc'),
			'conditions' => array('Content.title LIKE' => "%$filter_title%")));
			$this->set('contents', $titleData);
		}
		// status condition
		if($filter_status >= 1 or $filter_cat > 0 or $filter_access > 0 or $filter_author > 0 or $filter_lang > 0) {
			
			// Codition Status
			if($filter_status >= 1) {
				$condition_status = array('Content.status' => (int)$filter_status);
			} else {
				$condition_status = null;
			}
			// Codition Cat
			if($filter_cat > 0) {
				$condition_cat = array('Content.category_id' => (int)$filter_cat);
			} else {
				$condition_cat = null;
			}
			// Codition Access
			if($filter_access > 0) {
				$condition_access = array('Content.role_id' => (int)$filter_access);
			} else {
				$condition_access = null;
			}
			// Codition Author
			if($filter_author > 0) {
				$condition_author = array('Content.user_id' => (int)$filter_author);
			} else {
				$condition_author = null;
			}
			// Codition Language
			if($filter_lang > 0) {
				$condition_lang = array('Content.user_id' => (int)$filter_lang);
			} else {
				$condition_lang = null;
			}
		
			$contentsData = $this->Content->find('all', array(
				'order' => array('Content.title' => 'desc'),
				'conditions' => array(
					$condition_status,
					$condition_cat,
					$condition_access,
					$condition_author,
					$condition_lang,
				)
					
			));
			$this->set('contents', $contentsData);
		}
		
		$categories = $this->Content->Category->generateTreeList(null, '_');
		$contentUserId = $this->Content->find('list', array('fields' => 'user_id'));
		$access = $this->Content->query("SELECT DISTINCT c.access FROM contents as c");
		$author = $this->Content->User->find('list', array(
					'conditions' => array (
						'User.id' => $contentUserId)
					));
		$roles = $this->Content->Role->find('list');
		
		$this->set(compact('categories', 'roles', 'author', 'access'));
		
		// Lang Condition
	}
	
	public function admin_add()
	{
		$this->layout = 'admin';
		$this->set('title_layout', 'Add Article');
		if($this->request->is('post')) {
			if ($this->Content->save($this->request->data)) {
				$this->Session->setFlash(__('Your Article has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Article could not be saved. Please, try again.', true));
			}
		}
		$categories = $this->Content->Category->generateTreeList(null, '_');
		$roles = $this->Content->Role->find('list');
		$users = $this->Content->User->find('list');
		$this->set(compact('categories', 'roles', 'users'));
	}
	public function admin_edit($id = null)
	{
		$this->set('title_layout', 'Edit Article');
		$this->layout = 'admin';
		$this->Content->id = $id;
		if (!$this->Content->id && empty($this->request->data)) {
			$this->Session->setFlash(__('Articles invalido.', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('get')) {
			$this->request->data = $this->Content->read();
		} else {
			if ($this->Content->save($this->request->data)) {
				$this->Session->setFlash(__('El Article has be update', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		//$categories = $this->Content->Category->find('list');
		$categories = $this->Content->Category->generateTreeList(null, '_');
		$roles = $this->Content->Role->find('list');
		$users = $this->Content->User->find('list');
		$this->set(compact('categories', 'roles', 'users'));
	}
	public function admin_delete($id = null) {
		$this->layout = 'admin';
		$this->Content->id = $id;
		if (!$this->Content->id) {
			$this->Session->setFlash(__('Invalid id for Article', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Content->delete()) {
			$this->Session->setFlash(__('The Article has been deleted.'));
			$this->redirect(array('action' => 'index'));
		}
		
	}
	public function admin_movedown($id, $step = 1){
		if(empty($id)){
			$this->Session->setFlash(__('No hay un ariculo con el id' . $id, true));
			$this->redirect(array('acion' => 'index'), null, true);
		}
		$this->Content->id = $id;
		if ($step > 0){
			$this->Content->moveDown($this->Content->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia abajo.', true));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
	public function admin_moveup($id, $step = 1){
		if(empty($id)){
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
			$this->redirect(array('acion' => 'index'), null, true);
		}
		$this->Content->id = $id;
		if($step > 0){
			$this->Content->moveUp($this->Content->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
}
