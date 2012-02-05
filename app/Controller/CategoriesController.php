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
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 * 
 * @property Category $Category
 */
class CategoriesController extends AppController
{
/**
 * beforeFilter Method
 * 
 * @return void
 */	
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allowedActions = array('*');		
		$this->set('location_site', 'categories');
	}
/**
 * admin index Method
 * 
 * @return void
 */
	public function admin_index()
	{		
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
/**
 * admin add Method
 * 
 * @return void
 */
	public function admin_add(){
		$this->set('title_layout', 'Category Manager: Add Category');
		if($this->request->is('post')){
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The Category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}			
		}
		//Get Parents Category
		$parents = $this->Category->generateTreeList(null, '_');
		//Get Role list
		$roles = $this->Category->Role->find('list');
		//Set variables for view
		$this->set(compact('parents', 'roles'));
	}
/**
 * admin edit Method
 * 
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->set('title_layout', 'Category Manager: Edit Category');
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Category->save($this->request->data)) {
			  	$this->Session->setFlash(__('The Category has been update'));
				$this->redirect(array('action' => 'index'));
			} else {
			  	$this->Session->setFlash(__('The Category could not be update. Please, try again.'));
			}					  
		} else {
		  $this->request->data = $this->Category->read(null, $id);
		}
		//Get Parents Category
		$parents = $this->Category->generateTreeList(null, '_');
		//Get Role list
		$roles = $this->Category->Role->find('list');
		//Set variables for view
		$this->set(compact('parents', 'roles'));		
	}
/**
 * admin delete Method
 * 
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if($this->request->is('get')) {		
			$this->Category->id = $id;
			if (!$this->Category->exists()) {
				throw new NotFoundException(__('Invalid Category'));
			}
			if ($this->Category->delete()) {
				$this->Session->setFlash(__('The Category has been deleted.'));
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Category was not deleted'));
        $this->redirect(array('action' => 'index'));
	}
/**
 * admin_movedown Method
 * 
 * @param string $title
 * @return void
 */
	public function admin_movedown($title, $step = 1) {
		$cat = $this->Category->findByTitle($title);
		if(empty($cat)) {
			$this->Session->setFlash(__('There is no category named ' . $title));
			$this->redirect(array('action' => 'index'));
		}
		$this->Category->id = $cat['Category']['id'];
		if ($step > 0) {
			$this->Category->moveDown($this->Category->id, abs($step));
		} else {
			$this->Session->setFlash(__('Please provide the number of positions the field should be moved down.', true));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
/**
 * admin moveup Method
 * 
 * @param string $title
 * @return void
 */
	public function admin_moveup($title, $step = 1){
		$cat = $this->Category->findByTitle($title);
        if (empty($cat)) {
            $this->Session->setFlash('There is no category named ' . $title);
            $this->redirect(array('action' => 'index'), null, true);
        }
		$this->Category->id = $cat['Category']['id'];
		if($step > 0){
			$this->Category->moveUp($this->Category->id, abs($step));
		} else {
			$this->Session->setFlash('Please provide a number of positions the category should be moved up.');
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
}