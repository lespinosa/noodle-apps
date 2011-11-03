<ul class="crumbs">
	<li><?php $this->Html->addCrumb('Dashboard', '/admin'); ?></li>
	<li><?php $this->Html->addCrumb('Menus', '/admin/menutypes'); ?></li>
	<li><?php $this->Html->addCrumb('Edit Menu', ''); ?></li>
</ul>
<h2><?php echo $title_layout; ?></h2>
<div id="form">
<?php echo $this->Form->create('Menutype');?>

	<?php
		$options = array(1 => 'Active', 2 => 'Blocked');
		$attributes = array('value' => $this->request->data('Menutype.status'));
		echo $this->Form->input('alias');
		echo $this->Form->input('title');?>
		<?php echo $this->Form->input('description');
		echo $this->Form->input('id', array('type' => 'hidden'));?>
<div class="status"><?php echo __('<label>Status</label>') .$this->Form->select('status', $options, $attributes, true);?></div>
<?php echo $this->Form->end('Save');?>
<?php echo $this->Html->link(__('Cancel', true), array(
            'action' => 'index',
        ), array(
            'class' => 'cancel',
        ));?>
</div>
<div class="clear"></div>