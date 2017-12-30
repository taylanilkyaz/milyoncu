<?php

class CargoCompanyDatabase extends Database{
    public static $CARGO_COMPANY_TABLE_NAME = "kargo_şirketleri";
    public static $CARGO_COMPANY_ID = "id";
    public static $CARGO_COMPANY_TIME = "süre";
    public static $CARGO_COMPANY_PRICE= "fiyat";

    public function getAllCargoCompany()
    {
        $sql = sprintf("SELECT * FROM %s",
            self::$CARGO_COMPANY_TABLE_NAME);

        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = array();
            while ($row = mysqli_fetch_assoc($result)){
                array_push($rows,$row);
            }
            return $rows;
        }
    }

}