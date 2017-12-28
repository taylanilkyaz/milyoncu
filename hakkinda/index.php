<?php
/**/
require '../system-header.php';
require '../login/Login.php';
global $debugHelper;
$login = new Login();
getHeader();
getNavbar();

if($login->isAlreadyLogin()){
    require 'faqs-form.php';
}else{
    require 'faqs-form.php';
}

?>