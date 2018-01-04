<?php

class Database
{
    private $db;
    private $error_message ;
    private $is_error;

    public function __construct () {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->db->set_charset("utf8");
        if ($this->db->connect_error) {
            die('Connect Error (' . $this->db->connect_errno . ') '
                . $this->db->connect_error);
        }
    }

    public function getDb(){
        return $this->db;
    }

    /**
     * @return mixed
     */
    public function getIsError()
    {
        return $this->is_error;
    }



    /**
     * @param mixed $is_error
     */
    public function setIsError($is_error)
    {
        $this->is_error = $is_error;
    }


    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /**
     * @param mixed $error_message
     */
    public function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
    }



    /**
     * @return mixed
     */
    public function isError()
    {
        return $this->is_error;
    }




}