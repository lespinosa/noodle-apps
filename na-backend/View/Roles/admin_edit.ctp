<div id="form">
<?php echo $this->Form->create('Role');?>

	<?php echo $this->Form->input('name');?>
	<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
<?php echo $this->Form->end('Save');?>
<?php echo $this->Html->link(__('Cancel', true), array(
            'action' => 'index',
        ), array(
            'class' => 'cancel',
        ));?>
</div>

<div class="clear"></div>
