<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Login');
?>
<div class="clear"></div>