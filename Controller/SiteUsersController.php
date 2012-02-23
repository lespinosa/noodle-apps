<?php
/**
 * UsersController.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
App::uses('SiteAppController', 'Controller');
// Importamos la clase Sanitize
App::uses('Sanitize', 'Utility');
/**
 * Users Controller
 * 
 * @property User $User
 */
class SiteUsersController extends SiteAppController{
/**
 * beforeFilter method
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('location_site', 'users');
		$this->Auth->allow(array('logout', 'login'));
	   
	}

/**
 * login method
 * 
 * @return void
 */
	public function login() {
		$this->theme = 'default';
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash('Your username or password was incorrect.');
	        }
	    }
		if ($this->Session->read('Auth.User')) {
	        $this->Session->setFlash('You are logged in!');
	        $this->redirect('/', null, false);
	    }
	}
/**
 * logout method
 * 
 * @return void
 */
	public function logout() {
		$this->theme = 'default';
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());
	}
}