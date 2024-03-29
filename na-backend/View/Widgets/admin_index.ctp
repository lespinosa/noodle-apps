<div class="widgets index">
	<ul class="add_icon">
		<li><?php echo $this->Html->image('admin/icons/add_icon.png', array('alt' => 'add', 'url' => 'add/'));?>
		</li>
		<li>
			<?php echo $this->Html->link(__('New Widget', true), array('action'=> 'type'), array('rel' => 'colorbox', 'title' => 'Select a Module Type', 'class' => 'colorbox')); ?>
		</li>
	</ul>

<div class="clear"></div>


<div id="table-content">

<table  cellpadding="0" cellspacing="0">
	<tr>
		<th>
			<input type="checkbox" id="paradigm_all">
		</th>
		<th><h3><?php echo $this->Paginator->sort(__('id'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('title'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('status'));?></h3></th>
		<th><h3><?php echo $this->Html->link('ordering', array('sort' => 'lft')) ?><?php echo $this->Html->image('admin/icons/save_icon.png', array('alt' => 'Save order', 'class' => 'save-order'));?></h3> </th>
		<th><h3><?php echo $this->Paginator->sort(__('widget'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('access'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('language'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('Actions'));?></h3></th>
		

	</tr>
<?php 
	$i = 0;
	foreach ($widgets as $widget):
		$class = null;
		if ($i++ % 2 == 1) {
			$class = ' class="altrow"';
		}
?>
	<tr <?php echo $class;?>>
		<td class="select-all"><?php echo $this->Form->checkbox('id', array('name'=> 'id', 'value' => $widget['Widget']['id']));?></td>
		<td class="id"><?php echo $widget['Widget']['id'];?></td>
		<td class="name"><?php echo $this->Html->link($widget['Widget']['title'], array('action' => 'edit', $widget['Widget']['id']));?></td>
		<td class="status"><?php echo $this->Layout->getStatus(null, null, $widget['Widget']['id'], 'img')?></td>
		<td class="ordering"><?php echo $this->Layout->getOrdering('Widget',$widget['Widget']['id'], null, 'img', $widget['Widget']['lft']);?></td>
		<td><?php echo $widget['Widget']['widget'];?></td>
		<td class="access"><?php echo $this->Layout->getAccess($widget['Widget']['role_id'], null);?></td></td>
		<td><?php echo $widget['Widget']['language'];?></td>
		<td class="action"><?php echo $this->Html->link(
						$this->Html->image('admin/icons/edit_icon.png', array('alt' => 'Editar')),
						array('action' => 'edit', $widget['Widget']['id']), array('escape' => false));?>
			
			<?php echo $this->Html->link(
							$this->Html->image('admin/icons/canc_icon.png', array('alt' => 'Eliminar')), 
							array('action' => 'delete', $widget['Widget']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete Link '.$widget['Widget']['title'], true), 'class' => ''));?></td>
		
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
	<li class="vu"><?php echo __('Ver Article', true);?></li>
	<li class="eu"><?php echo __('Editar Article', true);?></li>
	<li class="del"><?php echo __('Eliminar Article', true);?></li>
</ul>
<div class="clear"></div>