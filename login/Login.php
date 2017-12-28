<?php

class Login
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

    public function do_login_post_data():bool {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $result = $this->getDb()->user_email_control($email);
        if (!$result){
            $this->error_message = "Girdiğiniz mail sistemde kayıtlı değildir.";
            return false;
        }

        $result= $this->getDb()->activation_control($email);
        if (!$result){
            $this->error_message = "Kullanıcı aktif değildir. Mailinize gelen aktivasyon butonuna tıklayınız.
                                    Aktivasyon maili size ulaşmadıysa, yeniden aktivasyon maili almak için tıklayınız.";
            return false;
        }

        $result = $this->getDb()->user_password_control($email,$password);


        /**
         * Böyle bir kullanıcı var.
         */
        if($result->num_rows == 1){
            /**
             * Sessionu ayarla.
             */
            $constant = "55fflbvczj";
            $user_data = $result->fetch_assoc();
            $_SESSION['id'] = $user_data['id'];
            $_SESSION['e-mail'] = $user_data['e_mail'];
            $_SESSION['name'] = $user_data['first_name'];;
            $_SESSION['surname'] = $user_data['last_name']; ;
            $_SESSION['father_first'] = $user_data['father_first'];
            $_SESSION['mother_first'] = $user_data['mother_first'];
            $_SESSION['mother_maiden'] = $user_data['mother_maiden'];
            $_SESSION['add_datetime'] = $user_data['add_datetime'];
            $_SESSION['user_type'] = $user_data['type'];
            $_SESSION['token'] = $user_data['id'].microtime().$constant;
            return true;
        }
        /**
         * Böyle bir kullanıcı yok hata mesajı döndür.
         */
        else{
            $this->error_message = "Girdiğiniz şifre yanlıştır. Şifrenizi hatırlamıyorsanız \"Şifremi Unuttum\" butonuna basınız.";
            return false;
        }
    }

    public function isAlreadyLogin():bool
    {
        if(isset($_SESSION['e-mail'])){
            return true;
        }

        return false;
    }

    public function isPostData()
    {
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['csrf']))
            return true;
        return false;
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