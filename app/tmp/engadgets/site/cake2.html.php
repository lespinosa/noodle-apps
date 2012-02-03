<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HTML_cake {
    function requestCakePHP($url) {
        $_GET['url']=$url;
        require_once 'app/webroot/index.php';
    }
}