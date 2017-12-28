<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$object = new ProductDatabase();
echo $object->listAllProduct();
