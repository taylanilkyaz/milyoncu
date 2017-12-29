<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$object = new ProductDatabase();
if (isset($_POST['id'])){
    $productId = $_POST['id'];
    echo $object->deleteProduct($productId);
}
