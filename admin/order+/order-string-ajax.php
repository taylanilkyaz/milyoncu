<?php

include "OrderPlus.class.php";
$orderClassObj = new OrderPlus();
if (isset($_GET['status'])){
    echo $orderClassObj->getOrderString($_GET['status']);
}