<div id="form" class="content">
	<?php echo $this->Form->create('Widget');?>
<div class="vertical-tabs">
	
	<ul class="vertical-tabs-list">
		<li class="vertical-tab-button first">
			<a href="#tabs-1"><strong><?php echo __('Details', true);?></strong><span class="summary"><?php echo __('Title, etc', true);?></span></a>
		</li>		
		<?php echo $this->Noodle->modOptions('tab-links', $engadgets['Engadget']['name']);?>
	</ul>
<div class="vertical-tabs-panes"> 
	<div id="tabs-1">
		<fieldset class="details">
			
<?php echo $this->Form->input('title');?>
<?php
	echo $this->Form->input('showtitle', array(
	'type' => 'select',
	'label' => 'Show Title',
	'options' => array('1' => 'Show', '0' => 'Hide')));
?>
<?php echo $this->Form->input('position');?>
 <?php echo $this->Form->input('status', array('options' => array(
					0 => 'Select Status', 1 => 'Published', 2 => 'Unpublished')));?>
<?php echo $this->Form->input('role_id');?>
<?php echo $this->Form->input('ordering');?>
<?php echo $this->Form->input('publish_up', array('type' => 'text','class' => 'datetimepicker', 'div' => 'datetime'));?>
<?php echo $this->Form->input('publish_down', array('type' => 'text','class' => 'datetimepicker', 'div' => 'datetime'));?>
<?php echo $this->Form->input('language_id');?>
<?php echo $this->Form->input('note');?>
<?php echo $this->Form->input('widget', array('type' => 'hidden'));?>
<div class="desc">
<label><?php echo __('Module Description', true);?></label>
<span><?php echo $engadgets['Engadget']['description'];?></span>
</div>
<?php echo $this->Form->input('engadget_id', array('type' => 'hidden'));?>
		</fieldset>
	</div>
<?php echo $this->Noodle->modOptions('tab-contents');?>
</div>



</div>
<?php echo $this->Form->end('save');?>
</div>