<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
require $_SERVER['DOCUMENT_ROOT'].'/admin/buy/Buy.class.php';

$user_id = $_SESSION['id'];
$dashboard = new Buy();
$totalPrice = $dashboard->getAllBasketTotalPrice($user_id) ;
$cargoPrice = $dashboard->getAllCargoPrice($user_id);
$fullPrice = doubleval($totalPrice) + doubleval($cargoPrice);

$basketList = $dashboard->getAllBasketAsProductArr($user_id);
$selectedInstallmentNumber = $_POST['selectedInstallmentNumber'];
$selectedInstallmentNumber = intval($selectedInstallmentNumber);


if(isset($_POST['cardId'])){
    /**
     * Eğer stored card ise
     */
    $storedCardId = $_POST['cardId'];
    $storedCardDatabase = new StoredCardDatabase();
    $storedCard = $storedCardDatabase->getStoredCardByID($storedCardId);

    $_SESSION['installment_type'] = "Peşin";
    $_SESSION['is_success_pay'] = "true";
    $_SESSION['full_pay_price'] = $fullPrice;
    $_SESSION['hide_cc_number'] = substr($storedCard->getCardNumber(),0,2)."************" .substr($storedCard->getCardNumber(),-2);;
    redirect_javascript("/admin/odeme/siparis-ozeti/index.php",500);

}else{
    $ccNumber = $_POST['ccNumber'];
    $ccSurname = $_POST['ccSurname'];
    $ccDate = $_POST['ccDate'];
    $ccCode =$_POST['ccCode'];

    $hideCCCode = substr($ccNumber,0,2)."************" .substr($ccNumber,-2);

    $ccNumber = str_replace(" ","",$ccNumber);
    $ccSurname = preg_replace('!\s+!', ' ', $ccSurname);
    $ccDate = str_replace(" ","",$ccDate);
    $ccMonth = explode("/",$ccDate)[0];
    $ccYear = explode("/",$ccDate)[1];

    $_SESSION['installment_type'] = "Peşin";
    $_SESSION['is_success_pay'] = "true";
    $_SESSION['full_pay_price'] = $fullPrice;
    $_SESSION['hide_cc_number'] = $hideCCCode;
redirect_javascript("/admin/odeme/siparis-ozeti/index.php",500);
}