<div class="engadgats index">
	<h2><?php echo $title_layout;?></h2>
</div>
<?php echo $this->Form->create('Engadgets', array('action' => 'install', 'enctype'=> 'multipart/form-data'));?>

<?php echo $this->Form->file('Engadget.file');?>
<?php echo $this->Form->end('Install');?>

