<?php

/**
 * Created by PhpStorm.
 * User: ayhan
 * Date: 5.06.2017
 * Time: 00:37
 */
class Logout{


    /**
     * Logout constructor.
     */
    public function __construct()
    {

    }

    public function isAlreadyLogin():bool
    {
        if(isset($_SESSION['e-mail'])){
            return true;
        }

        return false;
    }

}