<?php
/**
 * 
 * AppController.php
 * Luis Manuel
 * @package  cNexus
 * @version  1.0
 * @author  Luis Manuel Espinosa <luismaster809@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright     Copyright 2011, iWebdevelope.com (http://iwebdevelope.com)
 * @link     http://www.cnexuscms.com
 */
class AppController extends Controller
{
	public $components = array('Acl', 'Auth', 'Session');
    public $helpers = array('Html', 'Form', 'Session', 'Paginator', 'Layout', 'Js' => 'Jquery', 'Noodle');
	
    function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'add');
		$this->Auth->allow('display');
		$AuthUser = $this->Auth->user('name');
		$AuthId = $this->Auth->user('id');
		$UserId = $AuthId;
		$this->set(compact('AuthUser', 'AuthId', 'UserId'));
    }
}