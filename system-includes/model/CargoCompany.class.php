<?php

class CargoCompany{
    private $id;
    private $name;
    private $price;
    private $time;


    public static function __constructByMysqliRow($row){
        $obj =  new self();
        $obj->setId($row[CargoCompanyDatabase::$CARGO_COMPANY_ID]);
        $obj->setName($row[CargoCompanyDatabase::$CARGO_COMPANY_NAME]);
        $obj->setPrice($row[CargoCompanyDatabase::$CARGO_COMPANY_PRICE]);
        $obj->setTime($row[CargoCompanyDatabase::$CARGO_COMPANY_TIME]);
        return $obj;
    }

    public function getDb()
    {

        if (!isset($this->db)) {
            $this->db = new CargoCompanyDatabase();
        }

        return $this->db;
    }
    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}