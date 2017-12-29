<?php

require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';

define("CLOSE_TICKET","Talep Kapat");
define("OPEN_CLOSED_TICKET","Talebi Yeniden Aç");
define("SEND_TICKET","Soru Gönder");

$controller = new TicketController();
$type = "";
if(isset($_POST['type']))
    $type = $_POST['type'];

/**
 * Form post tipi ticket kapat ve ya ticket gönder olabilir.
 * İki farklı sayfada kullanılıyor aslında
 */
$requestType = $_POST['save'] ?? $_POST['close'] ?? $_POST['reopen'];

switch($requestType){
    case SEND_TICKET:
        if($type === 'insertToParent'){
            $detail = $_POST['detail'];
            $parentId = $_POST['parentId'];
            $userId = $_SESSION['id'];
            $controller->insertTicketByParentId($userId,$detail,$parentId);
            redirect_javascript("/admin/ticket/index.php?go=open-ticket&dataId={$parentId}");
        }
        elseif($type === 'insertAsParent'){
            $subject = $_POST['subject'];
            $detail = $_POST['detail'];
            $userId = $_SESSION['id'];
            $controller->insertParentTicket($userId,$subject,$detail);
            redirect_javascript("/admin/ticket/index.php?go=open-ticket");
        }
        break;
    case CLOSE_TICKET:
        $userId = $_SESSION['id'];
        $parentId = $_POST['parentId'];
        $res = $controller->closeTicketByParentId($userId,$parentId);
        redirect_javascript("/admin/ticket/index.php?go=closed-ticket");
        break;
    case OPEN_CLOSED_TICKET:
        $userId = $_SESSION['id'];
        $parentId = $_POST['parentId'];
        $res = $controller->openTicketByParentId($userId,$parentId);
        redirect_javascript("/admin/ticket/index.php?go=open-ticket");
        break;
    default:
        break;
}




