<?php

class ContactDatabase extends Database{
    public static $CONTACT_TABLE_NAME = "contact";
    public static $CONTACT_ID = "id";
    public static $CONTACT_SUBJECT = "subject";
    public static $CONTACT_EMAIL = "email";
    public static $CONTACT_USER_NAME = "name";
    public static $CONTACT_MESSAGE = "message";

    /**
     * @param $contactObj Contact
     * @return mixed
     */
    public function insert($contactObj){
        $subject = $contactObj->getSubject();
        $email = $contactObj->getEmail();
        $name = $contactObj->getUserName();
        $message = $contactObj->getMessage();

        $sql = sprintf("INSERT INTO %s (%s,%s,%s,%s) VALUES (?,?,?,?)",
            self::$CONTACT_TABLE_NAME,
            self::$CONTACT_SUBJECT,
            self::$CONTACT_EMAIL,
            self::$CONTACT_USER_NAME,
            self::$CONTACT_MESSAGE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("ssss",
                $subject,
                $email,
                $name,
                $message);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Contact.class ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Contact.class ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function getAllContacts(){
        $arr = [];
        $sql = sprintf("SELECT * FROM %s",
            self::$CONTACT_TABLE_NAME);
        if ($stmt = $this->getDb()->prepare($sql)){

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Contact.class ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }   else{
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()){
                    array_push($arr,Contact::__constructByMysqliRow($row));
                }
                return $arr;
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Contact.class ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }
}