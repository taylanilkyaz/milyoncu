<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/admin/odeme/iyzico-base/IyzipayBootstrap.php';


IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("sandbox-vd6gth8g6iHRchQLRpCOZ2A6Kroebwgg");
        $options->setSecretKey("sandbox-3wOPWDQ8X7DporNMpEtyU7dUzVySO9nj");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }
}