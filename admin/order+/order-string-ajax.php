<?php
/**
 * Created by PhpStorm.
 * User: ayhan
 * Date: 5.08.2017
 * Time: 22:41
 */
include "OrderPlus.class.php";
$orderClassObj = new OrderPlus();
if (isset($_GET['status'])){
    echo $orderClassObj->getOrderString($_GET['status']);
}