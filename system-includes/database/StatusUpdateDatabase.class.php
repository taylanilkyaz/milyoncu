<?php

class StatusUpdateDatabase extends Database{
    public static $STATUS_UPDATE_TABLE_NAME = "status_update_time";
    public static $STATUS_UPDATE_ID = "id";
    public static $STATUS_UPDATE_ORDER_CODE = "order_code";
    public static $STATUS_UPDATE_ORDER_STATUS = "order_status";
    public static $STATUS_UPDATE_ADD_TIME = "add_time";

    public function getStatusUpdateTimes($order_code){
        $rows = array();
        $sql = sprintf("SELECT %s FROM %s WHERE %s=? ORDER BY %s ASC",
            self::$STATUS_UPDATE_ADD_TIME,
            self::$STATUS_UPDATE_TABLE_NAME,
            self::$STATUS_UPDATE_ORDER_CODE,
            self::$STATUS_UPDATE_ORDER_STATUS);

        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$order_code);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Status Update getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                while ($r = mysqli_fetch_assoc($result)){
                    $rows[]=$r;
                }
            }
        }
        return $rows;
    }

    public function ifStatusExists($order_code,$new_status){
        $sql = sprintf("DELETE FROM %s where %s=? AND %s=?",
            self::$STATUS_UPDATE_TABLE_NAME,
            self::$STATUS_UPDATE_ORDER_CODE,
            self::$STATUS_UPDATE_ORDER_STATUS);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("sd",$order_code,$new_status);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Status Update eklemede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }
    }

    public function updateStatus($order_code,$new_status){
        $this->ifStatusExists($order_code,$new_status);
        $sql = sprintf("INSERT INTO %s (%s,%s) VALUES (?,?)",
            self::$STATUS_UPDATE_TABLE_NAME,
            self::$STATUS_UPDATE_ORDER_CODE,
            self::$STATUS_UPDATE_ORDER_STATUS);

        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("sd",$order_code,$new_status);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Status Update eklemede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
        }
    }

    public function getOrderStatus($order_code){
        $sql = sprintf("SELECT %s FROM %s WHERE %s=?",
            self::$ORDER_BUY_RELATION_ORDER_STATUS,
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",
                $order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                return $singleRow['order_status'];
            }
        }
    }

    public function getAddDate($order_code){
        $sql = sprintf("SELECT %s FROM %s WHERE %s=?",
            self::$ORDER_BUY_RELATION_ADD_TIME,
            self::$ORDER_BUY_RELATION_TABLE_NAME,
            self::$ORDER_BUY_RELATION_ORDER_CODE);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",
                $order_code
            );

            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Order Buy Relation getirmede hata meydana geldi : " .$this->getDb()->error);
                return $this->getErrorMessage();
            }
            else{
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                return $singleRow['add_time'];
            }
        }
    }

}