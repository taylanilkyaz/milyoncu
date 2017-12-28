<?php

class Product{
    private $id;
    private $name;
    private $price;
    private $short_desc;
    private $image_path;
    private $count;
    private $category;
    private $sub_category;
    private $expert_active;
    private $long_desc;


    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $short_desc
     * @param $image_path
     * @param $count
     */
    public function __construct($id, $name, $price, $short_desc, $image_path,$count=null,$expert_active,$long_desc,$category)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->short_desc = $short_desc;
        $this->image_path = $image_path;
        $this->count = $count;
        $this->expert_active = $expert_active;
        $this->long_desc = $long_desc;
        $this->category = $category;
    }

    public function fieldToArray(){
        $arr = array();
        $arr['id'] = $this->id;
        $arr['name'] = $this->name;
        $arr['price'] = $this->price;
        $arr['short_desc'] = $this->short_desc;
        $arr['image_path'] = $this->image_path;
        $arr['count'] = $this->count;

        return $arr;
    }


    public static function __constructByMysqliRow($row,$exist_count){
        if($exist_count){
            return new self(
                $row[ProductDatabase::$PRODUCT_ID],
                $row[ProductDatabase::$PRODUCT_NAME],
                $row[ProductDatabase::$PRODUCT_PRICE],
                $row[ProductDatabase::$PRODUCT_DESC],
                $row[ProductDatabase::$PRODUCT_IMAGEPATH],
                $row[ProductDatabase::$PRODUCT_COUNT],
                $row[ProductDatabase::$PRODUCT_EXPERT_ACTIVE],
                $row[ProductDatabase::$PRODUCT_LONG_DESC],
                $row[ProductDatabase::$PRODUCT_CATEGORY_ID]);
        }else{
            return new self(
                $row[ProductDatabase::$PRODUCT_ID],
                $row[ProductDatabase::$PRODUCT_NAME],
                $row[ProductDatabase::$PRODUCT_PRICE],
                $row[ProductDatabase::$PRODUCT_DESC],
                $row[ProductDatabase::$PRODUCT_IMAGEPATH],null,
                $row[ProductDatabase::$PRODUCT_EXPERT_ACTIVE],
                $row[ProductDatabase::$PRODUCT_LONG_DESC],
                $row[ProductDatabase::$PRODUCT_CATEGORY_ID]);
        }

    }


    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
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
        return floor($this->price * ExchangeRate::getDOLLARTOTRY());
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getShortDesc()
    {
        return $this->short_desc;
    }

    /**
     * @param mixed $short_desc
     */
    public function setShortDesc($short_desc)
    {
        $this->short_desc = $short_desc;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * @param mixed $image_path
     */
    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getSubCategory()
    {
        return $this->sub_category;
    }

    /**
     * @param mixed $sub_category
     */
    public function setSubCategory($sub_category)
    {
        $this->sub_category = $sub_category;
    }

    /**
     * @return mixed
     */
    public function getExpertActive()
    {
        return $this->expert_active;
    }

    /**
     * @param mixed $expert_active
     */
    public function setExpertActive($expert_active)
    {
        $this->expert_active = $expert_active;
    }

    /**
     * @return mixed
     */
    public function getLongDesc()
    {
        return $this->long_desc;
    }

    /**
     * @param mixed $long_desc
     */
    public function setLongDesc($long_desc)
    {
        $this->long_desc = $long_desc;
    }








}