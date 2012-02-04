<?php

/**
 * UsersController.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('AppController', 'Controller');
// Importamos la clase Sanitize
App::uses('Sanitize', 'Utility');
/**
 * Users Controller
 * 
 * @property User $User
 */
class UsersController extends AppController{
	
	/**
	 * beforeFilter method
	 *
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allowedActions = array('*');	
		$this->set('location_site', 'users');
	 //$this->Auth->allow(array('*', 'logout', 'login'));
	   
	}
	/**
	 * admin_index method
	 * 
	 * @return void
	 */
	public function admin_index() {
		$this->set('title_layout', 'Users Manager');
		
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        
        // Filter
		//$this->data = Sanitize::clean($this->data, array('encode' => false));
		$name =  $this->request->data('User.name');
		$roleId =  Sanitize::paranoid($this->request->data('User.role_id'));
		$status =  Sanitize::paranoid($this->request->data('User.status'));

		if(!empty($name)){
			$data = $this->User->find('all',array( 'order' => array('User.name' => 'desc'),
			'conditions' => array('User.name LIKE '=> "%$name%")));
			$this->set('users', $data);
		}
		if($roleId >= 1){
			$data = $this->User->find('all',array( 'order' => array('User.name' => 'desc'),
			'conditions' => array('User.role_id '=> (int)$roleId)));
			$this->set('users', $data);
		}
		if($status >= 1){
			$data = $this->User->find('all',array('order' => array('User.name' => 'desc'),
			'conditions' => array('User.status' => (int)$status)));
			$this->set('users', $data);
		}  	  
      	$roles = $this->User->Role->find('list', array('order' => array('Role.id' => 'asc')));
      	$this->set(compact('roles'));
        
    }
	/**
	 * Admin view method
	 * 
	 * @return void
	 */
    public function admin_view($id = null) {
    	$this->set('title_layout', 'Users Manager: View Users');
		$this->User->id = $id;
        if (!$this->User->exists()) {
           throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }	
	/**
	 * admin_add method
	 * 
	 * @return void
	 */
	public function admin_add() {
		$this->set('title_layout', 'Add New User');
		if($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)){
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		//Get Roles
		$roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
	}
	/**
	 * admin_edit
	 * 
	 * @return void
	 */
 	public function admin_edit($id = null) {
		$this->set('title_layout', 'Users Manager: Edit User');
 		$this->User->id = $id;
		if(!$this->User->exists()){
			throw new NotFoundException(__('Invalid user'));
		}
        if ($this->request->is('post') || $this->request->is('put')) {
        	if ($this->User->save($this->request->data)) {
        		$this->Session->setFlash(__('The user has been update'));
				$this->redirect(array('action' => 'index'));			  
			} else {
			  $this->Session->setFlash(__('The user could not be update. Please, try again.'));
			}          
        } else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
        }
		//Get Roles        
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }
	/**
	 * admin_edit method
	 * 
	 * @return void
	 */
	public function admin_delete($id = null) {
		if(!$this->request->is('post')){
			throw MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()){
			throw NotFoundException(__('Invalid user'));
		}
		if ($this->User->detele()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
	/**
	 * login method
	 * 
	 * @return void
	 */
	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash('Your username or password was incorrect.');
	        }
	    }
		if ($this->Session->read('Auth.User')) {
	        $this->Session->setFlash('You are logged in!');
	        $this->redirect('/', null, false);
	    }
	}
	/**
	 * logout method
	 * 
	 * @return void
	 */
	public function logout() {
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());
	}
}