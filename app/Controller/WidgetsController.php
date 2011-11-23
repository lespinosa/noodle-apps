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
		//$this->Auth->allow(array('*', 'view'));
		
	}	
	public function admin_index(){
		$this->layout = 'admin';
		$this->set('location_site', 'widgets_Manager');	
		$this->set('title_layout', 'Widgets Manager');
		$this->Widget->recursive = 0;
		$this->set('widgets', $this->paginate());
	}
}
