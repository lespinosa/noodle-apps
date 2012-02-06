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
 * Menutypes Controller
 * 
 * @property Menutype $Menutype
 */
class MenutypesController extends AppController
{
	public $name = 'Menutypes';
	
	function beforeFilter() {
	  parent::beforeFilter(); 
	  $this->Auth->allowedActions = array('*');	
	  $this->set('location_site', 'menuTypes');
	 // $this->Auth->allow(array('*', 'logout', 'login'));	   
	}
/**
 * admin index method
 * 
 * @return void
 */
	public function admin_index(){
		$this->set('title_layout', 'Menu Manager');
		$this->Menutype->recursive = 0;
		$this->set('menus', $this->paginate());
	}
/**
 * admin add method
 * 
 * @return void
 */
	public function admin_add(){
		$this->set('title_layout', 'Menu Manager: Add Menu');
		if ($this->request->is('post')) {
			$this->Menutype->create();
		  	if ($this->Menutype->save($this->request->data)) {
					$this->Session->setFlash(__('The Menu Type has been saved.'));
					$this->redirect(array('action' => 'index'));
			  } else {
					$this->Session->setFlash(__('The Menu Type could not saved. Please try again.'), 'default', array('class' => 'error'));
					$this->redirect(array('action' => 'index'));
			  }		  
		}
	}
/**
 * admin edit method
 * 
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null){
		$this->set('title_layout', 'Menu Manager: Editar Menu');
		$this->Menutype->id = $id;
		if (!$this->Menutype->exists()) {
			$this->Session->setFlash(__('invalid menutype'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		  	if ($this->Menutype->save($this->request->data)) {
					$this->Session->setFlash(__('The Menu type has been update.'));
					$this->redirect(array('action' => 'index'));
			  } else {
					$this->Session->setFlash(__('The Menu Type could not update. Please try again.'), 'default', array('class' => 'error'));
			  }			  
		} else {
			$this->request->data = $this->Menutype->read(null, $id);
		}		
		//GET All menutype
		$menu = $this->Menutype->find();
		//SET @var $menu
        $this->set('menu', $menu);
	}
/**
 * admin delete method
 * 
 * @param string $id 
 */
	public function admin_delete($id = null) {
       $this->Menutype->id = $id;
	   if (!$this->Menutype->exists()) {
			$this->Session->setFlash(__('Invalid Menutype'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
	   }
	   if ($this->Menutype->delete()) {
	   		$this->Session->setFlash(__('Menu deleted', true));
            $this->redirect(array('action'=>'index'));
	   }
	   $this->Session->setFlash(__('Menu was not deleted'), 'default', array('class' => 'error'));
	   $this->redirect(array('action' => 'index'));
    }
}