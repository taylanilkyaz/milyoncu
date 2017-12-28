<?php
    require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
    require "../buy/Buy.class.php";


$user_id = $_SESSION['id'];
if (isset($_POST['name'])){
    $product_name = $_POST['name'];
}
$type = $_POST['type'];
$dashboard = new Buy();

switch($type){
    case "insert":
        $res = $dashboard->addBasketByProductName($_SESSION['id'],$_POST['name']);
        if($res == null || $res != 'ok'){
            echo("Baskete ürün ekleme sırasında hata : " . $res);
            exit(1);
        }
        break;

    case "delete":
        $res = $dashboard->deleteBasketByProductName($user_id,$product_name);
        if(!$res){
            echo("Hata : " . $dashboard->getDb()->getErrorMessage());
            exit(1);
        }
        break;

    case "view":
        $res = $dashboard->getAllBasketForPage($user_id);
        if($res == null){
            echo("");
            exit(1);
        }
        echo $res;
        break;

    case "empty":
        $res = $dashboard-> deleteProductFromBasket($user_id,$product_name);
        if($res == null || strlen($res) < 4){
            echo("");
            exit(1);
        }
        echo $res;
        break;

    default:
        exit(1);
        break;
}














