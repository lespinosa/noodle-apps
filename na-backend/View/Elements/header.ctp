<div id="top-nav">
	 <div class="header-left">
        <div id="nav-container">        
                <?php echo $this->element("navigation"); ?>
        </div>
     </div>

        <div class="header-right">
        <?php
        	echo $this->Html->link('My Site', '/');
       	 	echo ' <span>|</span> ';
            echo sprintf(__("You are logged in as: ".$AuthUser, true));
            echo ' <span>|</span> ';
            echo $this->Html->link(__("Log out", true), array('plugin' => 0, 'controller' => 'users', 'action' => 'logout'));
        ?>
        </div>

        <div class="clear"></div>
</div>
<div id="header">
	<?php echo $this->Html->image('admin/logo.png', array('class'=>'logo', 'alt' => 'Noodle Apps for CakePHP Framework', 'url' => '#'));?>
	<h1>Administrator</h1>
</div>
<div id="item-nav">
	<ul>
	<?php echo $this->Layout->getSubnav($location_site);?>
	</ul>
</div>