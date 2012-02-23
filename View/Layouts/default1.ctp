<!DOCTYPE html>
<head lang="en">
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
					'reset',
					'960_12_col',
					'site/layout'
				));

		echo $scripts_for_layout;
	?>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>
<body>
<div class="container_12">
	<!--Header -->
	<header class="grid_12 alpha">
		<div class="logo"><?php echo $this->Html->image('site/logo.png');?></div>
		<nav><ul class="menu">
		<li class="active"><a href="http://localhost:90/cnexus2/">home</a></li>
		<li><a href="#">portfolio</a></li>

		<li><a href="#">blog</a></li>
		<li><a href="#">contact</a></li>
	</ul></nav>
	</header>
	<div class="clear"></div>
	<section class="container">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

	</section>
	<aside></aside>
	<footer></footer>
</div>
</body>
</html>