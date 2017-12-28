<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';

if (isset($_GET['firstName']) && isset($_GET['lastName']) &&
    isset($_GET['country']) &&  isset($_GET['city']) && isset($_GET['state']) &&
    isset($_GET['district']) && isset($_GET['cargoAddressName']) &&
    isset($_GET['postCode']) && isset($_GET['addressName'])
    && isset($_GET['phoneNumber'])
) {

        $firstname = $_GET['firstName'];
        $lastname = $_GET['lastName'];
        $country = $_GET['country'];
        $city = $_GET['city'];
        $county = $_GET['state'];
        $district = $_GET['district'];
        $cargoAddress = $_GET['cargoAddressName'];
        $postcode = $_GET['postCode'];
        $address_name = $_GET['addressName'];
        $phoneNumber = $_GET['phoneNumber'];

        $obj = new AddressDatabase();
        //address objesi oluşturuldu db'e atılmalı
        $address_obj = new Address($firstname, $lastname, $country, $city, $county, $district, null, $cargoAddress, $postcode, $address_name, $phoneNumber);
        $obj->insertCargoAddress($address_obj);
        if (isset($_GET['example'])){
            $billingAddress = $cargoAddress;
            $address_obj = new Address($firstname, $lastname, $country, $city, $county, $district, $billingAddress, null, $postcode, $address_name, $phoneNumber);
            $obj->insertBillAddress($address_obj);
        }

}   else if(isset($_GET['cargoAddress']) && isset($_GET['billAddress'])){
    $obj = new AddressUserRelation();
    $user_id = $_SESSION['id'];
    $obj->setEnabledBill($_GET['billAddress'],$user_id);
    $obj->setEnabledCargo($_GET['cargoAddress'],$user_id);
}

redirect_javascript("/admin/odeme/odeme-bilgileri/index.php");
