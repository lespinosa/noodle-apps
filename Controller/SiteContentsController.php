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
App::uses('SiteAppController', 'Controller');
App::uses('Sanitize', 'Utility');
/**
 * Contents Controller
 * 
 * @property Content $Content
 */
class SiteContentsController extends SiteAppController
{
	public $name = 'Contents';
	public $uses = array('Content', 'Menu');
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
		//$this->Auth->allow(array('*', 'view'));
		$this->Auth->allow(array('index', 'view', 'article'));
		
	}
/**
 * view method
 * 
 * @param string $arg
 * @return void
 */
	public function view($arg){

		// verificamos si no param['type'] esta vacio
		if(!empty($this->request->params['type'])){
			$type = $this->request->params['type'];
		} else {
			$type = '';
		}
		
		//Swichamos el tipo de link
		switch ($type) {
		  case 'menu':
			$id = $this->Menu->findAlia($arg, 'link_type_id');
			break;
		  
		  default:
			$id = $this->Content->findAlia($arg, 'id');
			break;
		}
		
		//encaso de que el id no exista

		$this->Content->id = $id;
		/*if(!$this->Content->exists()){
			$this->redirect(array('controller' => 'errors', 'action' => 'no_fond'));
		}*/
		$contents = $this->Content->find('first', array(
				'conditions' => array(
					'Content.id' => $id,
					'Content.status' => 1
				)
			)
		);
		$this->set(compact('contents'));
	}
/**
 * index method
 *
 * @return void
 */
	public function index(){
		$this->noodleThemePath = 'Site';
		$this->theme = 'Blue';
		$this->set('title_layout', 'Articles Lists');
		$this->Content->recursive = 0;
		$contents = $this->Content->find('all');
		$this->set('contents', $contents);
	}
}