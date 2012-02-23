<?php
/*
 * Luis Manuel
 * cpanels_controller.php 
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 * @year 2011
 */
App::uses('SiteAppController', 'Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 */
class SiteDashboardController extends SiteAppController
{
	public $name = 'Dashboard';
	
	function beforeFilter() {
	    parent::beforeFilter(); 	 	
		$this->set('location_site', 'admin');	   
	}
/**
 * index method
 * 
 * @return void
 */	
	public function index(){
		//importamos RolesController
		App::import('Controller', 'Roles');
		//Intanciamos la Clase RolesController 
		$data = new RolesController;
		//GET User role_id
		$roleID = $this->Auth->user('role_id');
		//Find Role name
		$rolTitle = $data->Role->find('first', array(
				'conditions' => array('Role.id' => $roleID)
			)
		);
		// Si el Usuario Auth es diferente a Registered los redirigimos al admin
		if($rolTitle['Role']['name'] != 'Registered'){
			$this->redirect(array('controller' => 'dashboard', 'action' => 'index', 'admin' => true));
		}
		$this->set('title_layout', 'Dashboard');		
	}
}