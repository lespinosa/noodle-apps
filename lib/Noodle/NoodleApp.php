<?php
App::uses('App',  'Core/Lib');
class NoodleApp extends App {

/**
 * Append paths
 *
 * @constant APPEND
 */
	const APPEND = 'append';

/**
 * Prepend paths
 *
 * @constant PREPEND
 */
	const PREPEND = 'prepend';

/**
 * Reset paths instead of merging
 *
 * @constant RESET
 */
	const RESET = true;

/**
 * List of object types and their properties
 *
 * @var array
 */
	public static $types = array(
		'class' => array('extends' => null, 'core' => true),
		'file' => array('extends' => null, 'core' => true),
		'model' => array('extends' => 'AppModel', 'core' => false),
		'behavior' => array('suffix' => 'Behavior', 'extends' => 'Model/ModelBehavior', 'core' => true),
		'controller' => array('suffix' => 'Controller', 'extends' => 'AppController', 'core' => true),
		'component' => array('suffix' => 'Component', 'extends' => null, 'core' => true),
		'lib' => array('extends' => null, 'core' => true),
		'widgets' => array('extends' => null, 'core' => true),
		'view' => array('suffix' => 'View', 'extends' => null, 'core' => true),
		'helper' => array('suffix' => 'Helper', 'extends' => 'AppHelper', 'core' => true),
		'vendor' => array('extends' => null, 'core' => true),
		'shell' => array('suffix' => 'Shell', 'extends' => 'Shell', 'core' => true),
		'plugin' => array('extends' => null, 'core' => true)
	);

/**
 * Paths to search for files.
 *
 * @var array
 */
	public static $search = array();

/**
 * Whether or not to return the file that is loaded.
 *
 * @var boolean
 */
	public static $return = false;

/**
 * Holds key/value pairs of $type => file path.
 *
 * @var array
 */
	protected static $_map = array();

/**
 * Holds and key => value array of object types.
 *
 * @var array
 */
	protected static $_objects = array();

/**
 * Holds the location of each class
 *
 * @var array
 */
	protected static $_classMap = array();

/**
 * Holds the possible paths for each package name
 *
 * @var array
 */
	protected static $_packages = array();

/**
 * Holds the templates for each customizable package path in the application
 *
 * @var array
 */
	protected static $_packageFormat = array();

/**
 * Maps an old style CakePHP class type to the corresponding package
 *
 * @var array
 */
	public static $legacy = array(
		'models' => 'Model',
		'behaviors' => 'Model/Behavior',
		'datasources' => 'Model/Datasource',
		'controllers' => 'Controller',
		'components' => 'Controller/Component',
		'views' => 'View',
		'helpers' => 'View/Helper',
		'shells' => 'Console/Command',
		'libs' => 'Lib',
		'vendors' => 'Vendor',
		'widgets' => 'Widgets',
		'plugins' => 'Plugin',
	);

/**
 * Indicates whether the class cache should be stored again because of an addition to it
 *
 * @var boolean
 */
	protected static $_cacheChange = false;

/**
 * Indicates whether the object cache should be stored again because of an addition to it
 *
 * @var boolean
 */
	protected static $_objectCacheChange = false;

/**
 * Indicates the the Application is in the bootstrapping process. Used to better cache
 * loaded classes while the cache libraries have not been yet initialized
 *
 * @var boolean
 */
	public static $bootstrapping = false;

/**
 * Finds classes based on $name or specific file(s) to search.  Calling App::import() will
 * not construct any classes contained in the files. It will only find and require() the file.
 *
 * @link          http://book.cakephp.org/2.0/en/core-utility-libraries/app.html#including-files-with-app-import
 * @param mixed $type The type of Class if passed as a string, or all params can be passed as
 *                    an single array to $type,
 * @param string $name Name of the Class or a unique name for the file
 * @param mixed $parent boolean true if Class Parent should be searched, accepts key => value
 *              array('parent' => $parent ,'file' => $file, 'search' => $search, 'ext' => '$ext');
 *              $ext allows setting the extension of the file name
 *              based on Inflector::underscore($name) . ".$ext";
 * @param array $search paths to search for files, array('path 1', 'path 2', 'path 3');
 * @param string $file full name of the file to search for including extension
 * @param boolean $return, return the loaded file, the file must have a return
 *                         statement in it to work: return $variable;
 * @return boolean true if Class is already in memory or if file is found and loaded, false if not
 */
public static function import($type = null, $name = null, $parent = true, $search = array(), $file = null, $return = false) {
		$ext = null;

		if (is_array($type)) {
			extract($type, EXTR_OVERWRITE);
		}

		if (is_array($parent)) {
			extract($parent, EXTR_OVERWRITE);
		}

		if ($name == null && $file == null) {
			return false;
		}

		if (is_array($name)) {
			foreach ($name as $class) {
				if (!App::import(compact('type', 'parent', 'search', 'file', 'return') + array('name' => $class))) {
					return false;
				}
			}
			return true;
		}

		$originalType = strtolower($type);
		$specialPackage = in_array($originalType, array('file', 'vendor'));
		if (!$specialPackage && isset(self::$legacy[$originalType . 's'])) {
			$type = self::$legacy[$originalType . 's'];
		}
		list($plugin, $name) = pluginSplit($name);
		if (!empty($plugin)) {
			if (!CakePlugin::loaded($plugin)) {
				return false;
			}
		}

		if (!$specialPackage) {
			return self::_loadClass($name, $plugin, $type, $originalType, $parent);
		}

		if ($originalType == 'file' && !empty($file)) {
			return self::_loadFile($name, $plugin, $search, $file, $return);
		}
		if ($originalType == 'widgets') {
			return self::_loadWidgets($name, $plugin, $file, $ext);
		}
		

		if ($originalType == 'vendor') {
			return self::_loadVendor($name, $plugin, $file, $ext);
		}

		return false;
	}
	
	public static function importAdmin($type, $fileName){
		switch ($type) {
			case 'Helper':
				require_once ROOT_WIDGETS.$modName.DS.'helper'.DS.$fileName.'.php';
				break;
			case 'Controller':
				include ROOT . DS . 'na-backend' .DS.'Controller'.DS.$fileName.'Controller.php';
				break;
			default:
				
				break;
		}
	}
	protected static function _loadWidgets($name, $plugin, $file, $ext) {
		if ($mapped = self::_mapped($name, $plugin)) {
			return (bool) include_once($mapped);
		}
		$fileTries = array();
		$paths = ($plugin) ? App::path('widgets', $plugin) : App::path('widgets');
		if (empty($ext)) {
			$ext = 'php';
		}
		if (empty($file)) {
			$fileTries[] = $name . '.' . $ext;
			$fileTries[] = Inflector::underscore($name) . '.' . $ext;
		} else {
			$fileTries[] = $file;
		}

		foreach ($fileTries as $file) {
			foreach ($paths as $path) {
				if (file_exists($path . $file)) {
					self::_map($path . $file, $name, $plugin);
					return (bool) include($path . $file);
				}
			}
		}
		return false;
	}


	protected static function _packageFormat() {
		if (empty(self::$_packageFormat)) {
			self::$_packageFormat = array(
				'Model' => array(
					'%s' . 'Model' . DS,
					'%s' . 'models' . DS
				),
				'Model/Behavior' => array(
					'%s' . 'Model' . DS . 'Behavior' . DS,
					'%s' . 'models' . DS . 'behaviors' . DS
				),
				'Model/Datasource' => array(
					'%s' . 'Model' . DS . 'Datasource' . DS,
					'%s' . 'models' . DS . 'datasources' . DS
				),
				'Model/Datasource/Database' => array(
					'%s' . 'Model' . DS . 'Datasource' . DS . 'Database' . DS,
					'%s' . 'models' . DS . 'datasources' . DS . 'database' . DS
				),
				'Model/Datasource/Session' => array(
					'%s' . 'Model' . DS . 'Datasource' . DS . 'Session' . DS,
					'%s' . 'models' . DS . 'datasources' . DS . 'session' . DS
				),
				'Controller' => array(
					'%s' . 'Controller' . DS,
					'%s' . 'controllers' . DS,
					'%s' . 'na-backend' . DS . 'Controller' .DS
					
				),
				'AdminController' => array(
					'%s' . 'na-backend/Controller' . DS
				),
				'Controller/Component' => array(
					'%s' . 'Controller' . DS . 'Component' . DS,
					'%s' . 'controllers' . DS . 'components' . DS
				),
				'Controller/Component/Auth' => array(
					'%s' . 'Controller' . DS . 'Component' . DS . 'Auth' . DS,
					'%s' . 'controllers' . DS . 'components' . DS . 'auth' . DS
				),
				'View' => array(
					'%s' . 'View' . DS,
					'%s' . 'views' . DS
				),
				'View/Helper' => array(
					'%s' . 'View' . DS . 'Helper' . DS,
					'%s' . 'views' . DS . 'helpers' . DS
				),
				'Console' => array(
					'%s' . 'Console' . DS,
					'%s' . 'console' . DS
				),
				'Console/Command' => array(
					'%s' . 'Console' . DS . 'Command' . DS,
					'%s' . 'console' . DS . 'shells' . DS,
				),
				'Console/Command/Task' => array(
					'%s' . 'Console' . DS . 'Command' . DS . 'Task' . DS,
					'%s' . 'console' . DS . 'shells' . DS . 'tasks' . DS
				),
				'Lib' => array(
					'%s' . 'Lib' . DS,
					'%s' . 'libs' . DS
				),
				'locales' => array(
					'%s' . 'Locale' . DS,
					'%s' . 'locale' . DS
				),
				'Vendor' => array(
					'%s' . 'Vendor' . DS, VENDORS
				),
				'Widgets' => array(
					'%s' . 'Widgets' . DS, WIDGETS
				),
			
				'Plugin' => array(
					APP . 'Plugin' . DS,
					APP . 'plugins' . DS,
					dirname(dirname(CAKE)) . DS . 'plugins' . DS
				)
			);
		}

		return self::$_packageFormat;
	}
	protected static function _loadFile($name, $plugin, $search, $file, $return) {
		$mapped = self::_mapped($name, $plugin);
		if ($mapped) {
			$file = $mapped;
		} else if (!empty($search)) {
			foreach ($search as $path) {
				$found = false;
				if (file_exists($path . $file)) {
					$file = $path . $file;
					$found = true;
					break;
				}
				if (empty($found)) {
					$file = false;
				}
			}
		}
		if (!empty($file) && file_exists($file)) {
			self::_map($file, $name, $plugin);
			$returnValue = include ROOT . DS . 'na-backend' .DS.$file;
			if ($return) {
				return $returnValue;
			}
			return (bool) $returnValue;
		}
		return false;
	}
/**
 * Object destructor.
 *
 * Writes cache file if changes have been made to the $_map
 *
 * @return void
 */
	public static function shutdown() {
		if (self::$_cacheChange) {
			Cache::write('file_map', array_filter(self::$_map), '_cake_core_');
		}
		if (self::$_objectCacheChange) {
			Cache::write('object_map', self::$_objects, '_cake_core_');
		}
	}
}
