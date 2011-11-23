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

// Importamos la clase Sanitize
App::uses('Sanitize', 'Utility');

class UsersController extends AppController{
	var $name = 'Users';
	
	function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allowedActions = array('*');	
	  $this->set('location_site', 'users');
	 //$this->Auth->allow(array('*', 'logout', 'login'));
	   
	}
	function admin_index() {
		$this->set('title_layout', 'Users Manager');
		$this->layout = 'admin';
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
    function admin_view($id) {
    	$this->set('title_layout', 'Users Manager: View Users');
		$this->layout = 'admin';
        if (!$id) {
            $this->Session->setFlash(__('Invalid User.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('user', $this->User->read(null, $id));
    }	
	function login() {
		$this->layout = 'admin';
		$this->set('title_layout', 'Login');
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash('Your username or password was incorrect.');
	        }
	    }
	}


	public function logout() {
		$this->layout = 'admin';
    	$this->Session->setFlash(__('Good-Bye', true));
		$this->redirect($this->Auth->logout());		
	}
	function admin_add() {
		$this->set('title_layout', 'Add New User');
		$this->layout = 'admin';
		if (!empty($this->request->data)) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Your User has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
                $this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
           }
		}
		
		$roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
	}
 	function admin_edit($id = null) {
 		$this->set('title_layout', 'Users Manager: Edit User');
 		$this->layout = 'admin';
 		$this->User->id = $id;
        if (!$this->User->id && empty($this->request->data)) {
            $this->Session->setFlash('Invalid User');
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The User has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->User->read();
        }
        
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }
	public function admin_delete($id = null) {
		$this->layout = 'admin';
        if (!$id) {
	        throw new MethodNotAllowedException();
	    }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted', true));
            $this->redirect(array('action'=>'index'));
        }
    }
}