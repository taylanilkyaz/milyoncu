<?php


class Logout{


    /**
     * Logout constructor.
     */
    public function __construct()
    {

    }

    public function isAlreadyLogin()
    {
        if(isset($_SESSION['e-mail'])){
            return true;
        }

        return false;
    }

}