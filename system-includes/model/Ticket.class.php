<?php

class Ticket{
    public static $I_AM_AlREADY_PARENT_ID = -1;
    public static $PARENT = 1;
    public static $ACTIVE = 1;
    public static $NOT_PARENT = 0;
    public static $NOT_ACTIVE = 0;

    private $id;
    private $user_id;
    private $title;
    private $description;
    private $parent_ticket_id;
    private $is_parent;
    private $is_acitve;
    private $add_datetime;

    /**
     * Ticket constructor.
     * @param $id
     * @param $user_id
     * @param $title
     * @param $description
     * @param $parent_ticket_id
     * @param $is_parent
     * @param $is_acitve
     * @param $add_datetime
     */
    public function __construct($id, $user_id, $title, $description, $parent_ticket_id, $is_parent, $is_acitve, $add_datetime)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->parent_ticket_id = $parent_ticket_id;
        $this->is_parent = $is_parent;
        $this->is_acitve = $is_acitve;
        $this->add_datetime = $add_datetime;
    }

    public static function __constructByMysqliRow($row):Ticket
    {
       return new self(
           $row[TicketDatabase::$ID],
           $row[TicketDatabase::$USER_ID],
           $row[TicketDatabase::$TITLE],
           $row[TicketDatabase::$DESC],
           $row[TicketDatabase::$PARENT_ID],
           $row[TicketDatabase::$IS_PARENT],
           $row[TicketDatabase::$IS_ACTIVE],
           $row[TicketDatabase::$ADD_DATETIME]
        );
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getParentTicketİd()
    {
        return $this->parent_ticket_id;
    }

    /**
     * @param mixed $parent_ticket_id
     */
    public function setParentTicketİd($parent_ticket_id)
    {
        $this->parent_ticket_id = $parent_ticket_id;
    }

    /**
     * @return mixed
     */
    public function getİsParent()
    {
        return $this->is_parent;
    }

    /**
     * @param mixed $is_parent
     */
    public function setIsParent($is_parent)
    {
        $this->is_parent = $is_parent;
    }

    /**
     * @return mixed
     */
    public function getIsAcitve()
    {
        return $this->is_acitve;
    }

    /**
     * @param mixed $is_acitve
     */
    public function setIsAcitve($is_acitve)
    {
        $this->is_acitve = $is_acitve;
    }

    /**
     * @return mixed
     */
    public function getAddDatetime()
    {
        return $this->add_datetime;
    }

    /**
     * @param mixed $add_datetime
     */
    public function setAddDatetime($add_datetime)
    {
        $this->add_datetime = $add_datetime;
    }


}
