<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
if (isset($_GET['option'])
) {
    $obj = new AddressUserRelation();
    $user_id = $_SESSION['id'];
    $option = $_GET['option'];
    if (strcmp($option,"bill")==0){
        echo json_encode($obj->getActiveBillAddress($user_id));
    }   else if (strcmp($option,"cargo")==0){
        echo json_encode($obj->getActiveCargoAddress($user_id));
    }
}



