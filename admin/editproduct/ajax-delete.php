<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$object = new ProductDatabase();
if (isset($_GET['id'])){
    $productId = $_GET['id'];
    echo $object->deleteProduct($productId);
}
