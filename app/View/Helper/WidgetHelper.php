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
					'Widget.status' => 1,
				),
				'fields' => array(
					'Widget.id', 'Widget.title', 'Widget.widget', 'Widget.assignment' ,'Widget.note', 'Widget.content', 'Widget.ordering', 'Widget.position', 'Widget.status', 'Widget.showtitle',
					'Widget.params', 'Widget.language','Widget.lft', 'Widget.role_id','Widget.user_id'
				),
				'order' => array (
					'Widget.lft' => 'DESC'
				)
			)
		);
		$total = count($widget);
		for ($i=0; $i < $total; $i++) { 
		$assign = $widget[$i]['Widget']['assignment'];
		$params = $widget[$i]['Widget']['params'];
		
		if ($this->widgetAssignment($assign) == TRUE) {
		  return $this->_View->element($widget[$i]['Widget']['widget'].'/'.$widget[$i]['Widget']['widget'], array('params' => $params));
		}
		//return $this->_View->element($widget[$i]['Widget']['widget'].'/'.$widget[$i]['Widget']['widget']);
		}
	
		//return NoodleView::element($name, $data = array(), $options = array());
	}
	public function widgetAssignment($assign = array()){
		//importamos el controllador Menu y la intanciamos
		App::import('Controller', 'Menus');
		$data = new MenusController;
		$data->Menu->recursive = 0;
		
		// decodificamos $assing y lo pasamos a un array
		$arr = (array)json_decode($assign);
		// Extraemos los valores del array
		$assignW = array_values($arr);

		for ($i=0; $i < count($assignW); $i++) { 
		
			$result = $data->Menu->find('first', array(
					'conditions' => array (
						'Menu.status' => 1,
						'Menu.id' => $assignW[$i]
					),
					'fields' => array(
						'Menu.id', 'Menu.status', 'Menu.alias', 'Menu.link'
					)
				)
			);
			$linkAsisign = json_decode($result['Menu']['link'], true);
			$alias = $result['Menu']['alias'];
			if($this->request->controller == $linkAsisign['controller'] && $this->request->action == $linkAsisign['action'] && in_array($alias, $this->request->pass)) {
				$assignment = TRUE;
				return $assignment;
			//print_r($this->request->params['pass']);
			}
			if($this->request->controller == $linkAsisign['controller'] && $this->request->action == $linkAsisign['action']){
				$assignment = TRUE;
				return $assignment;
			}
			
		}
		
	}
	
}
