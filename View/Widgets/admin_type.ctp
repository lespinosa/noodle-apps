<div id="clear-theme">
<ul>
<?php foreach ($mod_type as $modList):?>
	<li><?php echo $this->Html->link($modList['Engadget']['title'], array('controller' => 'widgets', 'action' => 'add', $modList['Engadget']['id']), array('target' => '_top'))?>
		<span class="desc"><?php echo $modList['Engadget']['description'];?></span>
	</li>
<?php endforeach;?>
</ul>
</div>