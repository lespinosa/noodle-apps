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
App::uses('AppController', 'Controller');
class WidgetsController extends AppController
{
	public $name = "Widgets";
	public $paginate = array(
			'limit' => 25,
			'order'=> array(
				'Widget.lft' => 'asc'
			)
	);
/**
 * beforeFilter method
 * 
 * @return void
 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->set('location_site', 'widgets');
		//$this->Auth->allow(array('*', 'view'));
		
	}
/**
 * admin index method
 * 
 * @return void
 */
	public function admin_index(){
		$this->set('location_site', 'widgets_Manager');	
		$this->set('title_layout', 'Widgets Manager');
		$this->Widget->recursive = 0;
		$this->set('widgets', $this->paginate());
	}
/**
 * admin type method
 * 
 * @return void
 */
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
/**
 * admin_add method
 * 
 * @param string $engadget_id
 * @return void
 */
	public function admin_add($engadget_id = null){
		$this->set('location_site', 'widgets_Manager');	
		$this->set('title_layout', 'Add Widget');
		//GET all params
		$params = $this->request->data('Params');
		$assignment = $this->request->data('Assignment');
		//SAVE DATA
		if ($this->request->is('post')) {
			$this->Widget->create();
			if ($this->Widget->save($this->request->data)) {
				//SAVE all params
				$this->Widget->saveField('params', json_encode($params));
				$this->Widget->saveField('assignment', json_encode($assignment));
			  	$this->Session->setFlash(__('El Widget ha sido guardado!'));
				$this->redirect(array('action' => 'index'));
			} else {
			  	$this->Session->setFlash(__('The Widget could not saved. Please try again'), 'defaul', array('class' => 'error'));
			}			
		}
		//GET all Engadget
		$engadgets = $this->Widget->Engadget->find('first', array(
						'conditions' => array('Engadget.id' => $engadget_id)
						)						
					);
		//SET @var engadgets	
		$this->set(compact('engadgets'));		
	}
/**
 * admin_edit method
 * 
 * @param string $Id
 * @return void
 */
	public function admin_edit($Id = null){
		$this->set('location_site', 'widgets_Manager');
		$this->set('title_layout', 'Edit Widget');
		$this->Widget->id = $Id;
		//GET all Params
		$params = $this->request->data('Params');
		$assignment = $this->request->data('Assignment');
		if (!$this->Widget->exists()) {
		  	$this->Session->setFlash(__('Invalid Widget'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		  	if ($this->Widget->save($this->request->data)) {
		  		//SAVE all params
		  		$this->Widget->saveField('params', json_encode($params));
				$this->Widget->saveField('assignment', json_encode($assignment));
				$this->Session->setFlash(__('The Widget has been update.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The widget could not update. Please try again.'), 'default', array('class' => 'error'));
				$this->redirect(array('action' => 'index'));
			}			  
		} else {
			$this->request->data = $this->Widget->read(null, $Id);
		}		
		//GET engadget_id
		$engadget_id = $this->request->data('Widget.engadget_id');
		//GET engadget
		$engadgets = $this->Widget->Engadget->find('first', array(
						'conditions' => array('Engadget.id' => $engadget_id)
						)						
					);
		//SET @var engadgets		
		$this->set(compact('engadgets'));
	}
/**
 * admin_delete method
 * 
 * @param string $Id
 * @return void
 */
	public function admin_delete($Id = Null){
		$this->Widget->id = $Id;
		if (!$this->Widget->exists()) {
			$this->Session->setFlash(__('Invalid Widget'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Widget->delete()) {
		  	$this->Session->setFlash(__('The Widget has been Delete', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The widget was not deleted'), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * admin movedown method
 * 
 * @param string $title
 * @return void
 */
	public function admin_movedown($title = null, $step = 1){
		$wid = $this->Widget->findByTitle($title);
		if(empty($wid)){
			$this->Session->setFlash(__('No hay un enlace con el titulo' . $wid, true));
			$this->redirect(array('acion' => 'index'), null, true);
		}
		$this->Widget->id = $wid['Widget']['id'];
		if ($step > 0){
			$this->Widget->moveDown($this->Widget->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia abajo.', true));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}
/**
 * admin moveup method
 * 
 * @param string $title
 * @return void
 */
	public function admin_moveup($title = null, $step = 1){
		$wid = $this->Widget->findByTitle($title);
		if(empty($wid)){
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
			$this->redirect(array('acion' => 'index'), null, true);
		}
		$this->Widget->id = $wid['Widget']['id'];
		if($step > 0){
			$this->Widget->moveUp($this->Widget->id, abs($step));
		} else {
			$this->Session->setFlash(__('Por favor indique el numero de posiciones que el nodo debe ser movido hacia arriba.', true));
		}
		$this->redirect(array('action' => 'index'), null, true);
	}	
}