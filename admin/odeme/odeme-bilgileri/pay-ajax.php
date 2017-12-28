<?php
//5311570000000005
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
require $_SERVER['DOCUMENT_ROOT'].'/admin/buy/Buy.class.php';
require_once('../iyzico-b4u/config.php');

$user_id = $_SESSION['id'];
$dashboard = new Buy();
$totalPrice = $dashboard->getAllBasketTotalPrice($user_id) ;
$cargoPrice = $dashboard->getAllCargoPrice($user_id);
$fullPrice = doubleval($totalPrice) + doubleval($cargoPrice);

$basketList = $dashboard->getAllBasketAsProductArr($user_id);
$selectedInstallmentNumber = $_POST['selectedInstallmentNumber'];
$selectedInstallmentNumber = intval($selectedInstallmentNumber);


$request = new \Iyzipay\Request\CreatePaymentRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setPrice($totalPrice);
$request->setPaidPrice($fullPrice);
$request->setCurrency(\Iyzipay\Model\Currency::TL);
$request->setInstallment($selectedInstallmentNumber);
$request->setBasketId("B678323");
$request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);


$paymentCard = new \Iyzipay\Model\PaymentCard();

if(isset($_POST['cardId'])){
    /**
     * Eğer stored card ise
     */
    $storedCardId = $_POST['cardId'];
    $storedCardDatabase = new StoredCardDatabase();
    $storedCard = $storedCardDatabase->getStoredCardByID($storedCardId);

    $cardUserKey = $storedCard->getCardUserKey();
    $cardToken = $storedCard->getCardToken();

    $paymentCard->setCardUserKey($cardUserKey);
    $paymentCard->setCardToken($cardToken);
    $request->setPaymentCard($paymentCard);
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
    /**
     * Eğer stored card değilse
     */
    $paymentCard->setCardHolderName($ccSurname);
    $paymentCard->setCardNumber($ccNumber);
    /**
     * Bugünün tarihinden yüksek olmalı
     */
    $paymentCard->setExpireMonth($ccMonth);
    $paymentCard->setExpireYear($ccYear);
    $paymentCard->setCvc($ccCode);
    $paymentCard->setRegisterCard(0);
    $request->setPaymentCard($paymentCard);

}



$buyer = new \Iyzipay\Model\Buyer();
$buyer->setId("BY789");
$buyer->setName("John");
$buyer->setSurname("Doe");
$buyer->setGsmNumber("+905350000000");
$buyer->setEmail("email@email.com");
$buyer->setIdentityNumber("74300864791");
$buyer->setLastLoginDate("2015-10-05 12:43:35");
$buyer->setRegistrationDate("2013-04-21 15:12:09");
$buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
$buyer->setIp("85.34.78.112");
$buyer->setCity("Istanbul");
$buyer->setCountry("Turkey");
$buyer->setZipCode("34732");
$request->setBuyer($buyer);
$shippingAddress = new \Iyzipay\Model\Address();
$shippingAddress->setContactName("Jane Doe");
$shippingAddress->setCity("Istanbul");
$shippingAddress->setCountry("Turkey");
$shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
$shippingAddress->setZipCode("34742");
$request->setShippingAddress($shippingAddress);
$billingAddress = new \Iyzipay\Model\Address();
$billingAddress->setContactName("Jane Doe");
$billingAddress->setCity("Istanbul");
$billingAddress->setCountry("Turkey");
$billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
$billingAddress->setZipCode("34742");
$request->setBillingAddress($billingAddress);
$basketItems = array();

/**
 * @var $basketObj Product
 */
$sum = 0;
foreach ($basketList as $basketObj){

    /**
     * Bir ürün birden fazla alınmış olabilir.
     */
    $var = $basketObj->getCount();
    while($var-- != 0){
        $basketItem = new \Iyzipay\Model\BasketItem();
        $basketItem->setId($basketObj->getId());
        $basketItem->setName($basketObj->getName());
        $basketItem->setCategory1("Health");
        $basketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        $basketItem->setPrice($basketObj->getPrice());
        array_push($basketItems,$basketItem);
    }

}
$request->setBasketItems($basketItems);

$payment = \Iyzipay\Model\Payment::create($request, Config::options());

$res =  $payment->getStatus();
if($res === "success"){
    $_SESSION['is_success_pay'] = "true";
    $_SESSION['full_pay_price'] = $fullPrice;
    $_SESSION['hide_cc_number'] = $hideCCCode;
    if($selectedInstallmentNumber == 1)
        $_SESSION['installment_type'] = "Peşin";
    else
        $_SESSION['installment_type'] =  $selectedInstallmentNumber . " Taksit";
    echo "success";
}else{
    echo "failure";
}

//echo "<br>";
//echo $payment->getErrorMessage();
