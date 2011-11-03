<ul class="grid_16 crumbs">
	<li><?php $this->Html->addCrumb('Dashboard', '/admin'); ?></li>
	<li><?php $this->Html->addCrumb('Roles', '/admin/roles'); ?></li>
	<li><?php $this->Html->addCrumb('Add New Role', ''); ?></li>
</ul>
<h2><?php echo $title_layout; ?></h2>
<div id="form">
<?php echo $this->Form->create('Role');?>

	<?php
		echo $this->Form->input('name');
	?>
	
<?php echo $this->Form->end('Save');?>
<?php echo $this->Html->link(__('Cancel', true), array(
            'action' => 'index',
        ), array(
            'class' => 'cancel',
        ));?>
</div>
<div class="clear"></div>
