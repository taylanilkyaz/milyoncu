<?php

class ForgotPassword
{
    private $db;
    private $error_message;

    public function __construct()
    {
    }

    public function getDb(){

        if(!isset($this->db)) {
            $this->db = new UserDatabase();
        }

        return $this->db;
    }


    public function isPostData():bool {
        if(isset($_POST['email']))
            return true;
        return false;
    }

    /**
     * @return bool
     */
    public function makeControl():bool {
        $dbObject = new Database();
        $mail = $_POST['email'];
        $result = $this->getDb()->user_email_control($mail);
        $is_active = $this->getDb()->activation_control($mail);
        if (strcmp($_POST['first_password'],$_POST['second_password'])!=0){
            $this->error_message = "Girdiğiniz şifreler uyuşmamaktadır.";
            return false;
        }
        if (!$result) {
            $this->error_message = "E-Mail adresi sisteme kayıtlı değildir.";
            return false;
        }
        if (!$is_active) {
            $this->error_message = "Kullanıcı hesabı aktif değildir, şifrenizi değiştirmek için önce hesabınızı aktifleştiriniz.";
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }


}
?>