<?php

class AddressUserRelation extends Database{
    public static $RELATION_TABLE_NAME = "adres_kullanıcı_relation";
    public static $RELATION_USER_ID = "kullanıcı_id";
    public static $RELATION_BILL_ADDRESS_ID = "fatura_adresi_id";
    public static $RELATION_CARGO_ADDRESS_ID = "kargo_adresi_id";
    public static $ADDRESS_IS_ACTIVE ="aktif";
    public static $ENABLE = 1;
    public static $DISABLE =0;



    public function createAddressUserRelation($bill_address_id,$cargo_address_id,$user_id){
        $sql = sprintf("INSERT INTO %s (%s,%s,%s) VALUES (?,?,?)",
            self::$RELATION_TABLE_NAME,self::$RELATION_USER_ID,self::$RELATION_BILL_ADDRESS_ID,self::$RELATION_CARGO_ADDRESS_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("ddd",$user_id,$bill_address_id,$cargo_address_id);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Adres kullanıcı ilişki kurulması sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }
        else {
            $this->setIsError(true);
            $this->setErrorMessage("Adres kullanıcı ilkişki kurulması sırasında hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function isAddressExists($user_id){
        $sql = sprintf("SELECT * FROM %s WHERE %s=? AND %s IS NOT NULL",
            self::$RELATION_TABLE_NAME,
            self::$RELATION_USER_ID,
            self::$RELATION_CARGO_ADDRESS_ID);

        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d",$user_id);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                if ($result->num_rows==0)
                    return false;
                else
                    return true;
            }
        }
        else {
            $this->setIsError(true);
            $this->setErrorMessage("Adres varlığı bulunurken hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function setEnabledBill($id,$user_id){
        $sql = sprintf("UPDATE %s SET %s=%s WHERE %s IS NOT NULL AND %s=?",
            self::$RELATION_TABLE_NAME,
            self::$ADDRESS_IS_ACTIVE,
            self::$DISABLE,
            self::$RELATION_BILL_ADDRESS_ID,
            self::$RELATION_USER_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$user_id);
            if ($stmt->execute()){
                $sql2 = sprintf("UPDATE %s SET %s=%s WHERE %s=? AND %s=?",
                    self::$RELATION_TABLE_NAME,
                    self::$ADDRESS_IS_ACTIVE,
                    self::$ENABLE,
                    self::$RELATION_BILL_ADDRESS_ID,
                    self::$RELATION_USER_ID);
                if ($stmt2 = $this->getDb()->prepare($sql2)){
                    $stmt2->bind_param("dd",$id,$user_id);
                    if (!$stmt2->execute()){
                        return "hatali sql";
                    }
                }
            }
        }
    }

    public function setEnabledCargo($id,$user_id){
        $sql = sprintf("UPDATE %s SET %s=%s WHERE %s IS NOT NULL AND %s=?",
            self::$RELATION_TABLE_NAME,
            self::$ADDRESS_IS_ACTIVE,
            self::$DISABLE,
            self::$RELATION_CARGO_ADDRESS_ID,
            self::$RELATION_USER_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$user_id);
            if ($stmt->execute()){
                $sql2 = sprintf("UPDATE %s SET %s=%s WHERE %s=? AND %s=?",
                    self::$RELATION_TABLE_NAME,
                    self::$ADDRESS_IS_ACTIVE,
                    self::$ENABLE,
                    self::$RELATION_CARGO_ADDRESS_ID,
                    self::$RELATION_USER_ID);
                if ($stmt2 = $this->getDb()->prepare($sql2)){
                    $stmt2->bind_param("dd",$id,$user_id);
                    if (!$stmt2->execute()){
                        return "hatali sql";
                    }
                }
            }
        }
    }

    public function getActiveBillAddress($user_id){
        $sql = sprintf("SELECT %s FROM %s WHERE %s=? AND %s=? AND %s IS NOT NULL",
            self::$RELATION_BILL_ADDRESS_ID,
            self::$RELATION_TABLE_NAME,
            self::$RELATION_USER_ID,
            self::$ADDRESS_IS_ACTIVE,
            self::$RELATION_BILL_ADDRESS_ID);

        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("dd",$user_id,self::$ENABLE);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Aktif fatura adresi bulunurken hata meydana geldi : " .$this->getDb()->error);
            }   else{
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                return $singleRow[self::$RELATION_BILL_ADDRESS_ID];
            }
        }
        else {
            $this->setIsError(true);
            $this->setErrorMessage("Aktif fatura adresi bulunurken hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function getActiveCargoAddress($user_id){
        $sql = sprintf("SELECT %s FROM %s WHERE %s=? AND %s=? AND %s IS NOT NULL",
            self::$RELATION_CARGO_ADDRESS_ID,
            self::$RELATION_TABLE_NAME,
            self::$RELATION_USER_ID,
            self::$ADDRESS_IS_ACTIVE,
            self::$RELATION_CARGO_ADDRESS_ID);

        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("dd",$user_id,self::$ENABLE);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Aktif kargo adresi bulunurken hata meydana geldi : " .$this->getDb()->error);
            }   else{
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                return $singleRow[self::$RELATION_CARGO_ADDRESS_ID];
            }
        }
        else {
            $this->setIsError(true);
            $this->setErrorMessage("Aktif kargo adresi bulunurken hata meydana geldi : " .$this->getDb()->error);
        }
    }


}