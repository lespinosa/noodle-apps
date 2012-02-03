<div id="form" class="contents">
<div class="vertical-tabs">
<?php echo $this->Form->create('Category');?>
	<ul class="vertical-tabs-list">
		<li class="vertical-tab-button first">
			<a href="#tabs-1"><strong><?php echo __('Details', true);?></strong><span class="summary"><?php echo __('Title, Body', true);?></span></a>
		</li>		
		<li class="vertical-tab-button">
			<a href="#tabs-2"><strong><?php echo __('Category options', true);?></strong><span class="summary"><?php echo __('Show Options, Language');?></span></a>
		</li>		
		<li class="vertical-tab-button">
			<a href="#tabs-3"><strong><?php echo __('Access', true);?></strong><span class="summary"><?php echo __('Access, Permissions', true);?></span></a>
		</li>
		<li class="vertical-tab-button">
			<a href="#tabs-4"><strong><?php echo __('Publishing options', true);?></strong><span class="summary"><?php echo __('Created, Modified, Publishing', true);?></span></a>
		</li>
	</ul>
<div class="vertical-tabs-panes">
	<div id="tabs-1">
		<fieldset class="details">
			<legend><?php echo __('Details', true);?></legend>
			<?php echo $this->Form->input('title');?>
			<?php
			$aliasCat = $this->request->data('Category.alias');
			 if(empty($aliasCat)):?>
				<?php echo $this->Form->input('alias', array('class' => 'slug'));?>
			<?php else :?>
				<?php echo $this->Form->input('alias');?>
			<?php endif;?>
			<?php echo $this->Form->input('parent_id', array('label' => 'Parent Category', 'options' => array (
			  				0 =>'Category Root', 'Categories' => $parents)));?>
			<?php echo $this->Form->input('status', array('options' => array(
					0 => 'Select Status', 1 => 'Published', 2 => 'Unpublished')));?>
			<?php echo $this->Form->input('description', array('label' => 'Description', 'cols' => 60));?>
		</fieldset>
	</div>
	<div id="tabs-2">
		<?php echo $this->Form->input('note');?>
		
		<?php echo $this->Form->input('ordering');?>
		<?php echo $this->Form->input('languague');?>
	</div>
	<div id="tabs-3">
		<?php echo $this->Form->input('access');?>
		<?php echo $this->Form->input('role_id');?>
	</div>
	<div id="tabs-4">
		<?php echo $this->Form->input('user_id');?>
		<?php echo $this->Form->input('created');?>
		<?php echo $this->Form->input('modified_user_id');?>
		<?php echo $this->Form->input('modified');?>
	</div>
</div>
 
</div>
  <?php
        echo $this->Form->end('Save');
        echo $this->Html->link(__('Cancel'), array(
            'action' => 'index'
        
        ), array(
            'class' => 'cancel',
        ));
    ?>
</div>
<script type="text/javascript">
	CKEDITOR.replace( 'CategoryDescription',
    {
       // toolbar : 'Basic',
       
    });
	
</script>
