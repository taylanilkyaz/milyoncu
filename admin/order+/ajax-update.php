<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$obj = new OrderBuyRelationDatabase();
if (isset($_GET['order_code']) && isset($_GET['new_status'])){
    $obj->updateStatus($_GET['order_code'],$_GET['new_status']);
}