<?php
require '../system-header.php';
require 'Logout.php';
global $debugHelper;
$logout = new Logout();
getHeader();
getNavbar();

if($logout->isAlreadyLogin()){
    session_destroy();
    redirect_javascript('/home/index.php');
}else{
    redirect_javascript('/login/login-form.php');
}

?>