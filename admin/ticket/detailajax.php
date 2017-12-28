<?php


require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';

$user_id = $_SESSION['id'];
$type = $_POST['parent_id'];
$controller = new TicketController();

$res = $controller->getTicketListByUserIdAndParentId($userId,$parentId);

if(!$res){
    $this->is_error = true;
    $this->error_message = $this->getDb()->getErrorMessage();
    return false;
}

$openParenTicketArr = array();
while($row = $res->fetch_assoc()){
    $openParenTicketArr[] =  Ticket::__constructByMysqliRow($row);
}

return $openParenTicketArr;