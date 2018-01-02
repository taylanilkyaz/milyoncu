<?php

class ProductDatabase extends Database{
    public static $PRODUCT_TABLE_NAME = "ürün";
    public static $PRODUCT_ID = "id";
    public static $PRODUCT_NAME = "isim";
    public static $PRODUCT_PRICE = "fiyat";
    public static $PRODUCT_DESC = "kısa_açıklama";
    public static $PRODUCT_IMAGEPATH = "resim_yeri";
    public static $PRODUCT_COUNT = "count";
    public static $PRODUCT_CATEGORY_ID = "kategori_id";
    public static $PRODUCT_SUB_CATEGORY_ID = "alt_kategori_id";
    public static $PRODUCT_LONG_DESC = "uzun_açıklama";

    /**
     * @param $object Product
     * @return mixed|string
     */
    public function insertProduct($object){
        $name = $object->getName();
        $price = $object->getPrice();
        $short_desc = $object->getShortDesc();
        $path = $object->getImagePath();
        $long_desc = $object->getLongDesc();
        $cat = $object->getCategory();
        $sub_cat = $object->getSubCategory();

        $sql = sprintf("
                CALL urun_insert ( ?, ?, ?, ?, ?, ? ,?);",
            self::$PRODUCT_NAME,
            self::$PRODUCT_PRICE,
            self::$PRODUCT_DESC,
            self::$PRODUCT_IMAGEPATH,
            self::$PRODUCT_CATEGORY_ID,
            self::$PRODUCT_SUB_CATEGORY_ID,
            self::$PRODUCT_LONG_DESC);

        if ($stmt = $this->getDb()->prepare($sql)){

            $stmt->bind_param("sssssdd",
                $name,
                $price,
                $short_desc,
                $path,
                $long_desc,
                $cat,
                $sub_cat);

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ürün ekleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            return "Ürün başarılı bir şekilde eklendi.";
        }
    }

    public function editProduct($productName,$productPrice,$productInfo,$nameOfFile,$productId,$productLongInfo){
        $sql = sprintf("
            CALL urun_update ( ?, ?, ?, ?, ?, ? ,?);",
            self::$PRODUCT_NAME,
            self::$PRODUCT_PRICE,
            self::$PRODUCT_DESC,
            self::$PRODUCT_IMAGEPATH,
            self::$PRODUCT_LONG_DESC,
            self::$PRODUCT_ID
        );
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("sssssd", $productName,$productPrice,$productInfo,$nameOfFile,$productLongInfo,$productId);
            $res = $stmt->execute();
            if(!$res){
                $this->setIsError(true);
                $this->setErrorMessage("Ürün düzenleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            }
        }
        else{
            $this->setIsError(true);
            $this->setErrorMessage("Ürün düzenleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function getProductByName($productName){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$PRODUCT_TABLE_NAME,
            self::$PRODUCT_NAME);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$productName);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = mysqli_fetch_assoc($result);
            return Product::__constructByMysqliRow($row,false);
        }

    }

    public function editProductWithoutImage($productName,$productPrice,$productInfo,$productId,$productLongInfo){
        $sql = sprintf("
            UPDATE %s SET %s=? ,%s=? ,%s=? ,%s=? WHERE %s=?",
            self::$PRODUCT_TABLE_NAME,
            self::$PRODUCT_NAME,
            self::$PRODUCT_PRICE,
            self::$PRODUCT_DESC,
            self::$PRODUCT_LONG_DESC,
            self::$PRODUCT_ID
        );
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("ssssd", $productName,$productPrice,$productInfo,$productLongInfo,$productId);
            $res = $stmt->execute();
            if(!$res){
                $this->setIsError(true);
                $this->setErrorMessage("Ürün düzenleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            }
        }
        else{
            $this->setIsError(true);
            $this->setErrorMessage("Ürün düzenleme sırasında bir hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function listAllProduct(){
        $sql = sprintf("SELECT * FROM %s",self::$PRODUCT_TABLE_NAME);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = array();
            while ($row = mysqli_fetch_assoc($result)){
                array_push($rows,$row);
            }
            echo json_encode($rows);
        }
    }


    public function getAllProducts($category_id)
    {
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            ProductDatabase::$PRODUCT_TABLE_NAME,
            self::$PRODUCT_CATEGORY_ID);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$category_id);
            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }


            $result = $stmt->get_result();

            /**
             * @var $rows Product[]
             */
            $productArr = array();
            while ($row = mysqli_fetch_assoc($result)){
                array_push($productArr,Product::__constructByMysqliRow($row,false));
            }

            return $productArr;
        }else{
            $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }

    public function getAllProductsForSubCategory($subCategoryId){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$PRODUCT_TABLE_NAME,
            self::$PRODUCT_SUB_CATEGORY_ID);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$subCategoryId);
            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }

            $result = $stmt->get_result();

            /**
             * @var $rows Product[]
             */
            $productArr = array();
            while ($row = mysqli_fetch_assoc($result)){
                array_push($productArr,Product::__constructByMysqliRow($row,false));
            }

            return $productArr;
        }else{
            $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }

    public function deleteProduct($productId){
        $sql = sprintf("CALL urun_delete ( ?);",self::$PRODUCT_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$productId);
            $res = $stmt->execute();
            if (!$res){
                $this->setIsError(true);
                $this->setErrorMessage("Ürün silme sırasında bir hata meydana geldi : " .$this->getDb()->error);
            }
        }
        else{
            $this->setIsError(true);
            $this->setErrorMessage("Ürün silme sırasında bir hata meydana geldi : " .$this->getDb()->error);
        }
    }

    public function getAllProductsPrice($small , $large)
    {
        $sql = sprintf("SELECT * FROM %s WHERE %s >= ? AND %s <= ?",
            self::$PRODUCT_TABLE_NAME,
            self::$PRODUCT_PRICE,
            self::$PRODUCT_PRICE);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("dd",$small , $large);
            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }


            $result = $stmt->get_result();

            /**
             * @var $rows Product[]
             */
            $productArr = array();
            while ($row = mysqli_fetch_assoc($result)){
                array_push($productArr,Product::__constructByMysqliRow($row,false));
            }

            return $productArr;
        }else{
            $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }

    public function getAllProductsSearch($search)
    {
        $sql = sprintf("SELECT * FROM %s WHERE %s like '%s' OR %s like '%s' ",
            self::$PRODUCT_TABLE_NAME,
            self::$PRODUCT_NAME,
            "%".$search. "%",
            self::$PRODUCT_DESC,
            "%".$search. "%");

        if($stmt = $this->getDb()->prepare($sql)){
            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }
            $result = $stmt->get_result();

            /**
             * @var $rows Product[]
             */
            $productArr = array();
            while ($row = mysqli_fetch_assoc($result)){
                array_push($productArr,Product::__constructByMysqliRow($row,false));
            }

            return $productArr;
        }else{
            $this->setErrorMessage("Basketteki ürünleri listeleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }




}