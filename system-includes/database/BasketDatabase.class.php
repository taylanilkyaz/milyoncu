<?php

class BasketDatabase extends Database{

    public static $BASKET_TABLE_NAME = "sepet";
    public static $BASKET_ID = "id";
    public static $BASKET_PRODUCT_ID = "ürün_id";
    public static $BASKET_USER_ID = "kullanıcı_id";
    public static $BASKET_ADD_DATE = "işlem_zamanı";

    public function addBasketByProductName($user_id,$productName){

        $sql = sprintf("
      INSERT INTO sepet (%s,%s)
      SELECT  a.%s, ?
      FROM    %s AS a
      WHERE   a.%s = ?",self::$BASKET_PRODUCT_ID,self::$BASKET_USER_ID,ProductDatabase::$PRODUCT_ID,ProductDatabase::$PRODUCT_TABLE_NAME,ProductDatabase::$PRODUCT_NAME);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("ss",$user_id,$productName);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Baskete ürün ekleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }

            return true;
        }
    }

    public function deleteLastDateBasketByName($user_id,$productName){
        $sql=sprintf("
    DELETE FROM %s WHERE %s IN 
    (
    
	  SELECT %s FROM 
	    (
	    	SELECT b.%s 
	    	FROM %s AS b,%s AS p 
	    	WHERE b.%s = ?
	    	AND p.%s = ? 
	    	AND p.%s = b.%s 
	    	ORDER BY  b.%s 
	    	DESC LIMIT 1
	    ) a
	)
	
	",
            BasketDatabase::$BASKET_TABLE_NAME,
            BasketDatabase::$BASKET_ID,
            BasketDatabase::$BASKET_ID,
            BasketDatabase::$BASKET_ID,
            BasketDatabase::$BASKET_TABLE_NAME,
            ProductDatabase::$PRODUCT_TABLE_NAME,
            BasketDatabase::$BASKET_USER_ID,
            ProductDatabase::$PRODUCT_NAME,
            ProductDatabase::$PRODUCT_ID,
            BasketDatabase::$BASKET_PRODUCT_ID,
            BasketDatabase::$BASKET_ADD_DATE);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("ds",$user_id,$productName);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basketten ürün çıkarma sırasında hata meydana geldi. " . $this->getDb()->error);
                return false;
            }

            return true;
        }


    }

    public function getAllBasket($user_id)
    {
        $sql = sprintf("SELECT  prod.*,count(*) AS count 
        FROM %s AS a,%s AS prod WHERE a.%s = ? AND prod.%s = a.%s 
        GROUP BY prod.%s,prod.%s",
            BasketDatabase::$BASKET_TABLE_NAME,
            ProductDatabase::$PRODUCT_TABLE_NAME,
            BasketDatabase::$BASKET_USER_ID,
            ProductDatabase::$PRODUCT_ID,
            BasketDatabase::$BASKET_PRODUCT_ID,
            ProductDatabase::$PRODUCT_NAME,
            ProductDatabase::$PRODUCT_ID);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$user_id);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }

            return $stmt->get_result();
        }else{
            $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }

    public function deleteProductFromBasket($userId,$product_name){
        $sql = sprintf("delete from %s where %s = (select %s from %s where %s =?) AND %s=?",
            self::$BASKET_TABLE_NAME,
            self::$BASKET_PRODUCT_ID,
            ProductDatabase::$PRODUCT_ID,
            ProductDatabase::$PRODUCT_TABLE_NAME,
            ProductDatabase::$PRODUCT_NAME,
            self::$BASKET_USER_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("sd",$product_name,$userId);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basket boşaltılırken hata meydana geldi : " .$this->getDb()->error);
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Basket boşaltılırken hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function emptyBasket($userId){
        $sql = sprintf("DELETE FROM %s WHERE %s=?",
            self::$BASKET_TABLE_NAME,
            self::$BASKET_USER_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$userId);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basket boşaltılırken hata meydana geldi : " .$this->getDb()->error);
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Basket boşaltılırken hata meydana geldi : " .$this->getDb()->error);
        }

    }


}