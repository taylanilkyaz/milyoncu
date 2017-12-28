<?php

require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';

$user_id = $_SESSION['id'];

if (isset($_POST['type'])){
    $type = $_POST['type'];
}   else{
    $type = $_GET['go'];
}

$controller = new TicketController();

switch($type){
    case TicketController::$OPEN_TICKET:
        require 'open-ticket-form.php';
        break;

    case TicketController::$CLOSED_TICKET:
        require 'closed-ticket-form.php';
        break;

    case TicketController::$SUBMIT_TICKET:
        require 'submit-ticket-form.php';
        break;

    default:
        exit(1);
        break;
}