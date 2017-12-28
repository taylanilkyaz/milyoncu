<?php

class TicketController{
    private $db;
    private $is_error= false;
    private $error_message ;

    public static $CLOSED_TICKET = "closed-ticket";
    public static $OPEN_TICKET = "open-ticket";
    public static $SUBMIT_TICKET = "submit-ticket";

    public function __construct()
    {

    }

    public function getDb(){

        if(!isset($this->db)) {
            $this->db = new TicketDatabase();
        }

        return $this->db;
    }

    public function openParentTickets($user_id) {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type']==UserTypes::$ADMIN_USER){
            $res = $this->getDb()->getOpenTicketParentForAdmin();
            if(!$res){
                $this->is_error = true;
                $this->error_message = $this->getDb()->getErrorMessage();
                return false;
            }
        }   else{
            $res = $this->getDb()->getOpenTicketParentByUserId($user_id);
            if(!$res){
                $this->is_error = true;
                $this->error_message = $this->getDb()->getErrorMessage();
                return false;
            }
        }


        $openParenTicketArr = array();
        while($row = $res->fetch_assoc()){
            $openParenTicketArr[] =  Ticket::__constructByMysqliRow($row);
        }

        return $openParenTicketArr;

    }

    public function closeParentTickets($user_id){
        if (isset($_SESSION['user_type']) && $_SESSION['user_type']==UserTypes::$ADMIN_USER){
            $res  = $this->getDb()->getCloseTicketListForAdmin();
            if(!$res){
                $this->is_error = true;
                $this->error_message = $this->getDb()->getErrorMessage();
                return false;
            }
        }   else{
            $res  = $this->getDb()->getCloseTicketListByUserId($user_id);
            if(!$res){
                $this->is_error = true;
                $this->error_message = $this->getDb()->getErrorMessage();
                return false;
            }
        }


        $openParenTicketArr = array();
        while($row = $res->fetch_assoc()){
            $openParenTicketArr[] =  Ticket::__constructByMysqliRow($row);
        }

        return $openParenTicketArr;
    }

    public function closeTicketByParentId($userId,$parentId){
        $res  = $this->getDb()->closeByParentId($userId,$parentId);

        if(!$res){
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return false;
        }

        return true;
    }

    public function openTicketByParentId($userId,$parentId){
        $res  = $this->getDb()->openByParentId($userId,$parentId);

        if(!$res){
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return false;
        }

        return true;
    }

    public function getTicketListByParentId($userId, $parentId)
    {
        $res  = $this->getDb()->getTicketListByUserIdAndParentId($userId,$parentId);

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
    }

    public function insertParentTicket($userId, $subject, $detail)
    {
        $res  = $this->getDb()->addTicket($userId,$subject,$detail,Ticket::$PARENT,Ticket::$ACTIVE,Ticket::$I_AM_AlREADY_PARENT_ID);

        if(!$res){
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return false;
        }

        return true;
    }

    public function insertTicketByParentId($userId,$detail,$parentId){
        $res  = $this->getDb()->addTicket($userId,"",$detail,Ticket::$NOT_PARENT,Ticket::$ACTIVE,$parentId);

        if(!$res){
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return false;
        }

        return true;
    }

    public function getTicketByID($userId, $ticketId)
    {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type']==UserTypes::$ADMIN_USER){
            $res  = $this->getDb()->getTicketByIdForAdmin($ticketId);
            if(!$res){
                $this->is_error = true;
                $this->error_message = $this->getDb()->getErrorMessage();
                return false;
            }
        }   else{
            $res  = $this->getDb()->getTicketById($userId,$ticketId);

            if(!$res){
                $this->is_error = true;
                $this->error_message = $this->getDb()->getErrorMessage();
                return false;
            }

        }

        $row = $res->fetch_assoc();
        $ticket =  Ticket::__constructByMysqliRow($row);
        return $ticket;
    }

    public function getLastTicketInOpenTickets($userId)
    {
        $res  = $this->getDb()->getLastTicketIdInOpenTickets($userId);

        if(!$res){
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return false;
        }

        $row = $res->fetch_assoc();
        return $row['id'];
    }

    public function getLastTicketInCloseTickets($userId)
    {
        $res  = $this->getDb()->getLastTicketIdInCloseTickets($userId);

        if(!$res){
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return false;
        }

        $row = $res->fetch_assoc();
        return $row['id'];
    }


}