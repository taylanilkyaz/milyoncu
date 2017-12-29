<?php

$obj = new ExchangeRateDatabase();

$content = file_get_contents("http://www.tcmb.gov.tr/kurlar/today.xml");
$xml = simplexml_load_string($content);
$obj->updateExchangeRate($xml->Currency[0]->BanknoteSelling);