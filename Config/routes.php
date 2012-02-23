<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * import Class NoodleRouter
 */
	App::import('Lib/Noodle', 'NoodleRouter');

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();
	
	Router::parseExtensions('json', 'rss');
	
	NoodleRouter::localize();
/**
 * Router
 */
	// Installer
    if (!file_exists(APP . 'Config' . DS.'settings.yml')) {
       // NoodleRouter::connect('/', array('plugin' => 'install' ,'controller' => 'install'));
    }
	// Basic
	NoodleRouter::connect('/pages/:action', array('controller' => 'pages', 'action' => 'display', 'home'));
	NoodleRouter::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	

	NoodleRouter::connect(
		'/users/login',
		array('controller' => 'siteusers', 'action' => 'login')
	);
	NoodleRouter::connect(
		'/users/logout',
		array('controller' => 'siteusers', 'action' => 'logout')
	);
	
	NoodleRouter::connect(
		'/:slug',
		array('controller' => 'sitecontents', 'action' => 'view', 'type' => 'menu'),
		array(
			'pass' => array('slug')
		)
	);

	NoodleRouter::connect(
		'/:parent/:slug',
		array('controller' => 'sitecontents', 'action' => 'view'),
		array(
			'pass' => array('slug')
		)
	);
	NoodleRouter::connect(
		'/blog/category/:slug',
		array('controller' => 'sitecategories', 'action' => 'category'),
		array(
			'pass' => array('slug')
		)
	);

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';