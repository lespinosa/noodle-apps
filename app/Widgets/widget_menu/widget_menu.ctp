<?php

$param = $options['params']['params'];

$pp = json_decode($param);
echo $pp->menutype_id;
require 'tmpl/default.ctp';
