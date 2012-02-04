<?php
/*
 * Luis Manuel
 * roles_controller.php 
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 * 
 * @property Role $Role
 */
class RolesController extends AppController {
	/**
	 * beforeFilter method
	 * 
	 * @return void
	 */
	public function beforeFilter() {
	    parent::beforeFilter(); 
		$this->Auth->allowedActions = array('*');
	  	$this->set('location_site', 'roles');
	}
	/**
	 * admin_index method
	 * 
	 * @return void
	 */
 	public function admin_index() {
 		$this->set('title_layout', 'Role Manager');
        $this->Role->recursive = 0;
        $this->set('roles', $this->paginate());
    }
	/**
	 * admin_view method
	 * 
	 * @return void
	 */ 
    public function admin_view($id = null) {
    	$this->set('title_layout', 'Role Manager: View Role');
    	$this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid Role'));           
        }
        $this->set('role', $this->Role->read(null, $id));
    }
	/**
	 * admin_add method
	 * 
	 * @return void
	 */
	public function admin_add() {
		$this->set('title_layout', 'Role Manager: Add Role');
		if ($this->request->is('post')) {
			$this->Role->create();
			if ($this->Role->save($this->request->data)) {
			    $this->Session->setFlash(__('The role has been saved'));
                $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The role could not be saved. Please, try again.'));
			}			
		}
	}
	/**
	 * admin_edit method
	 * 
	 * @return void
	 */
	public function admin_edit($id = nul) {
		$this->set('title_layout', 'Role Manager: Edital Rol');
		$this->Role->id = $id;
		if(!$this->Role->exists()){
			throw new NotFoundException(__('Invalid role'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		  if ($this->Role->save($this->request->data)) {
		  	$this->Session->setFlash(__('The Role has been saved'));
			$this->redirect(array('action' => 'index'));
		  } else {
			$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
		  }		  
		} else {
		  $this->request->data = $this->Role->read(null, $id);
		}        
    }
	/**
	 * admin_delete method
	 * 
	 * @return void
	 */
    public function admin_delete($id) {
    	if ($this->request->is('post')){
    		throw new MethodNotAllowedException();
    	}
    	$this->Role->id = $id;
	    if (!$this->Role->exists()) {
	        throw new NotFoundException(__('Invalid Role'));
	    }
        if ($this->Role->delete()) {
        	$this->Session->setFlash(__('El Rol ha sido eliminado.', true));
        	$this->redirect(array('action' => 'index'));
        }
		$this->Session->setFlash(__('Role was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}