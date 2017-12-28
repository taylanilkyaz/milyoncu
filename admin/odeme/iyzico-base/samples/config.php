<?php

require_once('../IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("sandbox-jaK3Vx7VL8bFzyqq8BSC7kYz2lYaoffz");
        $options->setSecretKey("sandbox-WoRapmc3mJiw4fkylxtuwjDAGyVvYXnM");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }
}