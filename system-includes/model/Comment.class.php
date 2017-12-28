<?php

class Comment extends Model
{
    private $id;
    private $product_id;
    private $user_id;
    private $title;
    private $content;
    private $add_time;
    private $rating;

    /**
     * Comment constructor.
     * @param $product_id
     * @param $user_id
     * @param $title
     * @param $content
     * @param $add_time
     * @param $rate
     */
    public function __construct($id,$product_id, $user_id, $title, $content, $add_time,$rate)
    {
        $this->id   =   $id;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->content = $content;
        $this->add_time = $add_time;
        $this->rating = $rate;
    }

    public static function __constructByMysqliRow($row){
        return new self(
            $row[CommentDatabase::$COMMENT_ID],
            $row[CommentDatabase::$COMMENT_PRODUCT_ID],
            $row[CommentDatabase::$COMMENT_USER_ID],
            $row[CommentDatabase::$COMMENT_TITLE],
            $row[CommentDatabase::$COMMENT_CONTENT],
            self::timeFormat($row[CommentDatabase::$COMMENT_ADD_TIME]),
            $row[CommentDatabase::$COMMENT_RATE]);
    }

    /**
     * @return mixed
     */
    public function getİd()
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * @param mixed $add_time
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }




}