<ul class="crumbs">
	<li><?php $this->Html->addCrumb('Dashboard', '/admin'); ?></li>
	<li><?php $this->Html->addCrumb('Menus', ''); ?></li>
</ul>
<div class="menus index">
<h2 class="menus-icon"><?php echo $title_layout; ?></h2>
<ul class="add_icon">
	<li><?php echo $this->Html->image('admin/icons/add_icon.png', array('alt' => 'Ver Perfil', 'url' => 'add/'));?></li>
	<li class="add-u"><?php echo $this->Html->link(__('Agregar Link', true), array('action'=>'add', $menuType)); ?></li>

</ul>
<div class="clear"></div>
<div id="form">
	<h3><?php echo __('Filtral por:', true);?></h3>
	<div class="clear"></div>
	<?php echo $this->Form->create('Menus', array('action'=>'index')); ?>
	<?php
		$options = array(1 => 'Active', 2 => 'Blocked', 0 => 'Cualquiera');
		$attributes = array('value' => 0);
		$optionsRol = array(0 => 'Cualquiera', 'Roles' => $roles);
		?>
	<?php echo $this->Form->input('title');?>	
	<div class="role_id"><?php echo __('<label>Roles</label>', true) . $this->Form->select('role_id', $optionsRol, $attributes);?></div>
	<div class="status"><?php echo __('<label>Status</label>', true) . $this->Form->select('status', $options, $attributes);?></div>
	<?php echo $this->Html->link('Reset', array('action' => 'index'), array('class' => 'cancel'));?>
	<?php echo $this->Form->end('Filter');?>
		
</div>

<?php 
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?>
<div id="table-content">

<table  cellpadding="0" cellspacing="0">
	<tr>
		<th>
			<input type="checkbox" id="paradigm_all">
		</th>
		<th><h3><?php echo $this->Paginator->sort(__('id'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('title'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('status'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('ordering'));?><?php echo $this->Html->image('admin/icons/save_icon.png', array('alt' => 'Save order', 'class' => 'save-order'));?></h3> </th>
		<th><h3><?php echo $this->Paginator->sort(__('access'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('Actions'));?></h3></th>
		

	</tr>
<?php 
	$i = 0;
	foreach ($linksTree as $linkId => $linksTitle):
		$class = null;
		if ($i++ % 2 == 1) {
			$class = ' class="altrow"';
		}
?>
	<tr <?php echo $class;?>>
		<td class="select-all"><?php echo $this->Form->checkbox('id', array('name'=> 'id', 'value' => $linkId));?></td>
		<td class="id"><?php echo $linkId;?></td>
		<td class="name"><?php echo $this->Html->link($linksTitle, array('action' => 'edit', $linkId, $menuType));?></td>
		<td class="status"><?php echo $this->Layout->getStatus($linksStatus[$linkId], 'img')?></td>
		<td class="ordering"><?php echo $this->Layout->getOrdering('Menu', $linkId, $linksMenuType[$linkId], 'img');?></td>
		<td></td>
		<td class="action"><?php echo $this->Html->link(
						$this->Html->image('admin/icons/edit_icon.png', array('alt' => 'Editar')),
						array('action' => 'edit', $linkId, $menuType), array('escape' => false));?>
			
			<?php echo $this->Html->link(
							$this->Html->image('admin/icons/canc_icon.png', array('alt' => 'Eliminar')), 
							array('action' => 'delete', $linkId, $menuType), array('escape' => false, 'confirm' => __('Are you sure you want to delete Link '.$linksTitle, true), 'class' => ''));?></td>
		
	</tr>
<?php endforeach;?>


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
	<li class="vu"><?php echo __('Ver Menu', true);?></li>
	<li class="eu"><?php echo __('Editar Menu', true);?></li>
	<li class="del"><?php echo __('Eliminar Menu', true);?></li>
</ul>
<div class="clear"></div>