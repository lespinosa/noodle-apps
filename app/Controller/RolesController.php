<?php
/*
 * Luis Manuel
 * roles_controller.php 
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */

class RolesController extends AppController {
	var $helpers = array('Html', 'Form', 'Session', 'Paginator');	
	var $name = 'Roles';
	
	function beforeFilter() {
	    parent::beforeFilter(); 
		$this->Auth->allowedActions = array('*');
	  	$this->set('location_site', 'roles');
	}
 	function admin_index() {
 		$this->set('title_layout', 'Role Manager');
 		$this->layout = 'admin';
        $this->Role->recursive = 0;
        $this->set('roles', $this->paginate());
    }
	
 
    function admin_view($id = null) {
    	$this->set('title_layout', 'Role Manager: View Role');
    	$this->layout = 'admin';
    	$this->Role->id = $id;
        if (!$this->Role->id) {
            $this->Session->setFlash(__('Id Invalido, intentelo neuvamente.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('role', $this->Role->read());
    }
	public function admin_add() {
		$this->layout = 'admin';
		$this->set('title_layout', 'Role Manager: Add Role');
		if (!empty($this->request->data)) {
			if ($this->Role->save($this->request->data)) {
				$this->Session->setFlash(__('Your User has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
                $this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
           }
		}
	}
	function admin_edit($id = nul) {
		$this->layout = 'admin';
		$this->set('title_layout', 'Role Manager: Edital Rol');
		$this->Role->id = $id;
        if (!$this->Role->id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid Role', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->request->is('get')) {
        	$this->request->data = $this->Role->read();
        } else {
        	if ($this->Role->save($this->request->data)){
        		$this->Session->setFlash(__('El Rol ha sido actualizado.', true));
        		$this->redirect(array('action' => 'index'));
        	}
        }
            
    }
 
    function admin_delete($id) {
    	$this->layout = 'admin';
	    if (!$id) {
	        throw new MethodNotAllowedException();
	    }
        if ($this->Role->delete($id)) {
        	$this->Session->setFlash(__('El Rol ha sido eliminado.', true));
        	$this->redirect(array('action' => 'index'));
        }
    }

}