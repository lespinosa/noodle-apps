<?php print_r($options)?>

<?php
App::import('Controller', 'Menus');

$this->App = new MenusController;
$links = $this->App->Menu->find('list', array(
				'conditions' => array(
					'Menu.status' => 1,
					//'Menutype.id' => 7,
					
					),
				
			)
		);
foreach ($links as $linkID => $link):;
?>
<ul>
	<li><?php echo $link;?></li>
</ul>
<?php endforeach;?>