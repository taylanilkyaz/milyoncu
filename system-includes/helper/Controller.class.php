<?php

/**
 * Created by PhpStorm.
 * User: ayhan
 * Date: 6.08.2017
 * Time: 22:58
 */
class Controller
{
    function controllUserLevel($level)
    {
        $this->isSessionStarted();
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] == UserTypes::$ADMIN_USER) {
                return true;
            }
            if ($_SESSION['user_type'] != $level) {
                return false;
            }
        }   else{
            return false;
        }
        return true;
    }

    function isSessionStarted()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return true;
    }
}