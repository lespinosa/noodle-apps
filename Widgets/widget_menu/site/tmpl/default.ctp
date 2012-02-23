<?php
App::import('Controller', 'Menus');
$this->App = new MenusController;
$links = $this->App->Menu->find('all', array(
				'conditions' => array(
					'Menu.status' => 1,
					'Menu.menutype_id' => $this->param->menutype_id					
				),
				'order' => array(
					'Menu.lft' => 'ASC'
				)
			)
		);
foreach ($links as $link):?>

<ul>
	<li><?php echo $this->Layout->nestedLinks($link);?></li>
</ul>
<?php endforeach;?>