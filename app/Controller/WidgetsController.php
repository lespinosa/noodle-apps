<?php

/**
 * ModulesController.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */

class WidgetsController extends AppController
{
	public $name = "Widgets";
	public $paginate = array(
			'limit' => 25,
			'order'=> array(
				'Widget.lft' => 'asc'
			)
	);
	function beforeFilter() {
		parent::beforeFilter();
		$this->set('location_site', 'widgets');		
		$this->Auth->allowedActions = array('*');
		$this->layout = 'admin';
		//$this->Auth->allow(array('*', 'view'));
		
	}	
	public function admin_index(){
		$this->set('location_site', 'widgets_Manager');	
		$this->set('title_layout', 'Widgets Manager');
		$this->Widget->recursive = 0;
		$this->set('widgets', $this->paginate());
	}
	public function admin_type(){
		$this->layout = 'clear';
		$mod_type = $this->Widget->Engadget->find('all', array(
						'conditions'=> array(
							'Engadget.type' => 'widget'
							)
						)
					);
		$this->set(compact('mod_type'));
	}
	public function admin_add($engadget_id = null){
		$this->set('location_site', 'widgets_Manager');	
		$this->set('title_layout', 'Add Widget');
		$data = $this->request->data('Params');
		if($this->request->is('post')) {
			if ($this->Widget->save($this->request->data)) {
				$this->Widget->saveField('params', json_encode($data));
				$this->Session->setFlash(__('El Widget ha sido guardado!'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Widget no se ha podido guardar, please intentelo nuevamente', true));
			}
		}
		$engadgets = $this->Widget->Engadget->find('first', array(
						'conditions' => array('Engadget.id' => $engadget_id)
						)						
					);		
		$this->set(compact('engadgets'));
		
	}
	public function admin_edit($Id = null){
		$this->set('location_site', 'widgets_Manager');
		$this->set('title_layout', 'Edit Widget');
		$this->Widget->id = $Id;
		$data = $this->request->data('Params');
		if(!$this->Widget->id && empty($this->request->data)) {
			$this->Session->setFlash(__('Widget invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->request->is('get')) {
			$this->request->data = $this->Widget->read();
		} else {
			if ($this->Widget->save($this->request->data)) {
				$this->Widget->saveField('params', json_encode($data));
				$this->Session->setFlash(__('El Widget ha sido modificado con exito!', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		$engadget_id = $this->request->data('Widget.engadget_id');
		$engadgets = $this->Widget->Engadget->find('first', array(
						'conditions' => array('Engadget.id' => $engadget_id)
						)						
					);		
		$this->set(compact('engadgets'));
	}
	public function admin_delete($Id = Null){
		$this->Widget->id = $Id;
		if (!$this->Widget->id) {
			$this->Session->setFlash(__('el Id es invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Widget->delete()) {
			$this->Session->setFlash(__('El Widget ha sido Eliminado', true));
			$this->redirect(array('action' => 'index'));
		}
	}
	
}
