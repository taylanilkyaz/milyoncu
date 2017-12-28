<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$object = new UserDatabase();
//admin tarafından düzenlenen kullanıcı işlemleri
if (isset($_GET['first_name']) &&
    isset($_GET['last_name']) &&
    isset($_GET['e_mail']) &&
    isset($_GET['phone_number'])
    ) {
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $e_mail = $_GET['e_mail'];
    $phone_number = $_GET['phone_number'];
    $id = $_GET['id'];
    $object->editUserByAdmin($first_name,$last_name,$e_mail,$phone_number,$id);
}