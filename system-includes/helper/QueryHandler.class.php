<?php


class QueryHandler{

    /**
     * Ürünün slug bilgisi.
     */
    private $productSlug;

    /**
     * Sayfa title bilgisi.
     * @var
     */
    private $title;

    /**
     * String işlerine yardımcı olmak için.
     */
    private $stringHelper ;


    function __construct() {
        $this->stringHelper = new StringHelper();
        $this->setProduct();
    }

    /**
     * RequestUriyi getirir
     * Parametre : http://localhost/huzursuzluk-zulfu-livaneli
     * Sonuç : /huzursuzluk-zulfu-livaneli
     * @return string
     */
    public function getRequestUri():string {
        return $_SERVER['REQUEST_URI'];
    }


    public function getProduct():string {
        return $this->productSlug;
    }


    private function setProduct(){
        $this->productSlug = $this->stringHelper->deleteFirstChar($this->getRequestUri());
    }

    public function getTitle(){
        return $this->title;
    }







}