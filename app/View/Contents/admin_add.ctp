<h2><?php echo $title_layout; ?></h2>
<div id="form" class="contents">
<div class="vertical-tabs">
	
<?php echo $this->Form->create('Content');?>

	<ul class="vertical-tabs-list">
		<li class="vertical-tab-button first">
			<a href="#tabs-1"><strong><?php echo __('Details', true);?></strong><span class="summary"><?php echo __('Title, Body', true);?></span></a>
		</li>
		<li class="vertical-tab-button">
					<a href="#tabs-2"><strong><?php echo __('Categories', true);?></strong><span class="summary"><?php echo __('Multi-Select Category and Tags', true);?></span></a>
		</li>	
		<li class="vertical-tab-button">
			<a href="#tabs-3"><strong><?php echo __('Article options', true);?></strong><span class="summary"><?php echo __('Show Options, Language');?></span></a>
		</li>		
		<li class="vertical-tab-button">
			<a href="#tabs-4"><strong><?php echo __('Access', true);?></strong><span class="summary"><?php echo __('Access, Permissions', true);?></span></a>
		</li>
		<li class="vertical-tab-button">
			<a href="#tabs-5"><strong><?php echo __('Publishing options', true);?></strong><span class="summary"><?php echo __('Created, Modified, Publishing', true);?></span></a>
		</li>
		<li class="vertical-tab-button last">
			<a href="#tabs-6"><strong><?php echo __('Revision information', true);?></strong><span class="summary"><?php echo __('No revision', true);?></span></a></li>
	</ul>


<div class="vertical-tabs-panes"> 
	<div id="tabs-1">
		<fieldset class="details">
			<legend><?php echo __('Details', true);?></legend>
			<?php echo $this->Form->input('title');?>
			<?php
			$aliasContent = $this->request->data('Content.alias');
			 if(empty($aliasContent)):?>
				<?php echo $this->Form->input('alias', array('class' => 'slug'));?>
			<?php else :?>
				<?php echo $this->Form->input('alias');?>
			<?php endif;?>
			<?php echo $this->Form->input('status', array('options' => array(
					0 => 'Select Status', 1 => 'Published', 2 => 'Unpublished')));?>
			<?php echo $this->Form->input('body', array('label' => 'Article Text', 'cols' => 60));?>
			
		</fieldset>
	</div>
	<div id="tabs-2">
			<?php echo $this->Form->input('category_id', array('options' => array(
				'0' => 'Select a Category', 'My Categories' => $categories)));?>
	</div>
	<div id="tabs-3">
		<fieldset>
			<legend><?php echo __('Article Options', true);?></legend>
			
			<?php echo $this->Form->input('language_id');?>
			<?php echo $this->Form->input('featured', array('type' => 'checkbox', 'label' => 'Featured', 'class' => 'checkbox'));?>
			<?php echo $this->Form->input('ordering');?>
		</fieldset>
	</div>
	
	<div id="tabs-4">
		<fieldset class="">
			<legend><?php echo __('Access', true);?></legend>
			<?php echo $this->Form->input('access', array('type' => 'hidden'));?>
			<?php echo $this->Form->input('role_id', array('label' => 'Access', 'options' => array(
					'0' => 'For all users', 'Roles' => $roles)));?>
		</fieldset>
	</div>
	<div id="tabs-5">
		<fieldset class="">
			<legend><?php echo __('Publishing Options', true);?></legend>
				<?php echo $this->Form->input('user_id', array('label' => 'Users Lists', 'options' => array(
					$AuthId => $AuthUser, 'Users List' => $users)));?>
			<?php echo $this->Form->input('created_by', array('label' => 'Created by'));?>
			<?php echo $this->Form->input('publish_up', array('type' => 'text', 'class' => 'datepicker'));?>
			<?php echo $this->Form->input('publish_down', array('type' => 'text', 'class' => 'datepicker'));?>
		</fieldset>
	</div>
	<div id="tabs-6">
	</div>
</div>

<div class="clear"></div>

	
  <?php
        echo $this->Form->end('Save');
        echo $this->Html->link(__('Cancel'), array(
            'action' => 'index'
        
        ), array(
            'class' => 'cancel',
        ));
    ?>

</div>

</div>

<script type="text/javascript">
	CKEDITOR.replace( 'ContentBody',
    {
       // toolbar : 'Basic',
       
    });
	
</script>

