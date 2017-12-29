<?php

class ActivationDatabase extends Database{
    public static $ACTIVATION_TABLE_NAME = "aktivasyon_kodu";
    public static $ACTIVATION_ID = "id";
    public static $ACTIVATION_USER_ID = "gönderim_zamanı";
    public static $ACTIVATION_CODE= "aktivasyon_kodu";


   public function createActivationCode($e_mail,$activation_code){
        $user_obj = new UserDatabase();
        $user_id = $user_obj->get_user_id_by_mail($e_mail);
        $this->insertActivationDatabase($user_id,$activation_code);
   }

   public function insertActivationDatabase($user_id,$activation_code){
       $sql = sprintf("INSERT %s (%s ,%s) values(?,?)",
                            self::$ACTIVATION_TABLE_NAME,
                            self::$ACTIVATION_CODE,
                            self::$ACTIVATION_USER_ID
       );
       if($stmt = $this->getDb()->prepare($sql)){
           $stmt->bind_param("dd",$activation_code,$user_id);

           if(!$stmt->execute()){
               $this->setIsError(true);
               $this->setErrorMessage("Aktivasyon veritabanına eklemede hata meydana geldi: " . $this->getDb()->error);
               return null;
           }

       }else{
           $this->setErrorMessage("Aktivasyon veritabanına eklemede hata meydana geldi: " . $this->getDb()->error);
           return null;
       }
   }

   public function getActivationCodeByUserId($user_id) {
       $sql = sprintf("SELECT * FROM %s where %s=?",self::$ACTIVATION_TABLE_NAME,self::$ACTIVATION_USER_ID);
       if($stmt = $this->getDb()->prepare($sql)){
           $stmt->bind_param("d",$user_id);

           if(!$stmt->execute()){
               $this->setIsError(true);
               $this->setErrorMessage("Aktivasyon veritabanı sorgusunda hata meydana geldi: " . $this->getDb()->error);
               return null;
           }
           $row = mysqli_fetch_assoc($stmt->get_result());

       }else{
           $this->setErrorMessage("Aktivasyon veritabanı sorgusunda hata meydana geldi: " . $this->getDb()->error);
           return null;
       }
           return $row['activation_code'];
   }

    public function deleteRow($user_id){
       $sql = sprintf("DELETE FROM %s where %s=?",self::$ACTIVATION_TABLE_NAME,self::$ACTIVATION_USER_ID);
        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$user_id);
            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Aktivasyon veritabanı sorgusunda hata meydana geldi: " . $this->getDb()->error);
            }
        }else{
            $this->setErrorMessage("Aktivasyon veritabanı sorgusunda hata meydana geldi: " . $this->getDb()->error);
        }
    }
}