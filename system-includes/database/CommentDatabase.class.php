<?php

class CommentDatabase extends Database
{

    public static $COMMENT_TABLE_NAME = "ürün_yorumları";
    public static $COMMENT_ID = "id";
    public static $COMMENT_PRODUCT_ID = "ürün_id";
    public static $COMMENT_USER_ID = "kullanıcı_id";
    public static $COMMENT_TITLE = "başlık";
    public static $COMMENT_CONTENT = "içerik";
    public static $COMMENT_ADD_TIME = "ekleme_zamanı";
    public static $COMMENT_RATE = "puan";

    public function getRateArray($product_id)
    {
        $arr = [];
        for ($i = 1; $i < 6; $i++) {
            $sql = sprintf("SELECT COUNT(*) FROM %s WHERE %s=? AND %s=?",
                self::$COMMENT_TABLE_NAME,
                self::$COMMENT_PRODUCT_ID,
                self::$COMMENT_RATE);
            if ($stmt = $this->getDb()->prepare($sql)) {
                $stmt->bind_param("dd", $product_id, $i);

                if ($stmt->execute()) {
                    //işlem başarılı
                    $result = $stmt->get_result();
                    $singleRow = $result->fetch_assoc();
                    array_push($arr, $singleRow['COUNT(*)']);
                } else {
                    $this->setIsError(true);
                    $this->setErrorMessage("Yorum ekleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                }
            } else {
                $this->setIsError(true);
                $this->setErrorMessage("Yorum ekleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }
        }
        return $arr;
    }

    public function getTotalCommentCount($product_id){
        $sql = sprintf("SELECT COUNT(*) FROM %s WHERE %s=?",
            self::$COMMENT_TABLE_NAME,
            self::$COMMENT_PRODUCT_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d", $product_id);
            if ($stmt->execute()) {
                //işlem başarılı
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                return $singleRow['COUNT(*)'];
            } else {
                $this->setIsError(true);
                $this->setErrorMessage("Yorum ekleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Yorum ekleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
        }

    }


    /**
     * @param $commentModelObj Comment
     * @return bool
     */
    public function insertComment($commentModelObj)
    {
        $product_id = $commentModelObj->getProductİd();
        $user_id = $commentModelObj->getUserİd();
        $title = $commentModelObj->getTitle();
        $content = $commentModelObj->getContent();
        $rate = $commentModelObj->getRating();

        $sql = sprintf("
            CALL yorumlar_insert ( ?, ?, ?, ?, ?);",
            self::$COMMENT_PRODUCT_ID,
            self::$COMMENT_USER_ID,
            self::$COMMENT_TITLE,
            self::$COMMENT_CONTENT,
            self::$COMMENT_RATE);

        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("ddssd", $product_id, $user_id, $title, $content, $rate);

            if ($stmt->execute()) {
                //işlem başarılı

            } else {
                $this->setIsError(true);
                $this->setErrorMessage("Yorum ekleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }

            return true;
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Yorum ekleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }

    public function getAllCommentsForProduct($product_id)
    {
        $sql = sprintf("SELECT * FROM %s WHERE %s=? ORDER BY %s DESC",
            self::$COMMENT_TABLE_NAME,
            self::$COMMENT_PRODUCT_ID,
            self::$COMMENT_ADD_TIME);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d", $product_id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $rows = array();
                while ($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
                }
                return $rows;

            } else {
                $this->setIsError(true);
                $this->setErrorMessage("Yorum getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }

            return true;
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Yorum getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }

    public function deleteComment($comment_id){
        $sql = sprintf("CALL yorumlar_delete ( ?);",
            self::$COMMENT_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d", $comment_id);
            if ($stmt->execute()) {
                return true;

            } else {
                $this->setIsError(true);
                $this->setErrorMessage("Yorum getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }

            return true;
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Yorum getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }

    public function getUserIDForComment($comment_id)
    {
        $sql = sprintf("SELECT %s FROM %s WHERE %s=? ",
            self::$COMMENT_USER_ID,
            self::$COMMENT_TABLE_NAME,
            self::$COMMENT_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d", $comment_id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $row = mysqli_fetch_assoc($result);
                return $row[self::$COMMENT_USER_ID];

            } else {
                $this->setIsError(true);
                $this->setErrorMessage("Yorum getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }

            return true;
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Yorum getirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }

}