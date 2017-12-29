<?php

/**
 * Created by PhpStorm.
 * User.class: ayhan
 * Date: 19.05.2017
 * Time: 09:57
 */
class User
{
    private $id;
    private $e_mail;
    private $tc;
    private $password;
    private $first_name;
    private $last_name;
    private $add_datetime;
    private $phone_number;

    /**
     * User constructor.
     * @param $id
     * @param $e_mail
     * @param $tc
     * @param $password
     * @param $first_name
     * @param $last_name
     * @param $father_first
     * @param $mother_first
     * @param $mother_maiden
     * @param $add_datetime
     * @param $phone_number
     */
    public function __construct($id, $e_mail, $tc, $password, $first_name, $last_name, $add_datetime, $phone_number)
    {
        $this->id = $id;
        $this->e_mail = $e_mail;
        $this->tc = $tc;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->add_datetime = $add_datetime;
        $this->phone_number = $phone_number;
    }

    public static function __constructByMysqliRow($row)
    {
        return new self(
            $row[UserDatabase::$USER_ID],
            $row[UserDatabase::$USER_E_MAIL],
            $row[UserDatabase::$USER_TC],
            null,
            $row[UserDatabase::$USER_FIRST_NAME],
            $row[UserDatabase::$USER_LAST_NAME],
            null,
            $row[UserDatabase::$USER_PHONE_NUMBER]
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
    public function getEMail()
    {
        return $this->e_mail;
    }

    /**
     * @param mixed $e_mail
     */
    public function setEMail($e_mail)
    {
        $this->e_mail = $e_mail;
    }

    /**
     * @return mixed
     */
    public function getTc()
    {
        return $this->tc;
    }

    /**
     * @param mixed $tc
     */
    public function setTc($tc)
    {
        $this->tc = $tc;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getFatherFirst()
    {
        return $this->father_first;
    }

    /**
     * @param mixed $father_first
     */
    public function setFatherFirst($father_first)
    {
        $this->father_first = $father_first;
    }

    /**
     * @return mixed
     */
    public function getMotherFirst()
    {
        return $this->mother_first;
    }

    /**
     * @param mixed $mother_first
     */
    public function setMotherFirst($mother_first)
    {
        $this->mother_first = $mother_first;
    }

    /**
     * @return mixed
     */
    public function getMotherMaiden()
    {
        return $this->mother_maiden;
    }

    /**
     * @param mixed $mother_maiden
     */
    public function setMotherMaiden($mother_maiden)
    {
        $this->mother_maiden = $mother_maiden;
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

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }





}