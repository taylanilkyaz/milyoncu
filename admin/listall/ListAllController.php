<?php

class ListAllController{
    private $db;
    private $is_error= false;
    private $error_message ;

    public function __construct()
    {

    }

    public function getDb(){

        if(!isset($this->db)) {
            $this->db = new BasketDatabase();
        }

        return $this->db;
    }
}