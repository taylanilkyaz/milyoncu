<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
if (isset($_GET['billFirstName']) && isset($_GET['billLastName']) &&
    isset($_GET['billCountry']) &&  isset($_GET['billCity']) && isset($_GET['billState']) &&
    isset($_GET['billDistrict']) && isset($_GET['billAddressName'])
    && isset($_GET['billPostCode']) && isset($_GET['addressName'])
    && isset($_GET['billPhoneNumber'])
) {

    $firstname = $_GET['billFirstName'];
    $lastname = $_GET['billLastName'];
    $country = $_GET['billCountry'];
    $city = $_GET['billCity'];
    $county = $_GET['billState'];
    $district = $_GET['billDistrict'];
    $billingAddress = $_GET['billAddressName'];
    $postcode = $_GET['billPostCode'];
    $address_name = $_GET['addressName'];
    $phoneNumber = $_GET['billPhoneNumber'];

    $obj = new AddressDatabase();
    //address objesi oluşturuldu db'e atılmalı
    $address_obj = new Address($firstname, $lastname, $country, $city, $county, $district, $billingAddress, null, $postcode, $address_name, $phoneNumber);
    $one_bill_address = $obj->insertBillAddress($address_obj);
    echo '{"address":[';
    echo $one_bill_address.",";
    $address_obj = new Address($firstname, $lastname, $country, $city, $county, $district, null, $billingAddress, $postcode, $address_name, $phoneNumber);
    $one_cargo_address = $obj->insertCargoAddress($address_obj);
    echo $one_cargo_address;
    echo ']}';
}



