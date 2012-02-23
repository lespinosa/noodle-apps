<?php

	

?>
<section>
	<aside>
		<header>
			<h1 class="title"><?php echo $category['Category']['title'];?></h1>			
		</header>
		<article>
			<?php echo $category['Category']['description'];?>
		</article>
	</aside>
	<aside>
		<?php //echo $category['Content'][0]['title'];?>
	<?php foreach ($category['Content'] as $content):?>
		<header>
			<h3>
				<?php echo $this->Html->link($content['title'], array(
						'controller' => 'sitecontents',
						'action' => 'view',					
						'parent' => $category['Category']['title'],
						'slug' => $content['alias'],
						'ext' => 'html'
					)
				);
				?>
			</h3></header>
		<article><?php echo $content['body'];?></article>		
	<?php endforeach;?>

	</aside>
</section>