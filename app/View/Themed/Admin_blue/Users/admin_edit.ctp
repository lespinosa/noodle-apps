<div id="form">
	
<?php echo $this->Form->create('User');?>


	<?php
		$options = array(1 => 'Active', 0 => 'Blocked');
		$attributes = array('value' => $this->request->data('User.status'));
		echo $this->Form->input('name');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('role_id');
	?>
	<div class="status"><?php echo __('<label>Status</label>', true) .$this->Form->select('status', $options, $attributes, false);?></div>

<?php echo $this->Form->end('Save');?>
<?php echo $this->Html->link(__('Cancel', true), array(
            'action' => 'index',
        ), array(
            'class' => 'cancel',
        ));?>
</div>

<div class="clear"></div>