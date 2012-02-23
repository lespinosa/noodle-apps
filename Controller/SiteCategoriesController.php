<?php
/**
 * CategoriesController.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('SiteAppController', 'Controller');
/**
 * Categories Controller
 * 
 * @property Category $Category
 */
class SiteCategoriesController extends SiteAppController
{
	public $uses = array('Category', 'Menu');
/**
 * beforeFilter Method
 * 
 * @return void
 */	
	public function beforeFilter() {
		
		parent::beforeFilter();
		$this->Auth->allow(array('category', 'listAllCategories'));
		$this->set('location_site', 'categories');
	}
/**
 * List All Category Method
 * 
 * @return void
 */
	public function listAllCategories(){
		$allCategories = $this->Category->find('threaded', array(
				'conditions' => array (
					'Category.status' => 1
					
				)
			)
		);
		
		
		$this->set(compact('allCategories'));
	}
/**
 * Category blog Method
 * 
 * @param $arg
 * @return void
 */
	public function category($arg){
		$id = $this->Menu->findAlia($arg, 'link_type_id');
		$this->Category->recursive = 1;
		$category = $this->Category->find('first', array(
				'conditions' => array(
					'Category.id' => $id
				)
			)
		);
		$this->set(compact('category'));
	}
}