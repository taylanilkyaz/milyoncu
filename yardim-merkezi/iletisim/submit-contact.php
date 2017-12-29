<?php

require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';

if (isset($_GET['email']) && isset($_GET['user_name']) && isset($_GET['mesaj']) && isset($_GET['choices'])){
    $subject = $_GET['choices'];
    $user_name = $_GET['user_name'];
    $message = $_GET['mesaj'];
    $email = $_GET['email'];
    $contactDbObj = new ContactDatabase();
    $contactModelObj = new Contact(null,$subject,$user_name,$message,$email);
    $contactDbObj->insert($contactModelObj);
}
redirect_javascript("/yardim-merkezi/iletisim/index.php");