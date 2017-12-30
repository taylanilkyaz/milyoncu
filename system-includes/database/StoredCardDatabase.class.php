<?php

class StoredCardDatabase extends Database {
    public static $STORED_CARD_TABLE_NAME = "kaydedilen_kartlar";
    public static $STORED_CARD_ID = "id";
    public static $STORED_CARD_USER_ID = "kullanıcı_id";
    public static $STORED_CARD_NUMBER = "kart_numarası";
    public static $STORED_CARD_NAME = "ad_soyad";
    public static $STORED_CARD_CVC = "cvc";
    public static $STORED_CARD_MONTH = "ay";
    public static $STORED_CARD_YEAR = "yıl";
    public static $STORED_CARD_ADD_DATETIME = "ekleme_zamanı";

    /**
     * @param $storedCardObj StoredCard
     * @return mixed
     */

    public function insert($storedCardObj){
        $user_id = $storedCardObj->getUserId();
        $card_number = $storedCardObj->getCardNumber();
        $card_name = $storedCardObj->getCardName();
        $card_cvc = $storedCardObj->getCardCvc();
        $card_month = $storedCardObj->getCardMonth();
        $card_year = $storedCardObj->getCardYear();

        $sql = sprintf("INSERT INTO %s (%s,%s,%s,%s,%s, %s) VALUES (?,?,?,?,?,?)",
            self::$STORED_CARD_TABLE_NAME,
            self::$STORED_CARD_USER_ID,
            self::$STORED_CARD_NUMBER,
            self::$STORED_CARD_NAME,
            self::$STORED_CARD_CVC,
            self::$STORED_CARD_MONTH,
            self::$STORED_CARD_YEAR);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("dsssss",
                $user_id,
                $card_number,
                $card_name,
                $card_cvc,
                $card_month,
                $card_year);

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

}