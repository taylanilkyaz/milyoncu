<?php

class CategoriesDatabase extends Database {
    public static $CATEGORIES_TABLE_NAME = "kategori";
    public static $CATEGORIES_ID = "id";
    public static $CATEGORIES_NAME = "isim";

    public function getCategoryName($id){
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? ORDER BY %s",
            self::$CATEGORIES_TABLE_NAME,
            self::$CATEGORIES_ID,
            self::$CATEGORIES_ID);
        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$id);
            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Kategori ismi getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return null;
            }   else{
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row;
            }
        }else{
            $this->setIsError(true);
            $this->setErrorMessage("Kategori ismi getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return null;
        }
    }
    public function getCategoryNameNonSeq($id){
        $sql = sprintf("SELECT %s FROM %s WHERE %s = ?",
            self::$CATEGORIES_NAME,
            self::$CATEGORIES_TABLE_NAME,
            self::$CATEGORIES_ID);
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
}