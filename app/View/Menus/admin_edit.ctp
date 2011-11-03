<h2><?php echo $title_layout; ?></h2>

<div id="form" class="link">
    <?php echo $this->Form->create('Menu');?>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1"><?php echo __('Link', true);?></a></li>
		<li><a href="#tabs-2"><?php echo __('Access', true);?></a></li>
	
	</ul>
	<?php
	$options = array(1 => 'Link Root', 'Links' => $parentLinks);
	$attributes = array ('value' => $this->request->data('Menu.parent_id'), 'label' => 'Parent Link');	
	?>
	<div id="tabs-1">
		<fieldset class="details">
			<legend><?php echo __('Details', true);?></legend>
			  <?php echo $this->Form->input('title');?>
			  <?php echo $this->Form->input('alias');?>
			  <?php echo $this->Form->input('link');?>
			  <?php echo $this->Form->input('menutype_id', array('label' => 'Menu'));?>
			 
			  <?php echo $this->Form->input('parent_id', array('label' => 'Parent Link', 'options' => array (
			  				1 =>'Link Root', 'Links' => $parentLinks)));?>
			  <?php // echo $this->Form->select('parent_id', $options, $attributes);?>
			  <?php echo $this->Form->input('note', array('type' => 'textarea', 'rows' => '1', 'cols' => '20'));?>
			  <?php echo $this->Form->input('status', array('label' => 'Published'));?>
		</fieldset>
		<fieldset class="link_type">
			<legend><?php echo __('Link Type', true);?></legend>
			<ul class='link_type'>
				<li>Pages</li>
				<li>Articles</li>
				<li>Categories</li>
				<li>Blogs</li>
			</ul>
		</fieldset>
		<fieldset class="link_options">
			<legend><?php echo __('Link Options', true);?></legend>
			<?php echo $this->Form->input('target');?>
		    <?php echo $this->Form->input('rel');?>
		    <?php echo $this->Form->input('link_image');?>
		    <?php echo $this->Form->input('link_class');?>
		    <?php echo $this->Form->input('page_class');?>
		    <?php echo $this->Form->input('language');?>  		
		</fieldset>
      
	</div>
	<div id="tabs-2">
		 <?php echo $this->Form->input('role_id');?>
	</div>
<div class="clear"></div>
</div>
<?php echo $this->Form->input('id', array('type' => 'hidden'));?>  
    <?php
        echo $this->Form->end('Save');
        echo $this->Html->link(__('Cancel'), array(
            'action' => 'index', $menuTypeId
        
        ), array(
            'class' => 'cancel',
        ));
    ?>

</div>