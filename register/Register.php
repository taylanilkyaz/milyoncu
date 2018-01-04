<?php

class Register
{
    private $db;
    private $error_message;
    private $userDb;

    public function __construct()
    {

    }

    public function getDb(){

        if(!isset($this->db)) {
            $this->db = new Database();
        }

        return $this->db;
    }

    public function getUserDb(){
        if(!isset($this->userDb)) {
            $this->userDb = new UserDatabase();
        }

        return $this->userDb;
    }



    public function createUserPostData() {
        $dbObject = new Database();
        $firstName = $_POST['first_name'];
        $lastName  = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $motherName = "";
        $fatherName ="";
        $maidenName = "";
        $tcNo =  $_POST['tc_no'];
        $tel = $_POST['tel_number'];

        if(!$this->isValidCreateUserData($email,$password,$firstName,$lastName, $motherName,$fatherName,$maidenName,$tcNo)){
            $this->error_message = "Kullanıcı kayıt bilgileri yanlış.";
            return false;
        }

        if($this->isEmailExist($email)){
            $this->error_message = "Sisteme kayıtlı bir e-mail adresi girdiniz, şifrenizi unuttuysanız \"Şifremi Unuttum\" butonuna tıklayınız.";
            return false;
        }
        //user is active 1 mi sıfır mı onu kontrol etmemiz gerekiyor
        $this->getUserDb()->create_user($email,$password,$firstName,$lastName, $motherName,$fatherName,$maidenName,$tcNo,$tel);
        if($this->getDb()->isError()){
            $this->error_message =  $this->getDb()->getErrorMessage();
            return false;
        }

        return true;
    }

    public function isAlreadyLogin()
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

    public function isValidEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== FALSE ? true : false;
    }

    /**
     * En az 6 hane, sadece ascii karakterleri,en çok 16 hane.
     * a-z A-Z 0-9 * - _ kabul eder.
     * @param $password
     */
    public function isValidPassword($password){
        $len = strlen($password);
        if($len < 6 || $len>16){
            return false;
        }

        if(!preg_match('/([a-z]|[A-Z]|[0-9]|\*_-){6,16}/',$password)){
            return false;
        }

        return true;
    }

    /**
     * 2-99 harfleri arası
     * a-z A-Z ve türkçe karakterleri kabul eder.
     * @param $name
     * @return bool
     */
    public function isValidName($name){
        $len = mb_strlen($name);
        if($len < 2 && $len > 99){
            return false;
        }

        return true;
    }

    /**
     * Tc kontrol.
     * Numara olmalı
     * 11 hane olmalı
     * 10. hane 1-3-5-7-9 * 8 eksik 2-4-6-8 %10
     * 11.hane 1-2-3-4-5-6-7-8-9-10  % 10
     * @param $tc
     * @return bool
     */
    public function isValidTC($tc){
        if(!is_numeric($tc))
            return false;

        $len = strlen($tc);
        if($len != 11 || $tc[0] == 0)
            return false;

        return true;
    }



    public function isValidCreateUserData($email,$password,$first_name,$last_name,
        $motherName,$fatherName,$maidenName,$tc){

        if(!$this->isValidEmail($email)) return false;
        if(!$this->isValidPassword($password)) return false;
        if(!$this->isValidName($first_name)) return false;
        if(!$this->isValidName($last_name)) return false;
        if(!$this->isValidName($motherName)) return false;
        if(!$this->isValidName($fatherName)) return false;
        if (strcmp($maidenName,"")!=0){
            if(!$this->isValidName($maidenName)) return false;
        }
        if (strcmp($tc,"")!=0) {
            if (!$this->isValidTC($tc)) return false;
        }
        return true;
    }

    private function isEmailExist($email){
        return $this->getUserDb()->user_email_control($email);
    }

}
?>