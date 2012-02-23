<header>
	<h2 class="contents-icon"><?php echo $title_layout; ?></h2>
</header>
<section>
	<?php foreach($contents as $content):?>
		<article class="hentry">
			<header>
			<h2 class="entry-title"><?php echo $content['Content']['title'];?></h2>
			</header>
			<div class="entry-content"><?php echo $content['Content']['body'];?></div>
		</article>
	<?php endforeach;?>
</section>