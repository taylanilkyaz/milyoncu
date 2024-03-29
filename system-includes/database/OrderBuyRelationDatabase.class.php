<?php

class OrderBuyRelationDatabase extends Database{
    public static $ORDER_BUY_RELATION_TABLE_NAME = "sipariş_ilişkileri";
    public static $ORDER_BUY_RELATION_ID = "id";
    public static $ORDER_BUY_RELATION_ORDER_CODE = "sipariş_kodu";
    public static $ORDER_BUY_RELATION_ADD_TIME = "ekleme_zamanı";
    public static $ORDER_BUY_RELATION_UPDATE_TIME = "güncelleme_zamanı";
    public static $ORDER_BUY_RELATION_ORDER_STATUS = "sipariş_durumu";
    public static $ORDER_BUY_RELATION_USER_ID = "kullanıcı_id";
    public static $ORDER_BUY_RELATION_BILL_ADDRESS_ID = "fatura_adres_id";
    public static $ORDER_BUY_RELATION_CARGO_ADDRESS_ID = "kargo_adres_id";
    public static $ORDER_BUY_RELATION_CARGO_NO = "kargo_numarası";
    public static $ORDER_BUY_RELATION_CARGO_COM = "kargo_sirketi";


    public function getRowCount(){
        $sql = sprintf("SELECT * FROM %s",self::$ORDER_BUY_RELATION_TABLE_NAME);
        if ($stmt = $this->getDb()->prepare($sql)){
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Adres ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            $result = $stmt->get_result();
            return $result->num_rows;
        }
    }

    public function updateStatus($order_code,$new_status){
        $sql = sprintf("UPDATE %s SET %s=? WHERE %s=?",
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_STATUS,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){

            $stmt->bind_param("ds",
                $new_status,$order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation güncellemede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }
        $obj = new StatusUpdateDatabase();
        $obj->updateStatus($order_code,$new_status);
    }

    public function insertOrderBuyRelation($order_code,$user_id,$bill_address_id,$cargo_address_id,$cargo_com){
        $sql = sprintf("
                  INSERT INTO %s (%s,%s,%s,%s,%s) VALUES (?,?,?,?,?)",
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_CODE,
            self::$ORDER_BUY_RELATION_USER_ID,
            self::$ORDER_BUY_RELATION_BILL_ADDRESS_ID,
            self::$ORDER_BUY_RELATION_CARGO_ADDRESS_ID,
            self::$ORDER_BUY_RELATION_CARGO_COM
        );

        if ($stmt = $this->getDb()->prepare($sql)){

            $stmt->bind_param("sdddd",
               $order_code,$user_id,$bill_address_id,$cargo_address_id,$cargo_com
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation eklemede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }

        }
    }

    public function getAllOrderCodes(){
        $rows = array();
        $sql = sprintf("SELECT %s,%s FROM %s",
            self::$ORDER_BUY_RELATION_ORDER_CODE,
            self::$ORDER_BUY_RELATION_CARGO_NO,
            self::$ORDER_BUY_RELATION_TABLE_NAME
            );
        if ($stmt = $this->getDb()->prepare($sql)){
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                while ($r = mysqli_fetch_assoc($result)){
                    $rows[]=$r;
                }
            }
        }
        return $rows;
    }

    public function getAllOrderRelations(){
        $rows = array();
        $sql = sprintf("SELECT * FROM %s",
            self::$ORDER_BUY_RELATION_TABLE_NAME
        );
        if ($stmt = $this->getDb()->prepare($sql)){
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                while ($r = mysqli_fetch_assoc($result)){
                    $rows[]=$r;
                }
            }
        }
        return json_encode($rows,JSON_UNESCAPED_UNICODE);
    }

    public function getOrderStatus($order_code){
        $sql = sprintf("SELECT %s FROM %s WHERE %s=?",
            self::$ORDER_BUY_RELATION_ORDER_STATUS,
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",
                $order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                return $singleRow['sipariş_durumu'];
            }
        }
    }

    public function getAllOrdersForUser($user_id){
        $rows =[];
        $sql = sprintf("SELECT %s,%s,%s,%s,%s FROM %s WHERE %s=? ORDER BY %s DESC ",
            self::$ORDER_BUY_RELATION_ORDER_CODE,
            self::$ORDER_BUY_RELATION_USER_ID,
            self::$ORDER_BUY_RELATION_ADD_TIME,
            self::$ORDER_BUY_RELATION_ORDER_STATUS,
            self::$ORDER_BUY_RELATION_CARGO_NO,
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_USER_ID,
            self::$ORDER_BUY_RELATION_ADD_TIME);

        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$user_id);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                while ($r = mysqli_fetch_assoc($result)){
                    $rows[]=$r;
                }
            }
        }
        return $rows;

    }

    public function getAddDate($order_code){
        $sql = sprintf("SELECT %s FROM %s WHERE %s=?",
            self::$ORDER_BUY_RELATION_ADD_TIME,
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",
                $order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                return $singleRow['ekleme_zamanı'];
            }
        }
    }

    public function getBillAddress($order_code){
        $obj = new AddressDatabase();
        $sql = sprintf("SELECT %s FROM %s WHERE %s=?",
            self::$ORDER_BUY_RELATION_BILL_ADDRESS_ID,
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",
                $order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                $bill_address_id = $singleRow[self::$ORDER_BUY_RELATION_BILL_ADDRESS_ID];
                return $obj->getBillAddressByID($bill_address_id);
            }
        }
    }

    public function getCargoAddress($order_code){
        $obj = new AddressDatabase();
        $sql = sprintf("SELECT %s FROM %s WHERE %s=?",
            self::$ORDER_BUY_RELATION_CARGO_ADDRESS_ID,
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",
                $order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                $cargo_address_id = $singleRow[self::$ORDER_BUY_RELATION_CARGO_ADDRESS_ID];
                return $obj->getCargoAddressByID($cargo_address_id);
            }
        }
    }

    public function insertCargoNo($order_code, $cargo_no){
        $sql = sprintf("UPDATE %s SET %s=? WHERE %s=?",
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_CARGO_NO,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("ss",
                $cargo_no,
                $order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation kargo adresi eklemede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Order Buy Relation kargo adresi eklemede hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

    public function getCargoNo($order_code){
        $sql = sprintf("SELECT %s FROM %s WHERE %s=?",
            self::$ORDER_BUY_RELATION_CARGO_NO,
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",
                $order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation kargo adresi eklemede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }   else{
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row[self::$ORDER_BUY_RELATION_CARGO_NO];
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Order Buy Relation kargo adresi eklemede hata meydana geldi : " .$this->getDb()->error);
            return $this->getErrorMessage();
        }
    }

}