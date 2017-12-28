<?php

class ExchangeRate{
    /**
     * @return mixed
     * doların güncel kurunu almak istedğimiz zaman bu methodu kullanalım
     */
    public static function getDOLLARTOTRY()
    {
        $obj = new ExchangeRateDatabase();
        return $obj->getExchangeRate();
    }

}