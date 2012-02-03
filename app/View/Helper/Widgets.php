<?php
App::uses('View', 'View');

class WidgetsHelper extends View
{
	public function element($name, $dir, $data = array(), $options = array()) {
		$file = $plugin = $key = null;
		$callbacks = false;

		if (isset($options['plugin'])) {
			$plugin = Inflector::camelize($options['plugin']);
		}
		if (isset($this->plugin) && !$plugin) {
			$plugin = $this->plugin;
		}
		if (isset($options['callbacks'])) {
			$callbacks = $options['callbacks'];
		}

		if (isset($options['cache'])) {
			$underscored = null;
			if ($plugin) {
				$underscored = Inflector::underscore($plugin);
			}
			$keys = array_merge(array($underscored, $name), array_keys($options), array_keys($data));
			$caching = array(
				'config' => $this->elementCache,
				'key' => implode('_', $keys)
			);
			if (is_array($options['cache'])) {
				$defaults = array(
					'config' => $this->elementCache,
					'key' => $caching['key']
				);
				$caching = array_merge($defaults, $options['cache']);
			}
			$key = 'element_' . $caching['key'];
			$contents = Cache::read($key, $caching['config']);
			if ($contents !== false) {
				return $contents;
			}
		}

		$file = $this->_getElementFilename($name, $dir, $plugin);

		if ($file) {
			if (!$this->_helpersLoaded) {
				$this->loadHelpers();
			}
			if ($callbacks) {
				$this->Helpers->trigger('beforeRender', array($file));
			}
			$element = $this->_render($file, array_merge($this->viewVars, $data));
			if ($callbacks) {
				$this->Helpers->trigger('afterRender', array($file, $element));
			}
			if (isset($options['cache'])) {
				Cache::write($key, $element, $caching['config']);
			}
			return $element;
		}
		$file = APP.'Widgets' .DS . $dir . DS. $name . $this->ext;

		if (Configure::read('debug') > 0) {
			return "Element Not Found: " . $file;
		}
	}
	protected function _getElementFileName($name, $dir, $plugin = null) {
		$paths = $this->_paths($plugin);
		$exts = $this->_getExtensions();
		foreach ($exts as $ext) {
			foreach ($paths as $path) {
				if (file_exists( APP.'Widgets' .DS . $dir . DS. $name . $ext)) {
					return  APP.'Widgets' .DS . $dir . DS. $name . $ext;
				}
			}
		}
		return false;
	}
}
