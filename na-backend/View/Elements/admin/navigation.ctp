<ul id="nav">
 <li><?php echo $this->Html->link('Dashboard', '/admin/dashboard/');?></li>
 <li><?php echo $this->Html->link('Menu', array('controller' => 'menutypes', 'action' => 'index'));?>
 	<ul>
 		<li class="menu-list">
 			<?php echo $this->Html->link('Menu Manager', '/admin/menutypes');?>
 			<span>
				<?php echo $this->Html->link('List | Add | Delete', array('controller' => 'menutypes', 'action' => 'index'));?>
 			</span>
 		</li>
 		<?php echo $this->Layout->getMenu();?>
 	</ul>
 </li>
 <li><?php echo $this->Html->link('Contenido', '/admin/contents');?></li>
 <li><?php echo $this->Html->link('Usuarios', '/admin/users');?></li>
 <li><?php echo $this->Html->link('Apariencias', '/admin/apariencias');?></li>
 <li><?php echo $this->Html->link('Engadgets', '/admin/engadgets');?>
 	
 	<ul>
 		 <li><?php echo $this->Html->link('Engadgets Manager', array('controller' => 'engadgets', 'action' => 'index'));?>

 		 </li>
 		<li><?php echo $this->Html->link('Widget Manager', array('controller' => 'widgets', 'action' => 'index'));?></li>
 		<li><?php echo $this->Html->link('Plugins Manager', array('controller' => 'plugins', 'action' => 'index'));?></li>
 		<li><?php echo $this->Html->link('Themes Manager', array('controller' => 'themes', 'action' => 'index'));?></li>
 		<li><?php echo $this->Html->link('Language Manager', array('controller' => 'languages', 'action' => 'index'));?></li>
 	</ul>
 </li>
 <li><?php echo $this->Html->link('Configuracion', '/admin/settings');?></li>
 <li><?php echo $this->Html->link('Ayuda', '/admin/helps');?></li>
</ul>
