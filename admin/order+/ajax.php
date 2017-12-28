<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$obj = new OrderBuyRelationDatabase();
    if (isset($_GET['option'])){
        $var = $obj->getAllOrderRelations();
        echo $var;
    }