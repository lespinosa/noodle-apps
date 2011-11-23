<div class="categories index">
<ul class="add_icon">
	<li><?php echo $this->Html->image('admin/icons/add_icon.png', array('alt' => 'Ver Perfil', 'url' => 'add/'));?></li>
	<li class="add-u"><?php echo $this->Html->link(__('Agregar Category', true), array('action'=>'add')); ?></li>

</ul>
<div class="clear"></div>
<div id="filtle">
	<div class="clear"></div>
	<?php echo $this->Form->create('Category', array('action'=>'index')); ?>
		<fieldset class="filtle-title">
		<?php echo $this->Form->input('filter_search', array('label' => 'Filter:'));?>
		<?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'button'));?>
		<?php echo $this->Html->link(__('Reset', true), array('action' => 'index'), array('class' => 'button'));?>
	</fieldset>
	<?php $opt = array('type' => 'hidden'); echo $this->Form->end($opt);?>
	<?php echo $this->Form->create('Category', array('action'=>'index')); ?>
		<fieldset class="select_option">
			<?php echo $this->Form->input('filter_status', array('label' => false, 'onchange' => 'this.form.submit()', 'options'=> array(
					0 => 'Select Status', 1 => 'Published', 2 => 'Unpublished')));?>

			<?php echo $this->Form->input('filter_role', array('label' => false, 'onchange' => 'this.form.submit()', 'options' => array(
				0 => 'Select Access', 'Access' => $roles)));?>
			<?php echo $this->Form->input('filter_language', array('label' => false, 'onchange' => 'this.form.submit()', 'options' => array(
					0 => 'Select Language')));?>
	</fieldset>		

	<?php $opt = array('type' => 'hidden'); echo $this->Form->end($opt);?>
		
</div>

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
		<th><h3><?php echo $this->Paginator->sort(__('language_id'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('Actions'));?></h3></th>
		

	</tr>
<?php 
	$i = 0;
	foreach ($categoryTree as $categoryId => $categoryTitle):
		$class = null;
		if ($i++ % 2 == 1) {
			$class = ' class="altrow"';
		}
?>
	<tr <?php echo $class;?>>
		<td class="select-all"><?php echo $this->Form->checkbox('id', array('name'=> 'id', 'value' => $categoryId));?></td>
		<td class="id"><?php echo $categoryId;?></td>
		<td class="name"><?php echo $this->Html->link($categoryTitle, array('action' => 'edit', $categoryId));?></td>
		<td class="status"><?php echo $this->Layout->getStatus('Categories', 'Category', $categoryId, 'img')?></td>
		<td class="ordering">
			<?php echo $this->Layout->getOrdering('Category', $categoryId, null, 'img', $categoryLeft[$categoryId]);?></td>		
		<td class="access"><?php echo $this->Layout->getAccess($categoryId, 'text');?></td>
		<td><?php echo "lenguage"?></td>
		<td class="action"><?php echo $this->Html->link(
						$this->Html->image('admin/icons/edit_icon.png', array('alt' => 'Editar')),
						array('action' => 'edit', $categoryId), array('escape' => false));?>
			
			<?php echo $this->Html->link(
							$this->Html->image('admin/icons/canc_icon.png', array('alt' => 'Eliminar')), 
							array('action' => 'delete', $categoryId), array('escape' => false, 'confirm' => __('Are you sure you want to delete Link '.$categoryTitle, true), 'class' => ''));?></td>
		
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
	<li class="vu"><?php echo __('Ver Category', true);?></li>
	<li class="eu"><?php echo __('Editar Category', true);?></li>
	<li class="del"><?php echo __('Eliminar Category', true);?></li>
</ul>
<div class="clear"></div>