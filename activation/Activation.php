<?php

class Activation
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



    public function isGetData()
    {
        if(isset($_GET['email']) && isset($_GET['activation_code']))
            return true;
        return false;
    }

    public function makeControls(){
        //zamanını kontrol edeceğiz burada
        $user_obj = new UserDatabase();
        $activation_obj = new ActivationDatabase();
        $user_id = $user_obj->get_user_id_by_mail($_GET['email']);
        $activation_code = $activation_obj->getActivationCodeByUserId($user_id);
        if ($activation_code==$_GET['activation_code']){
            return true;
        } else{
            $this->error_message = "Aktivasyon kodunuzu yanlış girdiniz, lütfen tekrar deneyiniz. ";
            return false;
        }
    }

    public function makeUserActive(){
        $user_obj = new UserDatabase();
        $activation_obj = new ActivationDatabase();
        $user_id = $user_obj->get_user_id_by_mail($_GET['email']);
        $user_obj->userActivation($user_id);
        $activation_obj->deleteRow($user_id);
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