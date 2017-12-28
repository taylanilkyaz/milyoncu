<?php
/**
 * Created by PhpStorm.
 * User: ayhan
 * Date: 3.08.2017
 * Time: 21:54
 */
$obj = new ExchangeRateDatabase();

$content = file_get_contents("http://www.tcmb.gov.tr/kurlar/today.xml");
$xml = simplexml_load_string($content);
$obj->updateExchangeRate($xml->Currency[0]->BanknoteSelling);