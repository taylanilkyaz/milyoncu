<?php
/**
 * Created by PhpStorm.
 * User: ayhan
 * Date: 8.08.2017
 * Time: 16:06
 */
if (isset($_GET['order_code']) && isset($_GET['cargo_no'])) {
    require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
    $obj = new OrderBuyRelationDatabase();
    $obj->insertCargoNo($_GET['order_code'],$_GET['cargo_no']);

}