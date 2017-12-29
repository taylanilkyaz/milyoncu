<?php

class StoredCardDatabase extends Database {
    public static $STORED_CARD_TABLE_NAME = "stored_card";
    public static $STORED_CARD_ID = "id";
    public static $STORED_CARD_USER_ID = "user_id";
    public static $STORED_CARD_USER_KEY = "card_user_key";
    public static $STORED_CARD_TOKEN = "card_token";
    public static $STORED_CARD_ALIAS = "card_alias";
    public static $STORED_CARD_BIN_NUMBER = "bin_number";
    public static $STORED_CARD_ADD_DATETIME = "add_datetime";
    public static $STORED_CARD_HOLDER_NAME = "card_holder_name";

    /**
     * @param $storedCardObj StoredCard
     * @return mixed
     */

    public function insert($storedCardObj){
        $user_id = $storedCardObj->getUserId();
        $user_key = $storedCardObj->getCardUserKey();
        $token = $storedCardObj->getCardToken();
        $card_alias = $storedCardObj->getCardAlias();
        $bin_number = $storedCardObj->getBinNumber();
        $card_holder_name = $storedCardObj->getCardHolderName();

        $sql = sprintf("INSERT INTO %s (%s,%s,%s,%s,%s, %s) VALUES (?,?,?,?,?,?)",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_USER_ID,
            self::$STORED_CARD_USER_KEY,
            self::$STORED_CARD_TOKEN,
            self::$STORED_CARD_ALIAS,
            self::$STORED_CARD_BIN_NUMBER,
            self::$STORED_CARD_HOLDER_NAME);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("dsssss",
                $user_id,
                $user_key,
                $token,
                $card_alias,
                $bin_number,
                $card_holder_name);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function deleteStoredCardByID($id){
        $sql = sprintf("DELETE FROM %s WHERE %s=?",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_ID);

        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",
                $id);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card silme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card silme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function deleteStoredCardByUserID($userID){
        $sql = sprintf("DELETE FROM %s WHERE %s=?",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_USER_ID);

        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",
                $userID);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function deleteStoredCardByUserKey($userKey){
        $sql = sprintf("DELETE FROM %s WHERE %s=?",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_USER_KEY);

        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",
                $userKey);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function deleteStoredCardByToken($token){
        $sql = sprintf("DELETE FROM %s WHERE %s=?",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_TOKEN);

        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",
                $token);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    /**
     * @param $userID
     * @return StoredCard[]
     */
    public function getStoredCardByUserID($userID){
        $array = [];
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_USER_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",
                $userID);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }   else{
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()){
                    array_push($array,StoredCard::__constructByMysqliRow($row));
                }
                return $array;
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function getStoredCardByID($id){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",
                $id);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }   else{
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return StoredCard::__constructByMysqliRow($row);
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function getStoredCardByUserKey($userKey){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_USER_KEY);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",
                $userKey);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }   else{
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return StoredCard::__constructByMysqliRow($row);
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function getStoredCardByToken($token){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_TOKEN);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",
                $token);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }   else{
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return StoredCard::__constructByMysqliRow($row);
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Stored Card getirme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }


}