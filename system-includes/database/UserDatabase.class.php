<?php

class UserDatabase extends Database
{
    public static $USER_TABLE_NAME = "kullanıcılar";
    public static $USER_ID = "id";
    public static $USER_E_MAIL = "e_mail";
    public static $USER_TC = "tc";
    public static $USER_PASSWORD = "şifre";
    public static $USER_FIRST_NAME = "ad";
    public static $USER_LAST_NAME = "soyad";
    public static $USER_ADD_DATETIME = "ekleme_zamanı";
    public static $USER_PHONE_NUMBER = "telefon_numarası";
    public static $USER_IS_ACTIVE = "aktif";
    public static $USER_IS_ADMIN = "admin";

    /*
     * get fonksiyonları
     */

    public function getUserByName($searchKey){
        $param = "%{$searchKey}%";
        $arr = [];
        $sql = sprintf("SELECT * FROM %s WHERE %s LIKE ? ORDER BY %s DESC ",
            self::$USER_TABLE_NAME,
            self::$USER_FIRST_NAME,
            self::$USER_FIRST_NAME);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$param);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }   else{
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()){
                    array_push($arr,User::__constructByMysqliRow($row));
                }
                return $arr;
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }

    public function getUserByLastName($searchKey){
        $param = "%{$searchKey}%";
        $arr = [];
        $sql = sprintf("SELECT * FROM %s WHERE %s LIKE ?  ORDER BY %s DESC ",
            self::$USER_TABLE_NAME,
            self::$USER_LAST_NAME,
            self::$USER_LAST_NAME);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$param);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }   else{
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()){
                    array_push($arr,User::__constructByMysqliRow($row));
                }
                return $arr;
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }

    public function getUserByEmail($searchKey){
        $param = "%{$searchKey}%";
        $arr = [];
        $sql = sprintf("SELECT * FROM %s WHERE %s LIKE ?  ORDER BY %s DESC ",
            self::$USER_TABLE_NAME,
            self::$USER_E_MAIL,
            self::$USER_E_MAIL);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$param);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }   else{
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()){
                    array_push($arr,User::__constructByMysqliRow($row));
                }
                return $arr;
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }

    public function getUserByPhone($searchKey){
        $param = "%{$searchKey}%";
        $arr = [];
        $sql = sprintf("SELECT * FROM %s WHERE %s LIKE ?  ORDER BY %s DESC ",
            self::$USER_TABLE_NAME,
            self::$USER_PHONE_NUMBER,
            self::$USER_PHONE_NUMBER);
        if ($stmt = $this->getDb()->prepare($sql)){
            $stmt->bind_param("s",$param);
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }   else{
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()){
                    array_push($arr,User::__constructByMysqliRow($row));
                }
                return $arr;
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }

    public function getUserById(){
        $arr = [];
        $sql = sprintf("SELECT * FROM %s ORDER BY %s ASC ",
            self::$USER_TABLE_NAME,
            self::$USER_ID);
        if ($stmt = $this->getDb()->prepare($sql)){
            if (!$stmt->execute()){
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
                return false;
            }   else{
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()){
                    array_push($arr,User::__constructByMysqliRow($row));
                }
                return $arr;
            }
        }   else{
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
            return false;
        }
    }


    /*
     * get fonksiyonları bitiş
     */

    public function editUserByAdmin($first_name, $last_name, $e_mail, $phone_number, $id)
    {
        $sql = sprintf("
            UPDATE %s SET %s=? ,%s=? ,%s=? ,%s=? WHERE %s=?",
            self::$USER_TABLE_NAME,
            self::$USER_FIRST_NAME,
            self::$USER_LAST_NAME,
            self::$USER_E_MAIL,
            self::$USER_PHONE_NUMBER,
            self::$USER_ID
        );

        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("sssss", $first_name, $last_name, $e_mail, $phone_number, $id);
            $res = $stmt->execute();
            if (!$res) {
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
        }
    }

    public function editUserByUser($first_name, $last_name, $e_mail, $phone_number, $tc, $user_id_from_session)
    {
        $sql = sprintf("
            UPDATE %s SET %s=? ,%s=? ,%s=? ,%s=? ,%s=? WHERE %s=?",
            self::$USER_TABLE_NAME,
            self::$USER_FIRST_NAME,
            self::$USER_LAST_NAME,
            self::$USER_E_MAIL,
            self::$USER_PHONE_NUMBER,
            self::$USER_TC,
            self::$USER_ID
        );

        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("sssssd", $first_name, $last_name, $e_mail, $phone_number,
                $tc, $user_id_from_session);
            $res = $stmt->execute();
            if (!$res) {
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
        }
    }

    public function findUserByID($searchKey){
        $sql = sprintf("
            SELECT * FROM %s WHERE %s=? LIMIT 1",
            self::$USER_TABLE_NAME,
            self::$USER_ID);

        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("i", $searchKey);
            $stmt->execute();
            $result = $stmt->get_result();
            $sinleRow = $result->fetch_assoc();
            return User::__constructByMysqliRow($sinleRow);
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı arama sırasında bir hata meydana geldi : " . $this->getDb()->error);
        }
    }


    public function getCustomerName($user_id)
    {
        if ($user_id == null) {
            return  "Gizli Kullanıcı";
        } else {
            $sql = sprintf("SELECT %s,%s FROM %s WHERE %s=?",
                self::$USER_FIRST_NAME,
                self::$USER_LAST_NAME,
                self::$USER_TABLE_NAME,
                self::$USER_ID);
            if ($stmt = $this->getDb()->prepare($sql)) {
                $stmt->bind_param("d", $user_id);

                if (!$stmt->execute()) {
                    $this->setIsError(true);
                    $this->setErrorMessage("Id için kullanıcı bilgileri getirmede sıkıntı meydana geldi : " . $this->getDb()->error);
                    return null;
                }
                $result = $stmt->get_result();
                $singleRow = $result->fetch_assoc();
                return $singleRow['ad'] . " " . $singleRow['soyad'];
            } else {
                $this->setErrorMessage("Id için kullanıcı bilgileri getirmede sıkıntı meydana geldi  : " . $this->getDb()->error);
                return null;
            }
        }
    }


    public function create_user($email, $password, $firstName, $lastName, $motherName, $fatherName, $maidenName, $tc, $tel): bool
    {
        $sql = sprintf("INSERT INTO %s(%s,%s,%s,%s,%s,%s) 
                    VALUES (?,?,?,?,?,?)",
            self::$USER_TABLE_NAME,
            self::$USER_E_MAIL,
            self::$USER_PASSWORD,
            self::$USER_FIRST_NAME,
            self::$USER_LAST_NAME,
            self::$USER_TC,
            self::$USER_PHONE_NUMBER
        );

        if ($stmt = $this->getDb()->prepare($sql)) {
            $md5_password = md5($password);
            $stmt->bind_param("ssssss", $email, $md5_password, $firstName, $lastName, $tc, $tel);

            if (!$stmt->execute()) {
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı ekleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }

            return true;
        }
    }


    public function user_password_control($mail, $password)
    {
        $sql = "SELECT * FROM kullanıcılar WHERE e_mail =? AND şifre = ?";
        if ($stmt = $this->getDb()->prepare($sql)) {
            $md5_password = md5($password);
            $stmt->bind_param("ss", $mail, $md5_password);

            if (!$stmt->execute()) die("Login sorgusu sırasında hata.");

            $result = $stmt->get_result();
            return $result;
        }
    }

    public function user_email_control($mail): bool
    {
        $sql = "SELECT * FROM kullanıcılar WHERE e_mail =?";
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("s", $mail);

            if (!$stmt->execute()) die("Hata.");

            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                return false;
            }

            return true;
        }
    }

    public function get_user_id_by_mail($mail): int
    {
        $sql = sprintf("SELECT %s FROM %s WHERE %s =?", self::$USER_ID, self::$USER_TABLE_NAME, self::$USER_E_MAIL);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("s", $mail);
            $res = $stmt->execute();
            if (!$res) {
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }
            $row = mysqli_fetch_assoc($stmt->get_result());
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
        }
        return $row[self::$USER_ID];
    }

    public function userActivation($user_id)
    {
        $is_active = 1;
        $sql = sprintf("UPDATE %s SET %s=? WHERE %s=?",
            self::$USER_TABLE_NAME,
            self::$USER_IS_ACTIVE,
            self::$USER_ID);

        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("dd", $is_active, $user_id);
            $res = $stmt->execute();
            if (!$res) {
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
        }
    }

    public function activation_control($email): bool
    {
        $sql = sprintf("SELECT * FROM %s WHERE %s=?", self::$USER_TABLE_NAME, self::$USER_E_MAIL);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $res = $stmt->execute();
            if (!$res) {
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı düzenleme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }
            $row = mysqli_fetch_assoc($stmt->get_result());
            if ($row['aktif'] == 1) {
                return true;
            } else {
                return false;
            }
            return true;
        }
    }

    public function updatePassword($e_mail, $password)
    {
        $sql = sprintf("UPDATE %s SET %s=? WHERE %s=?",
            self::$USER_TABLE_NAME,
            self::$USER_PASSWORD,
            self::$USER_E_MAIL);

        if ($stmt = $this->getDb()->prepare($sql)) {
            $md5_password = md5($password);
            $stmt->bind_param("ss", $md5_password, $e_mail);
            $res = $stmt->execute();
            if (!$res) {
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı şifre değiştirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
            }
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı şifre değiştirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
        }
    }

    public function getOneUserById($id){
        $sql = sprintf("SELECT * FROM %s WHERE %s=?",
            self::$USER_TABLE_NAME,
            self::$USER_ID);
        if ($stmt = $this->getDb()->prepare($sql)) {
            $stmt->bind_param("d", $id);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                return User::__constructByMysqliRow($result->fetch_assoc());
            }   else{
                $this->setIsError(true);
                $this->setErrorMessage("Kullanıcı şifre değiştirme sırasında bir hata meydana geldi : " . $this->getDb()->error);

            }
        } else {
            $this->setIsError(true);
            $this->setErrorMessage("Kullanıcı şifre değiştirme sırasında bir hata meydana geldi : " . $this->getDb()->error);
        }
    }


}