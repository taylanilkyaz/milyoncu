<?php

class TicketDatabase extends Database {
    public static $TABLE_NAME = "sorular";
    public static $ID = "id";
    public static $USER_ID = "kullanıcı_id";
    public static $TITLE = "başlık";
    public static $DESC = "açıklama";
    public static $ADD_DATETIME = "ekleme_zamanı";
    public static $PARENT_ID = "ana_soru_id";
    public static $IS_PARENT = "ana_soru";
    public static $IS_ACTIVE = "aktif";
    public static $EDIT_DATETIME = "edit_datetime";


    public function addTicketAsParent($user_id,$title,$desc){
        $sql = sprintf("INSERT INTO %s(%s,%s,%s,%s,%s) VALUES(?,?,?,?,?)",
            self::$TABLE_NAME,
            self::$USER_ID,
            self::$TITLE,
            self::$DESC,
            self::$IS_PARENT,
            self::$IS_ACTIVE);

        if($stmt = $this->getDb()->prepare($sql)){
            $is_parent = 1;
            $is_active = 1;
            $stmt->bind_param("dssdd",$user_id,$title,$desc,$is_parent,$is_active);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Parent " . $this->getDb()->error);
                return false;
            }

            return true;
        }

        return false;
    }

    public function addTicketAsChild($user_id,$desc){
        $sql = sprintf("INSERT INTO %s(%s,%s,%s) VALUES(?,?,?)",
            self::$TABLE_NAME,
            self::$USER_ID,
            self::$DESC,
            self::$IS_PARENT);

        if($stmt = $this->getDb()->prepare($sql)){
            $is_parent = 0;
            $stmt->bind_param("dss",$user_id,$desc,$is_parent);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Basketten ürün çıkarma sırasında hata meydana geldi. " . $this->getDb()->error);
                return false;
            }

            return true;
        }

        return false;
    }

    public function getOpenTicketParentForAdmin(){
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? AND %s = ?  ORDER BY %s DESC;",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$IS_ACTIVE,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $is_active = Ticket::$ACTIVE;
            $is_parent = Ticket::$PARENT;
            $stmt->bind_param("dd",$is_active,$is_parent);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'dan parentlar çıkartırlırken hata : " . $this->getDb()->error);
                return null;
            }

            return $stmt->get_result();
        }

        return null;
    }

    public function getOpenTicketParentByUserId($user_id):mysqli_result{
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? AND %s = ? AND %s = ?  ORDER BY %s DESC;",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$USER_ID,
            TicketDatabase::$IS_ACTIVE,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $is_active = Ticket::$ACTIVE;
            $is_parent = Ticket::$PARENT;
            $stmt->bind_param("ddd",$user_id,$is_active,$is_parent);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'dan parentlar çıkartırlırken hata : " . $this->getDb()->error);
                return null;
            }

            return $stmt->get_result();
        }

        return null;
    }

    public function getCloseTicketListForAdmin(){
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? AND %s = ?  ORDER BY %s DESC;",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$IS_ACTIVE,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("dd",Ticket::$NOT_ACTIVE,Ticket::$PARENT);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'dan close parentlar çıkartırlırken hata : " . $this->getDb()->error);
                return false;
            }

            return $stmt->get_result();
        }

        return false;
    }

    public function getCloseTicketListByUserId($userId):mysqli_result{
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? AND %s = ? AND %s = ?  ORDER BY %s DESC;",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$USER_ID,
            TicketDatabase::$IS_ACTIVE,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("ddd",$userId,Ticket::$NOT_ACTIVE,Ticket::$PARENT);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'dan close parentlar çıkartırlırken hata : " . $this->getDb()->error);
                return false;
            }

            return $stmt->get_result();
        }

        return false;
    }

    public function getTicketByIdForAdmin($ticketId){
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? AND %s = ? ORDER BY %s DESC;",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$ID,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("dd",$ticketId,Ticket::$PARENT);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'dan id'ye göre bilgi getirilirken hata : " . $this->getDb()->error);
                return null;
            }

            return $stmt->get_result();
        }

        return null;
    }

    public function getTicketById($userId,$ticketId){
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? AND %s = ? AND %s = ? ORDER BY %s DESC;",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$ID,
            TicketDatabase::$USER_ID,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("ddd",$ticketId,$userId,Ticket::$PARENT);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'dan id'ye göre bilgi getirilirken hata : " . $this->getDb()->error);
                return null;
            }

            return $stmt->get_result();
        }

        return null;
    }



    public function getTicketListByUserIdAndParentId($userId,$parentId) {
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? ORDER BY %s ASC;",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$PARENT_ID,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("d",$parentId);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'dan parentlar çıkartırlırken hata : " . $this->getDb()->error);
                return false;
            }

            return $stmt->get_result();
        }

        return false;
    }

    public function addTicket($userId,$subject,$detail,$isParent,$isActive,$parentId)
    {
        $sql = sprintf("INSERT INTO 
              sorular(%s,%s,%s,%s,%s,%s) VALUES(?,?,?,?,?,?)",
            TicketDatabase::$USER_ID,
            TicketDatabase::$TITLE,
            TicketDatabase::$DESC,
            TicketDatabase::$PARENT_ID,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$IS_ACTIVE);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("dssddd",$userId,$subject,$detail,$parentId,$isParent,$isActive);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'a ürün eklenirken hata : " . $this->getDb()->error);
                return false;
            }

            return true;
        }

        return false;
    }

    public function getLastTicketIdInOpenTickets($userId)
    {
        $sql = sprintf("SELECT %s FROM %s WHERE %s = ? AND %s = ? AND %s = ? ORDER BY %s DESC LIMIT 1",
            TicketDatabase::$ID,
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$USER_ID,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$IS_ACTIVE,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("ddd",$userId,Ticket::$PARENT,Ticket::$ACTIVE);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'da son eklenen id : " . $this->getDb()->error);
                return false;
            }

            return $stmt->get_result();
        }

        return false;
    }

    public function getLastTicketIdInCloseTickets($userId)
    {
        $sql = sprintf("SELECT %s FROM %s WHERE %s = ? AND %s = ? AND %s = ? ORDER BY %s DESC LIMIT 1",
            TicketDatabase::$ID,
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$USER_ID,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$IS_ACTIVE,
            TicketDatabase::$ADD_DATETIME);

        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("ddd",$userId,Ticket::$PARENT,Ticket::$NOT_ACTIVE);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'da son eklenen id : " . $this->getDb()->error);
                return false;
            }

            return $stmt->get_result();
        }

        return false;
    }


    public function closeByParentId($userId, $parentId)
    {
        /**
         * Güvenlik sebebiyle diğer parametreler eklendi.
         */
        $sql = sprintf("UPDATE %s SET %s = ? WHERE %s = ? AND  %s = ? AND %s = ? AND %s= ? AND %s = ?",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$IS_ACTIVE,
            TicketDatabase::$ID,
            TicketDatabase::$USER_ID,
            TicketDatabase::$PARENT_ID,
            TicketDatabase::$IS_PARENT,
            TicketDatabase::$IS_ACTIVE);


        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("dddddd",Ticket::$NOT_ACTIVE,$parentId,$userId,Ticket::$I_AM_AlREADY_PARENT_ID,Ticket::$PARENT,Ticket::$ACTIVE);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'da ticke kapatılırken hata : " . $this->getDb()->error);
                return false;
            }

            return true;
        }

        return false;

    }

    public function openByParentId($userId, $parentId)
    {
        $sql = sprintf("UPDATE %s SET %s = ? WHERE %s = ? AND %s = ? AND %s = ?",
            TicketDatabase::$TABLE_NAME,
            TicketDatabase::$IS_ACTIVE,
            TicketDatabase::$ID,
            TicketDatabase::$USER_ID,
            TicketDatabase::$IS_PARENT);


        if($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("dddd",Ticket::$ACTIVE,$parentId,$userId,Ticket::$PARENT);

            if(!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Ticket table'da ticke kapatılırken hata : " . $this->getDb()->error);
                return false;
            }

            return true;
        }

        return false;

    }




}