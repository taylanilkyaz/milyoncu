<?php

class AddressDatabase extends Database{
    public static $CARGO_ADDRESS_TABLE_NAME = "kargo_adresi";
    public static $BILL_ADDRESS_TABLE_NAME = "fatura_adresi";
    public static $ADDRESS_ID ="id";
    public static $ADDRESS_NAME = "adres_tipi";
    public static $ADDRESS_USER_FIRSTNAME = "ad";
    public static $ADDRESS_USER_LASTNAME = "soyad";
    public static $ADDRESS_COUNTRY  =   "ülke";
    public static $ADDRESS_CITY =   "il";
    public static $ADDRESS_COUNTY   =   "ilçe";
    public static $ADDRESS_DISTRICT =   "mahalle";
    public static $ADDRESS_BILLING_ADDRESS  =   "açık_adres";
    public static $ADDRESS_CARGO_ADDRESS = "açık_adres";
    public static $ADDRESS_POSTCODE =   "postakodu";
    public static $ADDRESS_PHONE_NUMBER =   "telefon_numarası";


    /**
     * @param $object Address
     * @return mixed|string
     */
    public function insertBillAddress($object){
        $obj = new AddressUserRelation();
        $sql = sprintf("
                INSERT INTO %s (%s, %s ,%s , %s, %s, %s, %s, %s, %s, %s)
                VALUES (?,?,?,?,?,?,?,?,?,?)",
            self::$BILL_ADDRESS_TABLE_NAME,
            self::$ADDRESS_NAME,
            self::$ADDRESS_USER_FIRSTNAME,
            self::$ADDRESS_USER_LASTNAME,
            self::$ADDRESS_COUNTRY,
            self::$ADDRESS_COUNTY,
            self::$ADDRESS_CITY,
            self::$ADDRESS_DISTRICT,
            self::$ADDRESS_BILLING_ADDRESS,
            self::$ADDRESS_POSTCODE,
            self::$ADDRESS_PHONE_NUMBER);

        if ($stmt = $this->getDb()->prepare($sql)){
            $addressName    =   $object->getAddressName();
            $firstName      =   $object->getFirstName();
            $lastName       =   $object->getLastName();
            $ülke        =   $object->getCountry();
            $ilçe         =   $object->getCounty();
            $il           =   $object->getCity();
            $district       =   $object->getDistrict();
            $billAddress    =   $object->getBillingAddress();
            $postCode       =   $object->getPostCode();
            $telefon_numarası    =   $object->getPhoneNumber();

            $stmt->bind_param("ssssssssds",
                $addressName,
                $firstName,
                $lastName,
                $ülke,
                $ilçe,
                $il,
                $district,
                $billAddress,
                $postCode,
                $telefon_numarası
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Adres ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            //gelen adresi database'e ekledik eklenene adresin id'sini bulmalıyız
            $lastID = $this->getTheLatestBillIDs();
            $obj->createAddressUserRelation($lastID,null,$_SESSION['id']);
            return json_encode($this->getLastBillRow($lastID));
        }
    }

    public function getTheLatestBillIDs(){
        $sql = sprintf("SELECT * FROM %s ORDER BY %s DESC LIMIT 1",
            self::$BILL_ADDRESS_TABLE_NAME,self::$ADDRESS_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->execute();
            $result = $stmt->get_result();
            $singleRow = $result->fetch_assoc();
            return $singleRow['id'];
        }
        else {
            $this->setIsError(true);
            $this->setErrorMessage("Son Id bulunurken hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function getLastBillRow($id){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$BILL_ADDRESS_TABLE_NAME,
            self::$ADDRESS_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $singleRow = $result->fetch_assoc();
            return $singleRow;
        }
        else {
            $this->setIsError(true);
            $this->setErrorMessage("Son Id bulunurken hata meydana geldi : " .$this->getDb()->error);
        }
    }

    /**
     * @param $object Address
     * @return mixed|string
     */
    public function insertCargoAddress($object){
        $obj = new AddressUserRelation();
        $sql = sprintf("
                INSERT INTO %s (%s, %s ,%s , %s, %s, %s, %s, %s, %s, %s)
                VALUES (?,?,?,?,?,?,?,?,?,?)",
            self::$CARGO_ADDRESS_TABLE_NAME,
            self::$ADDRESS_NAME,
            self::$ADDRESS_USER_FIRSTNAME,
            self::$ADDRESS_USER_LASTNAME,
            self::$ADDRESS_COUNTRY,
            self::$ADDRESS_COUNTY,
            self::$ADDRESS_CITY,
            self::$ADDRESS_DISTRICT,
            self::$ADDRESS_CARGO_ADDRESS,
            self::$ADDRESS_POSTCODE,
            self::$ADDRESS_PHONE_NUMBER);

        if ($stmt = $this->getDb()->prepare($sql)){
            $addressName    =   $object->getAddressName();
            $firstName      =   $object->getFirstName();
            $lastName       =   $object->getLastName();
            $ülke        =   $object->getCountry();
            $ilçe         =   $object->getCounty();
            $il           =   $object->getCity();
            $district       =   $object->getDistrict();
            $açık_adres    =   $object->getCargoAddress();
            $postCode       =   $object->getPostCode();
            $telefon_numarası    =   $object->getPhoneNumber();

            $stmt->bind_param("ssssssssds",
                $addressName,
                $firstName,
                $lastName,
                $ülke,
                $ilçe,
                $il,
                $district,
                $açık_adres,
                $postCode,
                $telefon_numarası
                );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Adres ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            //gelen adresi database'e ekledik eklenene adresin id'sini bulmalıyız
            $lastID = $this->getTheLatestCargoIDs();
            $obj->createAddressUserRelation(null,$lastID,$_SESSION['id']);
            return json_encode($this->getLastCargoRow($lastID));
        }
    }

    public function getLastCargoRow($id){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$CARGO_ADDRESS_TABLE_NAME,
            self::$ADDRESS_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $singleRow = $result->fetch_assoc();
            return $singleRow;
        }
        else {
            $this->setIsError(true);
            $this->setErrorMessage("Son Id bulunurken hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function getTheLatestCargoIDs(){
        $sql = sprintf("SELECT * FROM %s ORDER BY %s DESC LIMIT 1",
            self::$CARGO_ADDRESS_TABLE_NAME,self::$ADDRESS_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->execute();
            $result = $stmt->get_result();
            $singleRow = $result->fetch_assoc();
            return $singleRow['id'];
        }
        else {
            $this->setIsError(true);
            $this->setErrorMessage("Son Id bulunurken hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function getBillAddress($userID){
        $sql = sprintf("SELECT *
        FROM %s a
            JOIN %s b ON 
            b.%s=? and 
            a.%s=b.%s 
            and b.%s is not null
				and b.%s=%s;  ",
            self::$BILL_ADDRESS_TABLE_NAME,
            AddressUserRelation::$RELATION_TABLE_NAME,
            AddressUserRelation::$RELATION_USER_ID,
            self::$ADDRESS_ID,
            AddressUserRelation::$RELATION_BILL_ADDRESS_ID,
            AddressUserRelation::$RELATION_BILL_ADDRESS_ID,
            AddressUserRelation::$ADDRESS_IS_ACTIVE,
            AddressUserRelation::$ENABLE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$userID);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                $rows = $result->fetch_assoc();
                return $rows['açık_adres']." ".$rows['ilçe']." ".$rows['il']." ".$rows['ülke']." ".$rows['ad']." ".$rows['soyad']." - ".$rows['telefon_numarası'];
            }
        }
    }

    public function getCargoAddress($userID){
        $sql = sprintf("SELECT *
        FROM %s a
            JOIN %s b ON 
            b.%s=? and 
            a.%s=b.%s 
            and b.%s is not null
				and b.%s=%s;  ",
            self::$CARGO_ADDRESS_TABLE_NAME,
            AddressUserRelation::$RELATION_TABLE_NAME,
            AddressUserRelation::$RELATION_USER_ID,
            self::$ADDRESS_ID,
            AddressUserRelation::$RELATION_CARGO_ADDRESS_ID,
            AddressUserRelation::$RELATION_CARGO_ADDRESS_ID,
            AddressUserRelation::$ADDRESS_IS_ACTIVE,
            AddressUserRelation::$ENABLE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$userID);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                $rows = $result->fetch_assoc();
                return $rows['açık_adres']." ".$rows['ilçe']." ".$rows['il']." ".$rows['ülke']." ".$rows['ad']." ".$rows['soyad']." - ".$rows['telefon_numarası'];
            }
        }
    }

    public function getBillAddressByID($billID){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$BILL_ADDRESS_TABLE_NAME,
            self::$ADDRESS_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$billID);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                $rows = $result->fetch_assoc();
                return $rows['açık_adres']." ".$rows['ilçe']." ".$rows['il']." ".$rows['ülke']." - ".$rows['telefon_numarası'];
            }
        }
    }

    public function getCargoAddressByID($billID){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$CARGO_ADDRESS_TABLE_NAME,
            self::$ADDRESS_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$billID);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                $rows = $result->fetch_assoc();
                return $rows['açık_adres']." ".$rows['ilçe']." ".$rows['il']." ".$rows['ülke']." - ".$rows['telefon_numarası'];
            }
        }
    }

    public function getAllCargoAddress($userID){
        $sql = sprintf("SELECT *
        FROM %s b
            JOIN %s a ON 
            a.%s=? and 
            a.%s=b.%s 
            and a.%s is not null            ",
            self::$CARGO_ADDRESS_TABLE_NAME,
            AddressUserRelation::$RELATION_TABLE_NAME,
            AddressUserRelation::$RELATION_USER_ID,
            AddressUserRelation::$RELATION_CARGO_ADDRESS_ID,
            self::$ADDRESS_ID,
            AddressUserRelation::$RELATION_CARGO_ADDRESS_ID
        );
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$userID);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                while ($r = mysqli_fetch_assoc($result)){
                    $rows[]=$r;
                }
                return $rows;
            }
        }
    }

    public function getAllBillAddress($userID){
        $sql = sprintf("SELECT *
        FROM %s b
            JOIN %s a ON 
            a.%s=? and 
            a.%s=b.%s 
            and a.%s is not null            ",
            self::$BILL_ADDRESS_TABLE_NAME,
            AddressUserRelation::$RELATION_TABLE_NAME,
            AddressUserRelation::$RELATION_USER_ID,
            AddressUserRelation::$RELATION_BILL_ADDRESS_ID,
            self::$ADDRESS_ID,
            AddressUserRelation::$RELATION_BILL_ADDRESS_ID
        );
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$userID);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                while ($r = mysqli_fetch_assoc($result)){
                    $rows[]=$r;
                }
                return $rows;
            }
        }
    }


}