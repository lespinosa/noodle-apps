<?php
/**
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */

class MenutypesController extends AppController
{
	var $name = 'Menutypes';
	//public $uses = array('Menu');
	
	function beforeFilter() {
	  parent::beforeFilter(); 
	  $this->Auth->allowedActions = array('*');	
	  $this->set('location_site', 'menuTypes');
	 // $this->Auth->allow(array('*', 'logout', 'login'));	   
	}
	
	public function admin_index(){
		$this->set('title_layout', 'Menu Manager');
		$this->Menutype->recursive = 0;
		$this->set('menus', $this->paginate());
	}
	public function admin_add(){
		$this->set('title_layout', 'Menu Manager: Add Menu');
		if(!empty($this->request->data)){
			if($this->Menutype->save($this->request->data)){
				$this->Session->setFlash(__('Your User has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Menu no se ha guardado. Intentelo de nuevo porfavor', true));
			}
		}
	}
	public function admin_edit($id = null){
		$this->set('title_layout', 'Menu Manager: Editar Menu');
		$this->Menutype->id = $id;
		if(!$this->Menutype->id && empty($this->request->data)){
			$this->Session->stFlash(__('Menu invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->request->is('get')) {
			$this->request->data = $this->Menutype->read();
		} else {
			if ($this->Menutype->save($this->request->data)) {
				$this->Session->setFlash(__('El Menu ha sido actualizado!', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		$menu = $this->Menutype->find();
        $this->set('menu', $menu);
	}
	function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Menu', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Menutype->delete($id)) {
            $this->Session->setFlash(__('Menu deleted', true));
            $this->redirect(array('action'=>'index'));
        }
    }
}
