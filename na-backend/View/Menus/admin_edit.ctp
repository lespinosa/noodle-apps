<div id="form" class="link">
<div class="vertical-tabs">
	
<?php echo $this->Form->create('Menu');?>

	<ul class="vertical-tabs-list">
		<li class="vertical-tab-button first">
			<a href="#tabs-1"><strong><?php echo __('Details', true);?></strong><span class="summary"><?php echo __('Menu Item Type, Title, Url', true);?></span></a>
		</li>		
		
		<li class="vertical-tab-button">
			<a href="#tabs-2"><strong><?php echo __('Link Options', true);?></strong><span class="summary"><?php echo __('Link Title Attribute, Link CSS Style, Link Image');?></span></a>
		</li>		
		<li class="vertical-tab-button">
			<a href="#tabs-3"><strong><?php echo __('Access Options', true);?></strong><span class="summary"><?php echo __('Roles Access', true);?></span></a>
		</li>
		<li class="vertical-tab-button">
			<a href="#tabs-4"><strong><?php echo __('Publishing options', true);?></strong><span class="summary"><?php echo __('Created, Modified, Publishing', true);?></span></a>
		</li>
		<li class="vertical-tab-button last">
			<a href="#tabs-5"><strong><?php echo __('Metadata Options', true);?></strong><span class="summary"><?php echo __('Meta Description, Meta Keywords', true);?></span></a></li>
	</ul>

<div class="vertical-tabs-panes"> 
	<div id="tabs-1">
		<fieldset class="details">
			<legend><?php echo __('Details', true);?></legend>
			<?php if(!empty($link_type)): ?>
			<?php echo $this->Form->input('link_type', array('value'=> $link_type, 'label' => 'Menu Item Type', 'div' => false));?>
			<?php else:?>
			<?php echo $this->Form->input('link_type', array('disabled' => 'disabled', 'label' => 'Menu Item Type', 'div' => false));?>
			<?php endif;?>
			<?php echo $this->Html->link('Select', array('action' => 'edittype',$itemId, $menuTypeId), array('class' =>'list-type button', 'title' => 'Menu Item Type'));?>
			<?php if(!empty($link_type)): ?>
				<?php echo $this->Form->input('title');?>
			<?php else:?>
				<?php echo $this->Form->input('title', array('disabled' => 'disabled'));?>
			<?php endif;?>
			<?php
			$aliasLink = $this->request->data('Menu.alias');
			 if(empty($aliasLink)):?>
				<?php echo $this->Form->input('alias', array('class' => 'slug'));?>
			<?php else :?>
				<?php echo $this->Form->input('alias');?>
			<?php endif;?>
			<?php if(!empty($link_type)):?>
				<?php echo $this->Noodle->getLink($link_type);?>
			<?php else :?>
			<?php echo $this->Form->input('link');?>
			<?php endif;?>
			 <?php echo $this->Form->input('menutype_id', array('label' => 'Menu'));?>
			 <?php echo $this->Form->input('parent_id', array('label' => 'Parent Link', 'options' => array (0 =>'Link Root', 'Links' => $parentLinks)));?>
			 <?php echo $this->Form->input('status', array('options' => array(
					0 => 'Select Status', 1 => 'Published', 2 => 'Unpublished')));?>
			<?php echo $this->Form->input('id');?>
			  
		</fieldset>
		<fieldset class="link_option">
			<legend><?php echo __('Required Settings', true);?></legend>
			<?php echo $this->Noodle->getLinkSettings($link_type, $itemId);?>
		</fieldset>
	</div>
	<div id="tabs-2">
		<fieldset>
			<legend><?php echo __('Link Options', true);?></legend>
			<?php echo $this->Form->input('target');?>
		    <?php echo $this->Form->input('rel');?>
		    <?php echo $this->Form->input('link_image');?>
		    <?php echo $this->Form->input('link_class');?>
		    <?php echo $this->Form->input('page_class');?>
		    <?php echo $this->Form->input('language');?>
		    <?php
		    	$datajSon = $this->request->data('Menu.params');
				$params = json_decode($datajSon);	
				echo $this->Form->input('param1', array('value' => $params->param1));
				echo $this->Form->input('param2', array('value' => $params->param2));		
				
		    ?>
		 
		
		</fieldset>
	</div>
	<div id="tabs-3">
		<fieldset>
			<legend><?php echo __('Access', true);?></legend>
			<?php echo $this->Form->input('access', array('type' => 'hidden'));?>
			<?php echo $this->Form->input('role_id', array('label' => 'Access', 'options' => array(
					'0' => 'For all users', 'Roles' => $roles)));?>
		</fieldset>
	</div>
	
	<div id="tabs-4">
		<fieldset>
			<legend><?php echo __('Publishing Options', true);?></legend>
			<label><?php echo __('Created');?></label>
			
		
			<label><?php echo __('Created By');?></label>
			<div><?php echo $this->Layout->getAuthor('Menu');?></div>
			<label><?php echo __('Modified');?></label>
			<div><?php echo $this->request->data('Menu.modified');?></div>
			<label><?php echo __('Modified By');?></label>
			<div>
				<?php
					$uid = $this->request->data('Menu.modified_by'); 
					echo $this->Layout->getAuthor('Menu', $uid, 'modified');?>
				<?php echo $this->Form->input('modified_by', array('type' => 'hidden', 'value' => $UserId));?>
			</div>
	
			<?php echo $this->Form->input('publish_up', array('type' => 'text', 'class' => 'datepicker'));?>
			<?php echo $this->Form->input('publish_down', array('type' => 'text', 'class' => 'datepicker'));?>
		</fieldset>
	</div>
	<div id="tabs-5">
		
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

