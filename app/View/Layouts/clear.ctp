<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			'reset',
            'admin/layout',
            'forms',
        
        ));
		echo $this->Html->script(array(
				'jquery-1.6.4.min',
		));
		echo $scripts_for_layout;
	?>
</head>

<body>

	 <?php echo $content_for_layout; ?>
</body>
</html>