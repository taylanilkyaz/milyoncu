<?php

class ChangePassword
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

    public function isPostData()
    {
        if(isset($_POST['email']) && isset($_POST['first_password']) && isset($_POST['second_password']))
            return true;
        return false;
    }

    public function makeControls(){
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


    public function updatePassword($e_mail,$password){
        $activation_obj = new ActivationDatabase();
        $user_obj = new UserDatabase();
        $user_obj->updatePassword($e_mail,$password);
        $user_id = $user_obj->get_user_id_by_mail($e_mail);
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