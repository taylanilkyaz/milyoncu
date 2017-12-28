<?php
require '../system-header.php';
require '../login/Login.php';
require 'Contact.php';
global $debugHelper;
$login = new Login();
$contact = new Contact();
getHeader();
getNavbar();
require 'contact-form.php';


/**
 * Üye durumundaysa
 */
if($login->isAlreadyLogin()){

}
/**
 * Ziyaretçi durumundaysa
 */
else{

}

?>