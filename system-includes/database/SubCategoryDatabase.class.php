<?php

class SubCategoryDatabase extends Database {
    public static $SUB_CATEGORY_TABLE_NAME = "sub_categories";
    public static $SUB_CATEGORY_ID = "id";
    public static $SUB_CATEGORY_NAME = "name";
    public static $SUB_CATEGORY_SUPER_CATEGORY_ID = "super_category_id";

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
                return $row['name'];
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
                return $row['name'];
            }
        }else{
            $this->setIsError(true);
            $this->setErrorMessage("Kategori ismi getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }




}