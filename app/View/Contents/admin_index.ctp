<div class="contents index">
<h2 class="contents-icon"><?php echo $title_layout; ?></h2>
<ul class="add_icon">
	<li><?php echo $this->Html->image('admin/icons/add_icon.png', array('alt' => 'Add', 'url' => 'add/'));?></li>
	<li class="add-u"><?php echo $this->Html->link(__('Agregar Article', true), array('action'=>'add')); ?></li>

</ul>
<div class="clear"></div>
<div id="filtle">
	<div class="clear"></div>
	<?php echo $this->Form->create('Content', array('action'=>'index')); ?>
		<fieldset class="filtle-title">
		<?php echo $this->Form->input('filter_search', array('label' => 'Filter:'));?>
		<?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'button'));?>
		<?php echo $this->Html->link(__('Reset', true), array('action' => 'index'), array('class' => 'button'));?>
	</fieldset>
	<?php $opt = array('type' => 'hidden'); echo $this->Form->end($opt);?>
	<?php echo $this->Form->create('Content', array('action'=>'index')); ?>
		<fieldset class="select_option">
			<?php echo $this->Form->input('filter_status', array('label' => false, 'onchange' => 'this.form.submit()', 'options'=> array(
					0 => 'Select Status', 1 => 'Published', 2 => 'Unpublished')));?>
					
			<?php echo $this->Form->input('filter_category', array('label' => false, 'onchange' => 'this.form.submit()', 'options' => array(
					0 => 'Select Category', 'My Categories' => $categories)));?>
					
			<?php echo $this->Form->input('filter_role', array('label' => false, 'onchange' => 'this.form.submit()', 'options' => array(
				0 => 'Select Access', 'Access' => $roles)));?>
				
				<?php echo $this->Form->input('filter_author', array('label' => false, 'onchange' => 'this.form.submit()', 'options' => array(
				0 => 'Select Author', 'Author List' => $author)));?>
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
		<th><h3><?php echo $this->Paginator->sort(__('featured'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('category_id'));?></h3></th>
		<th><h3><?php echo $this->Html->link('ordering', array('sort' => 'lft')) ?><?php echo $this->Html->image('admin/icons/save_icon.png', array('alt' => 'Save order', 'class' => 'save-order'));?></h3> </th>
		<th><h3><?php echo $this->Paginator->sort(__('access'));?></h3></th>
		<th><h3><?php echo $this->Paginator->sort(__('Actions'));?></h3></th>
		

	</tr>
<?php 
	$i = 0;
	foreach ($contents as $content):
		$class = null;
		if ($i++ % 2 == 1) {
			$class = ' class="altrow"';
		}
?>
	<tr <?php echo $class;?>>
		<td class="select-all"><?php echo $this->Form->checkbox('id', array('name'=> 'id', 'value' => $content['Content']['id']));?></td>
		<td class="id"><?php echo $content['Content']['id'];?></td>
		<td class="name"><?php echo $this->Html->link($content['Content']['title'], array('action' => 'edit', $content['Content']['id']));?></td>
		<td class="status"><?php echo $this->Layout->getStatus($content['Content']['status'], 'img')?></td>
		<td class="featured"><?php echo $this->Layout->getFeatured($content['Content']['featured'], 'img')?></td>
		<td class="cat"><?php echo $this->Layout->getCategory($content['Content']['category_id'])?></td>
		<td class="ordering"><?php echo $this->Layout->getOrdering('Content',$content['Content']['id'], null, 'img', $content['Content']['lft']);?></td>
		<td class="access">
			<?php echo $this->Layout->getAccess($content['Content']['role_id'], null);?></td>
		<td class="action"><?php echo $this->Html->link(
						$this->Html->image('admin/icons/edit_icon.png', array('alt' => 'Editar')),
						array('action' => 'edit', $content['Content']['id']), array('escape' => false));?>
			
			<?php echo $this->Html->link(
							$this->Html->image('admin/icons/canc_icon.png', array('alt' => 'Eliminar')), 
							array('action' => 'delete', $content['Content']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete Link '.$content['Content']['title'], true), 'class' => ''));?></td>
		
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