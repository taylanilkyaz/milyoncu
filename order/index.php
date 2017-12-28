<?php
require '../system-header.php';
require '../login/Login.php';
require 'Order.php';
global $debugHelper;

$login = new Login();
$order = new Order();
getHeader();
getNavbar();

if($login->isAlreadyLogin()){
    require 'order-form.php';
}else{
    require 'order-form.php';
}

?>