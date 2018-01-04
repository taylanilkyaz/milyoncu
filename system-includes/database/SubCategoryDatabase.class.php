<?php

class SubCategoryDatabase extends Database {
    public static $SUB_CATEGORY_TABLE_NAME = "alt_kategori";
    public static $SUB_CATEGORY_ID = "id";
    public static $SUB_CATEGORY_NAME = "isim";
    public static $SUB_CATEGORY_SUPER_CATEGORY_ID = "üst_id";

    public function getCategoryName($id){
        $sql = sprintf("SELECT %s FROM %s WHERE %s = ?",
            self::$SUB_CATEGORY_NAME,
            self::$SUB_CATEGORY_TABLE_NAME,
            self::$SUB_CATEGORY_ID);
        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$id);
            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Kategori ismi getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }   else{
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['isim'];
            }
        }else{
            $this->setIsError(true);
            $this->setErrorMessage("Kategori ismi getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }

    public function getSubCategoryNameByCategory($id){
        $sql = sprintf("SELECT %s FROM %s WHERE %s = ?",
            self::$SUB_CATEGORY_NAME,
            self::$SUB_CATEGORY_TABLE_NAME,
            self::$SUB_CATEGORY_SUPER_CATEGORY_ID);
        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$id);
            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Kategori ismi getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }   else{
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['isim'];
            }
        }else{
            $this->setIsError(true);
            $this->setErrorMessage("Kategori ismi getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }
    public function getAllSubCategoryForSuper($ust_id)
    {
        $sql = sprintf("SELECT * FROM %s WHERE %s = ?",
            self::$SUB_CATEGORY_TABLE_NAME,
            self::$SUB_CATEGORY_SUPER_CATEGORY_ID);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$ust_id);

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




}