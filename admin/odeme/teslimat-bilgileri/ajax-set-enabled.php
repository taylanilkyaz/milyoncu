<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
if (isset($_GET['option']) && isset($_GET['id'])
) {
    setEnabled();
}
function setEnabled(){
    $obj = new AddressUserRelation();
    $option = $_GET['option'];
    $id = $_GET['id'];
    $user_id = $_SESSION['id'];
    if (strcmp($option,"bill")==0){
        $obj->setEnabledBill($id,$user_id);
    }   else if (strcmp($option,"cargo")==0){
        $obj->setEnabledCargo($id,$user_id);
    }
}



