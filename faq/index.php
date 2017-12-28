<?php
/**/
require '../system-header.php';
require '../login/Login.php';
require 'Faqs.php';
global $debugHelper;
$login = new Login();
$faqs = new Faqs();
getHeader();
getNavbar();

if($login->isAlreadyLogin()){
    require 'faqs-form.php';
}else{
    require 'faqs-form.php';
}

?>