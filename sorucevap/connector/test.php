<?php

require_once 'b4u-register-connecter.php';

$obj = new RegisterConnector();


//$obj->createAccount('muhammet.ozturk@hacettepe.edu.tr','asd123','Admin',0);
$obj->login('Admin','asd123');
//$id = $obj->getUserid('rowreduce');
//$obj->changeEmail($id,'taylan@gmail.com');
//$obj->changeHandle($id,'taylan');
//$id = $obj->getUserid('taylan');
//$obj->changePassword($id,'taylan321');
//$obj->logout();
//$obj->deleteAccount($id);

//$obj->adminLogin();