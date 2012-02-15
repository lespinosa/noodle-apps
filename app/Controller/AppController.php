<?php
App::uses('Controller', 'Controller');

/**
* Application Controller
*
* Add your application-wide methods in the class below, your controllers
* will inherit them.
*
* @package app.Controller
* @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
*/

class AppController extends Controller {
public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session',
        'RequestHandler'
    );
    public $helpers = array('Html', 'Form', 'Session', 'Paginator', 'Widget', 'Layout', 'Js' => 'Jquery', 'Noodle');
	public $noodleThemePath = 'Admin';
	public $theme = 'Blue';

    function beforeFilter() {
	
        //Configure AuthComponent
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'display');
		$this->Auth->allow('display');
		$AuthUser = $this->Auth->user('name');
		$AuthId = $this->Auth->user('id');
		$UserId = $AuthId;
		$this->set(compact('AuthUser', 'AuthId', 'UserId'));
    }
}