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
class DashboardController extends AppController
{
	var $name = 'Dashboard';
	var $components = array('Session', 'Auth');
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	  	$this->Auth->allowedActions = array('*');
	 	
		$this->set('location_site', 'admin');
	 	//$this->Auth->allow(array('*', 'logout', 'login'));
	   
	}
	function admin_index(){
		$this->set('title_layout', 'Dashboard');
		
	}
}