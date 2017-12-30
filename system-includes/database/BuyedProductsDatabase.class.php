<?php

class BuyedProductsDatabase extends Database{
    public static $BUYED_TABLE_NAME = "satın_alınanlar";
    public static $BUYED_ID = "id";
    public static $BUYED_USER_ID = "kullanıcı_id";
    public static $BUYED_PRODUCT_ID = "ürün_id";
    public static $BUYED_ORDER_CODE = "sipariş_kodu";



    /**
     * @param $basketList Product[]
     */
    public function insertBuyedProducts($basketList,$user_id){
        $relationObj = new OrderBuyRelationDatabase();
        $addressRelationObj = new AddressUserRelation();
        $billAddress = $addressRelationObj->getActiveBillAddress($user_id);
        $cargoAddress = $addressRelationObj->getActiveCargoAddress($user_id);
        $count = $relationObj->getRowCount()+1000001;
        $order_code = "B".$count;
        foreach ($basketList as $productObj) {
            /**
             * @var $productObj Product
             */
            for ($i=0 ; $i<$productObj->getCount() ; $i++){
                $sql = sprintf("
                  INSERT INTO %s (%s,%s,%s) VALUES (?,?,?)",
                    self::$BUYED_TABLE_NAME,
                    self::$BUYED_USER_ID,
                    self::$BUYED_PRODUCT_ID,
                    self::$BUYED_ORDER_CODE);
                if ($stmt = $this->getDb()->prepare($sql)){
                    $product_id = $productObj->getId();
                    $stmt->bind_param("dds",
                        $user_id,$product_id,$order_code
                    );
                    if (!$stmt->execute()){
                        $this->setIsError(true);
                        $this->setErrorMessage("Satın alınan ürün eklemede sıkıntı meydana geldi : " .$this->getDb()->error);
                        return $this->getErrorMessage();
                    }
                }
            }
        }
        $relationObj->insertOrderBuyRelation($order_code,$user_id,$billAddress,$cargoAddress);
        return $order_code;

    }

    public function timeFormat($order_date){

        @setlocale(LC_ALL, 'turkish');
        $datetime_strtotime = strtotime($order_date);
        $veritabani_zaman = strftime("%d.%m.%Y, %A, %H.%M",$datetime_strtotime);
        $date    = iconv('latin5','utf-8',$veritabani_zaman);
        return $date;
    }

    public function getAllBuyedProducts($order_code):mysqli_result
    {
        $sql = sprintf("SELECT  prod.*,count(*) AS count 
        FROM %s AS a,%s AS prod WHERE a.%s = ? AND prod.%s = a.%s 
        GROUP BY prod.%s,prod.%s",
            self::$BUYED_TABLE_NAME,
            ProductDatabase::$PRODUCT_TABLE_NAME,
            self::$BUYED_ORDER_CODE,
            ProductDatabase::$PRODUCT_ID,
            self::$BUYED_PRODUCT_ID,
            ProductDatabase::$PRODUCT_NAME,
            ProductDatabase::$PRODUCT_ID);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$order_code);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Satın alınan ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }

            return $stmt->get_result();
        }else{
            $this->setErrorMessage("Satın alınan ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }

    public function getCustomerId($order_code){
        $sql = sprintf("SELECT %s FROM %s WHERE %s=? LIMIT 1",
            self::$BUYED_USER_ID,
            self::$BUYED_TABLE_NAME,
            self::$BUYED_ORDER_CODE);
        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$order_code);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Satın alınan ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }
            $result = $stmt->get_result();
            $singleRow = $result->fetch_assoc();
            return $singleRow['kullanıcı_id'];
        }else{
            $this->setErrorMessage("Satın alınan ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }



}