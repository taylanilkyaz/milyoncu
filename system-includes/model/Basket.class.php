<?php

class Basket{
    private $id;
    private $product_id;
    private $user_id;
    private $process_date;

    /**
     * Basket constructor.
     * @param $id
     * @param $product_id
     * @param $user_id
     * @param $process_date
     */
    public function __construct($id, $product_id, $user_id, $process_date)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->process_date = $process_date;
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
    public function setİd($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProductİd()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductİd($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getUserİd()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserİd($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getProcessDate()
    {
        return $this->process_date;
    }

    /**
     * @param mixed $process_date
     */
    public function setProcessDate($process_date)
    {
        $this->process_date = $process_date;
    }


}