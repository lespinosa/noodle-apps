<ul class="crumbs">
	<li><?php $this->Html->addCrumb('Dashboard', '/admin'); ?></li>
	<li><?php $this->Html->addCrumb('Users', '/admin/users'); ?></li>
	<li><?php $this->Html->addCrumb('View User', ''); ?></li>
</ul>
<h2><?php echo $title_layout; ?>: <?php echo $user['User']['username']?></h2>
<?php
$userName				= $user['User']['username'];
$userEmail				= $user['User']['email'];
$userRole				= $user['Role']['name'];
$userCreated			= $user['User']['created'];
$userModified			= $user['User']['modified'];
?>
<div class="admin_view">

<p><?php if(!empty($userEmail)){ echo __('<div class="label">Email: </div><b>', true).$userEmail.'</b>';}?></p>
	<p><?php if(!empty($userEmail)){ echo __('<div class="label">Role: </div><b>'.$userRole.'</b>', true);}?></p>

<p><?php if(!empty($userCreated)){ echo __('<div class="label">Created: </div><b>'.$userCreated.'</b>', true);}?></p>
<p><?php if(!empty($userModified)){ echo __('<div class="label">Modified: </div><b>'.$userModified.'</b>', true);}?></p>
</div>
<div class="clear"></div>
<div class="actions">
			<?php echo $this->Html->link(
									$this->Html->image('admin/icon/edit_icon.png', array('alt' => 'Editar Perfil')),
									array('action' => 'edit', $user['User']['id']), array('escape' => false));?>
			<?php echo $this->Html->image('admin/icon/unlock_icon.png', array('alt' => 'Ver / Editar y Agregar Permisos', 'url' => '/admin/acl/aros/user_permissions/'.$user['User']['id'].'/ajax:true'));?>
			<?php echo $this->Html->link(
							$this->Html->image('admin/icon/canc_icon.png', array('alt' => 'Eliminar Usuario')), 
							array('action' => 'delete', $user['User']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete User' .$user['User']['name'], true)));?>					
</div>

<div class="clear"></div>
<ul class="nota">
	<li class="eu"><?php echo __('Editar Usuario');?></li>
	<li class="del"><?php echo __('Eliminar Usuario');?></li>
	<li class="vp"><?php echo __('Ver / Edit / Add Permisos del Usuario');?></li>
</ul>
<div class="clear"></div>