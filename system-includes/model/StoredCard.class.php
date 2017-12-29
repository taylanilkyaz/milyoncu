<?php

class StoredCard{
    private $id;
    private $user_id;
    private $card_user_key;
    private $card_token;
    private $card_alias;
    private $bin_number;
    private $add_datetime;
    private $card_holder_name;


    public static function __constructByMysqliRow($row){
        $obj =  new self();
        $obj->setId($row[StoredCardDatabase::$STORED_CARD_ID]);
        $obj->setUserId($row[StoredCardDatabase::$STORED_CARD_USER_ID]);
        $obj->setCardUserKey($row[StoredCardDatabase::$STORED_CARD_USER_KEY]);
        $obj->setCardToken($row[StoredCardDatabase::$STORED_CARD_TOKEN]);
        $obj->setCardAlias($row[StoredCardDatabase::$STORED_CARD_ALIAS]);
        $obj->setBinNumber($row[StoredCardDatabase::$STORED_CARD_BIN_NUMBER]);
        $obj->setAddDatetime($row[StoredCardDatabase::$STORED_CARD_ADD_DATETIME]);
        $obj->setCardHolderName($row[StoredCardDatabase::$STORED_CARD_HOLDER_NAME]);
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
    public function getCardUserKey()
    {
        return $this->card_user_key;
    }

    /**
     * @param mixed $card_user_key
     */
    public function setCardUserKey($card_user_key)
    {
        $this->card_user_key = $card_user_key;
    }

    /**
     * @return mixed
     */
    public function getCardToken()
    {
        return $this->card_token;
    }

    /**
     * @param mixed $card_token
     */
    public function setCardToken($card_token)
    {
        $this->card_token = $card_token;
    }

    /**
     * @param $card_alias
     */
    public function setCardAlias($card_alias)
    {
        $this->card_alias = $card_alias;
    }

    /**
     * @param $bin_number
     */
    public function setBinNumber($bin_number)
    {
        $this->bin_number = $bin_number;
    }

    /**
     * @return mixed
     */
    public function getCardAlias()
    {
        return $this->card_alias;
    }

    /**
     * @return mixed
     */
    public function getBinNumber()
    {
        return $this->bin_number;
    }

    /**
     * @return mixed
     */
    public function getAddDatetime()
    {
        return $this->add_datetime;
    }

    public function setCardHolderName($ccSurname)
    {
        $this->card_holder_name = $ccSurname;
    }

    /**
     * @return mixed
     */
    public function getCardHolderName()
    {
        return $this->card_holder_name;
    }

    /**
     * @param mixed $add_datetime
     */
    public function setAddDatetime($add_datetime)
    {
        $this->add_datetime = $add_datetime;
    }






}