<?php
App::uses('NoodleView', 'Lib/Noodle');
App::uses('AppHelper', 'Helper');
class WidgetHelper extends AppHelper
{
	public $App;
	
	public function getWidget($position, $style = '', $options = array()){
		App::import('Controller', 'Widgets');
		$this->App = new WidgetsController;
		$this->App->Widget->recursive = 0;
		$widget = $this->App->Widget->find('all', array(
				'conditions' => array (
					'Widget.position' => $position,
					'Widget.status' => '1',
				),
				'fields' => array(
					'Widget.id', 'Widget.title','Widget.note', 'Widget.content', 'Widget.ordering', 'Widget.position', 'Widget.status', 'Widget.showtitle',
					'Widget.params', 'Widget.language','Widget.lft', 'Widget.role_id','Widget.user_id'
				),
				'order' => array (
					'Widget.lft' => 'DESC'
				)
			)
		);
		$total = count($widget);
		for ($i=0; $i < $total; $i++) { 
		  $result = $widget[$i]['Widget']['title'];
			
		}
		
		var_dump($widget);
		
		//return NoodleView::element($name, $data = array(), $options = array());
	}
	
}
