<?php
class MenusHelper extends AppHelper {
	var $helpers = array('Html', 'Session', 'Form', 'Menus', 'Noodle');

	public function getTabLink(){
		$output = "<li class='vertical-tab-button'>";
		$output .= '<a href="#tabs-2"><strong>'.__('Basic options', true).'</strong><span class="summary">'. __('Basic options').'</span></a>';
		$output .= "</li>";
		
		$output .= '<li class="vertical-tab-button">';
		$output .= '<a href="#tabs-3"><strong>'.__('Advanced Options', true).'</strong><span class="summary">'.__('Module Class Suffix, Alternative Layout, Cache', true).'</span></a>';
		$output .= '</li>';
		
		$output .= '<li class="vertical-tab-button">';
		$output .= '<a href="#tabs-4"><strong>'.__('Publishing options', true).'</strong><span class="summary">'.__('Created, Modified, Publishing', true).'</span></a>';
		$output .= '</li>';	

		$output .='<li class="vertical-tab-button last">';
		$output .= '<a href="#tabs-5"><strong>'.__('Metadata Options', true).'</strong><span class="summary">'.__('Meta Description, Meta Keywords', true).'</span></a>';
		$output .= '</li>';
		
		return $output;
	}
	
	public function getTabContents(){
		App::import('Controller', 'Menutypes');
		$menuLists = new MenutypesController;
		
		$list = $menuLists->Menutype->find('list', array(
				'conditions' => array('Menutype.status' => 1)
			)
		);
		// intanciamso la clase stdClass()
		$options = new stdClass();
		
		$datajSon = $this->request->data('Widget.params');
		$params = json_decode($datajSon);
		//Pasamos las variables a la clase stdClass();
		

		
		$options->select_menu = $this->Noodle->params('menutype_id', array('label' => 'Select Menu','options' => array(0 => 'Select Menu', 'Menu List' => $list)));
		
		$options->start_level = $this->Noodle->params('startlevel', array('label' => 'Start Level','options' => array(1,2,3,4,5,6,7,8,9,10)));
		$options->end_level = $this->Noodle->params('endlevel', array('label' => 'End Level','options' => array(0 => 'All',1,2,3,4,5,6,7,8,9,10)));
		$options->show_submenu_items = $this->Noodle->params('show_submenu_items', array('label' => 'Show Sub-menu Items','options' => array(0 => 'No',1 => 'Yes')));
		
		//pasamos todas las variables a $output var
		$output = '<div id="tabs-2">';
		$output .= $options->select_menu;
		$output .= $options->start_level . $options->end_level .$options->show_submenu_items;
		$output .= '</div>';
		
		return $output;
	}
}
