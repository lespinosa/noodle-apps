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
App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 */
class DashboardController extends AppController
{
	public $name = 'Dashboard';
	
	function beforeFilter() {
	    parent::beforeFilter(); 	 	
		$this->set('location_site', 'admin');	   
	}

/**
 * admin index method
 * 
 * @return void
 */	
	public function admin_index(){
		$this->set('title_layout', 'Dashboard');
	}
}