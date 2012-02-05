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
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
/**
 * Contents Controller
 * 
 * @property Content $Content
 */
class ContentsController extends AppController
{
	public $name = 'Contents';
	var $paginate = array(
		'limit' => 25,
		'order' => array(
			'Content.lft' => 'asc'
		)
	);
/**
 * beforeFilter method
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('location_site', 'contents');
		$this->Auth->allowedActions = array('*');	
		//$this->Auth->allow(array('*', 'view'));
		
	}
/**
 * index method
 *
 * @return void
 */
	public function index(){
		$this->set('title_layout', 'Articles Lists');
		$this->Content->recursive = 0;
		$contents = $this->Content->find('all');
		$this->set('contents', $contents);
	}
/**
 * admin index method
 *
 * @return void
 */
	public function admin_index(){		
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
		//GET Categories List		
		$categories = $this->Content->Category->generateTreeList(null, '_');
		//GET UserId
		$contentUserId = $this->Content->find('list', array('fields' => 'user_id'));
		//GET Access
		$access = $this->Content->query("SELECT DISTINCT c.access FROM contents as c");
		//GET Author List
		$author = $this->Content->User->find('list', array(
					'conditions' => array (
						'User.id' => $contentUserId)
					));
		//GET All Role
		$roles = $this->Content->Role->find('list');
		//SET all var to the View
		$this->set(compact('categories', 'roles', 'author', 'access'));
		
		// Lang Condition
	}
/**
 * admin add method
 *
 * @return void
 */	
	public function admin_add()
	{	
		$this->set('title_layout', 'Articles Manager: Add Article');
		if ($this->request->is('post')) {
			$this->Content->create();
			if ($this->Content->save($this->request->data)) {
			  	$this->Session->setFlash(__('The Content has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
			  	$this->Session->setFlash(__('The Content could not be saved. Please try again'));
			}			
		}
		//GET all Category
		$categories = $this->Content->Category->generateTreeList(null, '_');
		//GET all Roles
		$roles = $this->Content->Role->find('list');
		//GET all Users
		$users = $this->Content->User->find('list');
		//SET all var for the view
		$this->set(compact('categories', 'roles', 'users'));
	}
/**
 * admin edit method
 * 
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null)
	{
		$this->set('title_layout', 'Articles Manager: Edit Article');
		$this->Content->id = $id;
		if (!$this->Content->exists()){
			$this->Session->setFlash(__('Content id not Exists'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		  	if ($this->Content->save($this->request->data)) {
		  		$this->Session->setFlash(__('The Content has been update'));
				$this->redirect(array('action' => 'index'));				
			  } else {
				$this->Session->setFlash(__('The Content could not be update'));
			  }			  
		} else {
		  	$this->request->data = $this->Content->read(null, $id);
		}
		
		$categories = $this->Content->Category->generateTreeList(null, '_');
		$roles = $this->Content->Role->find('list');
		$users = $this->Content->User->find('list');
		$this->set(compact('categories', 'roles', 'users'));
	}
/**
 * admin delete method
 * 
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if($this->request->is('get')){
			$this->Content->id = $id;
			if (!$this->Content->exists()) {
				$this->Session->setFlash(__('Invalid id for Article'), 'default', array('class' => 'error'));
				$this->redirect(array('action' => 'index'));
			}
			if ($this->Content->delete()) {
				$this->Session->setFlash(__('The Article has been deleted.'));
				$this->redirect(array('action' => 'index'));
			}		
		}
		$this->Session->setFlash(__('Content was not deleted'));
		$this->redirect(array('action' => 'index'));		
	}
/**
 * admin movedown method
 * 
 * @param string $title
 * @return void
 */
	public function admin_movedown($title, $step = 1){
		$cont = $this->Content->findByTitle($title);
		if(empty($cont)){
			$this->Session->setFlash(__('No hay un ariculo con el id' . $id, true), 'default', array('class' => 'error'));
			$this->redirect(array('acion' => 'index'), null, true);
		}
		$this->Content->id = $cont['Content']['id'];
		if ($step > 0){
			$this->Content->moveDown($this->Content->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia abajo.', true), 'defual', array('class' => 'error'));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
/**
 * admin moveup method
 * 
 * @param string $title
 * @return void
 */
	public function admin_moveup($title, $step = 1){
		$cont = $this->Content->findByTitle($title);
		if(empty($cont)){
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
			$this->redirect(array('acion' => 'index'), null, true);
		}
		$this->Content->id = $cont['Content']['id'];
		if($step > 0){
			$this->Content->moveUp($this->Content->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
}
