<?php

class ExchangeRateDatabase extends Database{

    public static $EXCHANGE_RATE_TABLE_NAME = "exchange_rate";
    public static $EXCHANGE_RATE_ID = "id";
    public static $EXCHANGE_RATE_DOLLAR_TO_TRY = "dollar_to_try";


    public function updateExchangeRate(){
        $id=1;
        $new_rate = $this->getTheCurrentRate();
        $sql = sprintf("
          UPDATE %s SET %s=? WHERE %s=?",
        self::$EXCHANGE_RATE_TABLE_NAME,
        self::$EXCHANGE_RATE_DOLLAR_TO_TRY,
        self::$EXCHANGE_RATE_ID
        );
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("dd", $new_rate,$id);
            $res = $stmt->execute();
            $this->getExchangeRate();
            if(!$res){
                $this->setIsError(true);
                $this->setErrorMessage("Kur oranı güncelleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            }
        }
        else{
            $this->setIsError(true);
            $this->setErrorMessage("Kur oranı güncelleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function getExchangeRate(){
        $id=1;
        $sql = sprintf("
          SELECT %s FROM %s WHERE %s=?",
            self::$EXCHANGE_RATE_DOLLAR_TO_TRY,
            self::$EXCHANGE_RATE_TABLE_NAME,
            self::$EXCHANGE_RATE_ID
        );
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d", $id);
            $res = $stmt->execute();
            $result = $stmt->get_result();
            $singleRow = $result->fetch_assoc();
            if(!$res){
                $this->setIsError(true);
                $this->setErrorMessage("Kur oranı güncelleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            }
            return $singleRow["dollar_to_try"];
        }
        else{
            $this->setIsError(true);
            $this->setErrorMessage("Kur oranı güncelleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function getTheCurrentRate(){
        $json_object = json_decode(file_get_contents("http://api.fixer.io/latest?base=USD&symbols=TRY"));
        $priceInTRY = $json_object->rates->TRY;
        return $priceInTRY;
    }

}