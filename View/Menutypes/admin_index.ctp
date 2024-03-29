<div class="menus index">
<ul class="add_icon">
	<li><?php echo $this->Html->image('admin/icons/add_icon.png', array('alt' => 'Add', 'url' => 'add/'));?></li>
	<li class="add-u"><?php echo $this->Html->link(__('Agregar Menu', true), array('action'=>'add')); ?></li>

</ul>
<div class="clear"></div>

<?php /*
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));*/
?>
<div id="table-content">
<table  cellpadding="0" cellspacing="0">
<tr>
	<th><h3><?php echo $this->Paginator->sort(__('id'));?></h3></th>
	<th><h3><?php echo $this->Paginator->sort(__('title'));?></h3></th>
	<th><h3><?php echo $this->Paginator->sort(__('status'));?></h3></th>
	<th><h3><?php echo $this->Paginator->sort(__('description'));?></h3></th>
	<th class="actions"><h3><?php __('Actions');?></h3></th>
</tr>
<?php
$i = 0;
foreach ($menus as $menu):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="altrow"';
	}
	
?>

	<tr<?php echo $class;?>>
		<td class="id">
			<?php echo $menu['Menutype']['id']; ?>
		</td>
		<td>
			<?php echo $menu['Menutype']['title']; ?>
		</td>
		<td>
			<?php echo $this->Layout->getStatus(null, null, $menu['Menutype']['status'], 'img'); ?>
		</td>
		<td>
			<?php echo $menu['Menutype']['description']; ?>
		</td>
		
		<td class="actions">
			
			<?php echo $this->Html->link(
						$this->Html->image('admin/icons/info_icon.png', array('alt' => 'Ver Menu')),
						array('controller' => 'menus', 'action' => 'index', $menu['Menutype']['id']), array('escape' => false));?>
			<?php echo $this->Html->link(
						$this->Html->image('admin/icons/edit_icon.png', array('alt' => 'Editar Perfil')),
						array('action' => 'edit', $menu['Menutype']['id']), array('escape' => false));?>
			
			<?php echo $this->Html->link(
							$this->Html->image('admin/icons/canc_icon.png', array('alt' => 'Eliminar Usuario')), 
							array('action' => 'delete', $menu['Menutype']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete '.$menu['Menutype']['title'], true)));?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="clear"></div>
<ul class="nota">
	<li class="vu"><?php echo __('Ver Menu');?></li>
	<li class="eu"><?php echo __('Editar Menu');?></li>
	<li class="del"><?php echo __('Eliminar Menu');?></li>
</ul>
<div class="clear"></div>