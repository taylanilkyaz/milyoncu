<?php

class Contact{
    private $id;
    private $subject;
    private $user_name;
    private $message;
    private $email;

    /**
     * Contact.class constructor.
     * @param $subject
     * @param $user_name
     * @param $message
     * @param $email
     */
    public function __construct($id=null,$subject, $user_name, $message, $email)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->user_name = $user_name;
        $this->message = $message;
        $this->email = $email;
    }

    public static function __constructByMysqliRow($row){
        return new self(
            $row[ContactDatabase::$CONTACT_ID],
            $row[ContactDatabase::$CONTACT_SUBJECT],
            $row[ContactDatabase::$CONTACT_USER_NAME],
            $row[ContactDatabase::$CONTACT_MESSAGE],
            $row[ContactDatabase::$CONTACT_EMAIL]
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
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


}