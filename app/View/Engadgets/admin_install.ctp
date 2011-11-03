<div class="engadgats index">
	<h2><?php echo $title_layout;?></h2>
</div>
<?php echo $this->Form->create('Engadgets', array('action' => 'install', 'enctype'=> 'multipart/form-data'));?>
 <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="123" />
<?php echo $this->Form->file('Engadget.file');?>
<?php echo $this->Form->end('Install');?>

