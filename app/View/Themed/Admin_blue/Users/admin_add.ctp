<div id="form">
<?php echo $this->Form->create('User');?>

	<?php
		$options = array(3 => 'Status', 1 => 'Active', 0 => 'Blocked');
		echo $this->Form->input('name');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('role_id');
	?>
	<div class="status"><?php echo __('<label>Status</label>', true) .$this->Form->checkbox('status');?></div>

<?php echo $this->Form->end('Save');?>
<?php echo $this->Html->link(__('Cancel', true), array(
            'action' => 'index',
        ), array(
            'class' => 'cancel',
        ));?>
</div>

<div class="clear"></div>