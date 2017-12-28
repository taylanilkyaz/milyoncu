<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
if (isset($_GET['cargoFirstName']) && isset($_GET['cargoLastName']) &&
    isset($_GET['cargoCountry']) &&  isset($_GET['cargoCity']) && isset($_GET['cargoState']) &&
    isset($_GET['cargoDistrict']) && isset($_GET['cargoAddressName'])
    && isset($_GET['cargoPostCode']) && isset($_GET['addressName'])
    && isset($_GET['cargoPhoneNumber'])
) {

    $firstname = $_GET['cargoFirstName'];
    $lastname = $_GET['cargoLastName'];
    $country = $_GET['cargoCountry'];
    $city = $_GET['cargoCity'];
    $county = $_GET['cargoState'];
    $district = $_GET['cargoDistrict'];
    $cargoAddress = $_GET['cargoAddressName'];
    $postcode = $_GET['cargoPostCode'];
    $address_name = $_GET['addressName'];
    $phoneNumber = $_GET['cargoPhoneNumber'];

    $obj = new AddressDatabase();
    //address objesi oluşturuldu db'e atılmalı
    $address_obj = new Address($firstname, $lastname, $country, $city, $county, $district, $cargoAddress, null, $postcode, $address_name, $phoneNumber);
    $one_bill_address = $obj->insertBillAddress($address_obj);
    echo '{"address":[';
    echo $one_bill_address.",";
    $address_obj = new Address($firstname, $lastname, $country, $city, $county, $district, null, $cargoAddress, $postcode, $address_name, $phoneNumber);
    $one_cargo_address = $obj->insertCargoAddress($address_obj);
    echo $one_cargo_address;
    echo ']}';
}



