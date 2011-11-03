<ul class="crumbs">
	<li><?php $this->Html->addCrumb('Dashboard', '/admin'); ?></li>
	<li><?php $this->Html->addCrumb('Roles', '/admin/roles'); ?></li>
	<li><?php $this->Html->addCrumb('Roles Lists', ''); ?></li>
</ul>

<div class="roles index">
<h2 class="roles-icon"><?php echo $title_layout; ?></h2>
<ul class="add_icon">
	<li><?php echo $this->Html->image('admin/icons/add_icon.png', array('alt' => 'Ver Perfil', 'url' => 'add/'));?></li>
	<li class="add-u"><?php echo $this->Html->link(__('Crear un Rol', true), array('action'=>'add')); ?></li>

</ul>
<div class="clear"></div>
<p>
	
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<div class="clear"></div>
<div id="table-content">
<table cellpadding="0" cellspacing="0">
<tr>
	<th><h3><?php echo $this->Paginator->sort(__('id'));?></h3></th>
	<th><h3><?php echo $this->Paginator->sort(__('name'));?></h3></th>
	<th><h3><?php __('Actions');?></h3></th>

<?php
$i = 0;
foreach ($roles as $role):
	$class = null;
	$status = null;
	if ($i++ % 2 == 1) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $role['Role']['id']; ?>
		</td>
		<td>
			<?php echo $role['Role']['name']; ?>
		</td>
		<td class="actions">
			<?php // echo $this->Html->link(
				//		$this->Html->image('admin/icon/info_icon.png', array('alt' => 'Ver Info')),
				//		array('action' => 'view', $role['Role']['id']), array('escape' => false));?>
			<?php echo $this->Html->link(
						$this->Html->image('admin/icons/edit_icon.png', array('alt' => 'Edit Rol')),
						array('action' => 'edit', $role['Role']['id']), array('escape' => false));?>
			<?php echo $this->Html->link(
							$this->Html->image('admin/icons/canc_icon.png', array('alt' => 'Eliminar Rol')), 
							array('action' => 'delete', $role['Role']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete role ' . $role['Role']['name'])));?>

		
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>
<div class="clear"></div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="clear"></div>

<ul class="nota">
	<li class="vu"><?php echo __('Ver Rol');?></li>
	<li class="eu"><?php echo __('Editar Rol');?></li>
	<li class="del"><?php echo __('Eliminar Rol');?></li>

</ul>
<div class="clear"></div>
