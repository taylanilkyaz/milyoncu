<?php

class StoredCard{
    private $id;
    private $user_id;
    private $card_number;
    private $card_name;
    private $card_cvc;
    private $card_month;
    private $card_year;
    private $add_datetime;


    public static function __constructByMysqliRow($row){
        $obj =  new self();
        $obj->setId($row[StoredCardDatabase::$STORED_CARD_ID]);
        $obj->setUserId($row[StoredCardDatabase::$STORED_CARD_USER_ID]);
        $obj->setCardNumber($row[StoredCardDatabase::$STORED_CARD_NUMBER]);
        $obj->setCardName($row[StoredCardDatabase::$STORED_CARD_NAME]);
        $obj->setCardCvc($row[StoredCardDatabase::$STORED_CARD_CVC]);
        $obj->setCardMonth($row[StoredCardDatabase::$STORED_CARD_MONTH]);
        $obj->setCardYear($row[StoredCardDatabase::$STORED_CARD_YEAR]);
        $obj->setAddDatetime($row[StoredCardDatabase::$STORED_CARD_ADD_DATETIME]);
        return $obj;
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
    public function getCardNumber()
    {
        return $this->card_number;
    }

    /**
     * @param mixed $card_number
     */
    public function setCardNumber($card_number)
    {
        $this->card_number = $card_number;
    }

    /**
     * @return mixed
     */
    public function getCardName()
    {
        return $this->card_name;
    }

    /**
     * @param mixed $card_name
     */
    public function setCardName($card_name)
    {
        $this->card_name = $card_name;
    }

    /**
     * @return mixed
     */
    public function getCardCvc()
    {
        return $this->card_cvc;
    }

    /**
     * @param mixed $card_cvc
     */
    public function setCardCvc($card_cvc)
    {
        $this->card_cvc = $card_cvc;
    }

    /**
     * @return mixed
     */
    public function getCardMonth()
    {
        return $this->card_month;
    }

    /**
     * @param mixed $card_month
     */
    public function setCardMonth($card_month)
    {
        $this->card_month = $card_month;
    }

    /**
     * @return mixed
     */
    public function getCardYear()
    {
        return $this->card_year;
    }

    /**
     * @param mixed $card_year
     */
    public function setCardYear($card_year)
    {
        $this->card_year = $card_year;
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