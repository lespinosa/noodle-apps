<ul class="crumbs">
	<li><?php $this->Html->addCrumb('Dashboard', '/admin'); ?></li>
	<li><?php $this->Html->addCrumb('Users', ''); ?></li>
</ul>
<div class="users index">
<h2 class="users-icon"><?php echo $title_layout; ?></h2>
<ul class="add_icon">
	<li><?php echo $this->Html->image('admin/icons/add_icon.png', array('alt' => 'Ver Perfil', 'url' => 'add/'));?></li>
	<li class="add-u"><?php echo $this->Html->link(__('Agregar Usuarios', true), array('action'=>'add')); ?></li>

</ul>
<div class="clear"></div>
<div id="form">
	<h3><?php echo __('Filtral por:');?></h3>
	<div class="clear"></div>
	<?php echo $this->Form->create('User', array('action'=>'index')); ?>
	<?php
		$options = array(1 => 'Active', 2 => 'Blocked', 0 => 'Cualquiera');
		$attributes = array('value' => 0);
		$optionsRol = array(0 => 'Cualquiera', 'Roles' => $roles);
		?>
	
	<?php echo $this->Form->input('name');?>
	<div class="role_id"><?php echo __('<label>Roles</label>', true) . $this->Form->select('role_id', $optionsRol, $attributes);?></div>
	<div class="status"><?php echo __('<label>Status</label>', true) . $this->Form->select('status', $options, $attributes);?></div>
	<?php echo $this->Html->link(__('Reset', true), array('action' => 'index'), array('class' => 'cancel'));?>
	<?php echo $this->Form->end('Filter');?>
		
</div>
<?php /*
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));*/
?>
<div id="table-content">
<table  cellpadding="0" cellspacing="0">
<tr>
	<th class="name"><h3><?php echo $this->Paginator->sort(__('name'));?></h3></th>
	<th><h3><?php echo $this->Paginator->sort(__('username'));?></h3></th>
	<th><h3><?php echo $this->Paginator->sort(__('status'));?></h3></th>
	<th><h3><?php echo $this->Paginator->sort(__('role_id'));?></h3></th>
	<th class="actions"><h3><?php __('Actions');?></h3></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="altrow"';
	}
?>

	<tr<?php echo $class;?>>
		<td class="name">
			<?php echo $user['User']['name']; ?>
		</td>
		<td class="username">
			<?php echo $user['User']['username']; ?>
		</td>
		<td class="status">
			<?php echo $this->Layout->getStatus($user['User']['status'], 'img'); ?>
		</td>
		<td class="role">
			<?php echo $this->Html->link($user['Role']['name'], array('controller'=> 'roles', 'action'=>'view', $user['Role']['id'])); ?>
		</td>
		<td class="actions">
			
			<?php echo $this->Html->link(
						$this->Html->image('admin/icons/info_icon.png', array('alt' => 'Ver Perfil')),
						array('action' => 'view', $user['User']['id']), array('escape' => false));?>
			<?php echo $this->Html->link(
						$this->Html->image('admin/icons/edit_icon.png', array('alt' => 'Editar Perfil')),
						array('action' => 'edit', $user['User']['id']), array('escape' => false));?>
			<?php echo $this->Html->image('admin/icons/unlock_icon.png', array('alt' => 'Ver / Editar y Agregar Permisos', 'url' => '/admin/acl/aros/user_permissions/'.$user['User']['id'].'/ajax:true'));?>
			<?php echo $this->Html->link(
							$this->Html->image('admin/icons/canc_icon.png', array('alt' => 'Eliminar Usuario')), 
							array('action' => 'delete', $user['User']['id']), array('escape' => false, 'confirm' => 'Are you sure you want to delete: '.$user['User']['name']));?>
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
	<li class="vu"><?php echo __('Ver Usuario', true);?></li>
	<li class="eu"><?php echo __('Editar Usuario', true);?></li>
	<li class="del"><?php echo __('Eliminar Usuario', true);?></li>
	<li class="vp"><?php echo __('Ver / Edit / Add Permisos del Usuario', true);?></li>
</ul>
<div class="clear"></div>