<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JApplicationHelper::getPath('front_html') );
jimport('joomla.application.component.controller');
jimport('joomla.application.component.helper');

$document = JFactory::getDocument();
$document->setTitle("com_cake: Ultimate Joomla Component");
$joomla_path = dirname(dirname(dirname(__FILE__)));

// As this component (cakephp) will need database access, lets include Joomla's config file
require_once($joomla_path.'/configuration.php');

// Constants to be used later in com_cake
$config = new JConfig();

define(JOOMLA_PATH,JURI::base());
define(DB_SERVER,$config->host);
define(DB_USER,$config->user);
define(DB_PASSWORD,$config->password);
define(DB_NAME,$config->db);

$controller = JArrayHelper::getValue($_REQUEST ,'module'); //option passed is treated as a controller in cake
$action = JArrayHelper::getValue($_REQUEST ,'task'); //task passed is treated as a controller in cake
$param = JArrayHelper::getValue($_REQUEST ,'id');
HTML_cake::requestCakePHP('/'.$controller.'/'.$action.'/'.$param);