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
 <li><?php echo $this->Html->link('Engadgets', '/admin/engadgets');?></li>
 <li><?php echo $this->Html->link('Configuracion', '/admin/settings');?></li>
 <li><?php echo $this->Html->link('Ayuda', '/admin/helps');?></li>
</ul>
