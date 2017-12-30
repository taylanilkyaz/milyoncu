<?php

class Buy
{

    private $db;
    private $is_error = false;
    private $error_message;

    public function __construct()
    {

    }

    public function getDb()
    {

        if (!isset($this->db)) {
            $this->db = new BasketDatabase();
        }

        return $this->db;
    }

    public function getProductDb()
    {
        if (!isset($this->db)) {
            $this->db = new ProductDatabase();
        }

        return $this->db;
    }

    public function addBasketByProductName($userId, $productName): bool
    {
        /**
         * Kısa string koruması.
         */
        if ((strlen($productName) < 4)) {
            return false;
        }

        $res = $this->getDb()->addBasketByProductName($userId, $productName);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
        }

        return true;
    }

    public function deleteAllBasket($userId)
    {
        $this->getDb()->emptyBasket($userId);
    }

    public function deleteProductFromBasket($userId, $product_name)
    {
        $res = $this->getDb()->deleteProductFromBasket($userId, $product_name);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
        }

        return true;
    }

    public function deleteBasketByProductName($userId, $productName): bool
    {
        $res = $this->getDb()->deleteLastDateBasketByName($userId, $productName);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
        }

        return true;
    }


    public function getAllBasketTotalPrice($user_id)
    {
        $res = $this->getDb()->getAllBasket($user_id);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return null;
        }

        $resList = array();
        while ($row = $res->fetch_assoc()) {
            array_push($resList, Product::__constructByMysqliRow($row, true));
        }

        $sum = 0;
        /**
         * 4
         * Veritabanından direk toplamı da alabiliriz ama bu daha programcıya yakın.
         * Performans sorunları yaşarsak düşünülebilir.
         */
        /**
         * @var $obj Product
         */
        foreach ($resList as $obj) {
            $sum += $obj->getPrice() * $obj->getCount();
        }

        return $sum;
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getAllBasketHtmlFormat($user_id): string
    {
        $res = $this->getDb()->getAllBasket($user_id);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return null;
        }

        $resList = array();
        while ($row = $res->fetch_assoc()) {
            array_push($resList, Product::__constructByMysqliRow($row, true));
        }


        $str = '';
        /**
         * @var Product $obj
         */
        $str .= <<<HTML
            <form method="post" action="/admin/sepetim/index.php">
HTML;

        foreach ($resList as $obj) {
            $objToField = $obj->fieldToArray();
            $image_path = $obj->getImagePath();
            $name = $obj->getName();
            $count = $obj->getCount();
            $price = floor($obj->getPrice());
            $totalPrice = $count * $price;
            $str .= <<<HTML
                <div class="ui centered stackable grid buy-item">
                    <div class="five wide center aligned  column">
                        <img class="ui image" src="/assets/images/productimage/512/${image_path} ">
                    </div>
                    
                    
                    
                    
                    
                    <div class="seven wide column">
                        <a class="header">
                            <h5>${name}</h5>
                        </a>
                        
                        <div class="meta">${count} Adet</div>
                        
                        <div class="meta">
                            <a> <i class="lira icon"></i>${totalPrice}</a>
                        </div>
                    </div>
                    
                    <div class="two wide column">
                        <i class="big trash outline icon remove-buy-item"></i>
                    </div>
                    
                    <div class="ui divider">
                            
                    </div>
                </div>
                <div class="ui divider"></div>
            

HTML;
        }
        if (count($resList) != 0) {
            $str .= <<<HTML
            
                <div class="fourteen wide column">
                    <button id="detail-checkout-button" class="ui big right labeled icon button">
                        <i class="angle big right icon"></i>
                             Alışverişi Tamamla
                    </button>
                </div>
            </form>
HTML;
        }


        return $str;

    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getAllBasketForPage($user_id): string
    {
        $res = $this->getDb()->getAllBasket($user_id);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return null;
        }
        $resList = array();
        while ($row = $res->fetch_assoc()) {
            array_push($resList, Product::__constructByMysqliRow($row, true));
        }

        $str = '';
        /**
         * @var Product $obj
         */

        $str .=<<<HTML
        <div class="ui grid" id="sepet-topmost-grid-id">
        
HTML;
        /**
         * Mobil
         */
        $str .=<<<HTML
        <div class="mobile only row" id="mobile-sepet-id">    
HTML;
        $totalPrice=0;
        $totalCount=0;
        foreach ($resList as $obj){
            $id = $obj->getId();
            $image_path = $obj->getImagePath();
            $name = $obj->getName();
            $count = $obj->getCount();
            $totalCount+=$count;
            $price = floor($obj->getPrice()) * $count;
            $totalPrice+=$price;

            $str .=<<<HTML
            <div class="ui grid product-container-grid" id="${id}">
                <div class="sixteen wide column">
                    <h4 class="product-name">
                        <a href="../product-description/index.php?name=${name}" >${name}</a>
                    </h4>
                    <a href="../product-description/index.php?name=${name}">
                        <img src="/assets/images/productimage/512/${image_path}">
                    </a>
                </div>
                <div class="sixteen wide column flex-parent">
                    <div>
                        <div class="container sepetim-count-input">
                            <div class="count-input">
                                <a class="incr-btn" data-action="decrease" href="#" title="Azalt"><b>&minus;</b></a>
                                <input readonly class="quantity" type="text" name="quantity" id="mobile-input-count" value="${count} Adet"/>
                                <a class="incr-btn" data-action="increase" href="#" title="Arttır"><b>&plus;</b></a>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-total-sepetim"><i class="lira icon"></i><b><span class="price-span">${price}</span></b></div>
                </div>
                <div class="sixteen wide column">
                    <div>
                        <button class="btn-delete ui button"><i class="trash icon"></i>Sil</button>
                    </div>
                </div>                   
            </div> 
            <div class="ui divider"></div>
HTML;
        }
        $str.=<<<HTML
        </div>
HTML;
        /**
         * mobil sonu
         */


        /**
         * Tablet
         */

        $str .=<<<HTML
        <div class="tablet only row" id="tablet-sepet-id">    
HTML;
        $totalPrice =0;
        $totalCount=0;
        foreach ($resList as $obj){
            $id = $obj->getId();
            $image_path = $obj->getImagePath();
            $name = $obj->getName();
            $count = $obj->getCount();
            $totalCount+=$count;
            $price = floor($obj->getPrice()) * $count;
            $totalPrice+=$price;

            $str .=<<<HTML
            <div class="ui grid product-container-grid" id="${id}">
                <div class="sixteen wide column">
                    <h4 class="product-name">
                        <a href="../product-description/index.php?name=${name}" >${name}</a>
                    </h4>
                </div>
                <div class="eight wide column">
                    <a href="../product-description/index.php?name=${name}">
                        <img src="/assets/images/productimage/512/${image_path}">
                    </a>
                </div>
                <div class="eight wide column">
                    <div class="row">
                        <div class="container sepetim-count-input">
                            <div class="count-input">
                                <a class="incr-btn" data-action="decrease" href="#" title="Azalt"><b>&minus;</b></a>
                                <input readonly class="quantity" type="text" name="quantity" value="${count} Adet"/>
                                <a class="incr-btn" data-action="increase" href="#" title="Arttır"><b>&plus;</b></a>
                            </div>
                        </div>
                    </div>
                    <div class="row flex-parent">
                        <div class="col-total-sepetim"><i class="lira icon"></i><b><span class="price-span">${price}</span></b></div>
                        <button class="btn-delete ui button"><i class="trash icon"></i>Sil</button>                    
                    </div>
                </div>                
            </div> 
            <div class="ui divider"></div> 

HTML;
        }
        $str.=<<<HTML
        </div>
HTML;


        /**
         * tablet sonu
         */


        /**
         * Computer
         */

        $str .=<<<HTML
        <div class="computer only row" id="computer-sepet-id">    
HTML;
        $totalPrice = 0;
        $totalCount = 0;
        foreach ($resList as $obj){
            $id = $obj->getId();
            $image_path = $obj->getImagePath();
            $name = $obj->getName();
            $count = $obj->getCount();
            $totalCount+=$count;
            $price = floor($obj->getPrice()) * $count;
            $totalPrice+=$price;
            $str .=<<<HTML
            <div class="ui grid product-container-grid" id="${id}">
                <div class="three wide column">
                    <a href="../product-description/index.php?name=${name}"id="buy-image-size" >
                        <img  src="/assets/images/productimage/512/${image_path}">
                    </a>
                </div>
                <div class="five wide column">
                    <h4 class="product-name">
                        <a href="../product-description/index.php?name=${name}" >${name}</a>
                    </h4>
                    <div>
                        <button class="btn-delete ui button"><i class="trash icon"></i>Sil</button>                    
                    </div>
                </div>
                <div class="eight wide column flex-parent">
                    <div class="four wide column">
                        <div class="container sepetim-count-input">
                            <div class="count-input">
                                <a class="incr-btn" data-action="decrease" href="#" title="Azalt"><b>&minus;</b></a>
                                <input readonly class="quantity" type="text" name="quantity" id="computer-input-count" value="${count} Adet"/>
                                <a class="incr-btn" data-action="increase" href="#" title="Arttır"><b>&plus;</b></a>
                            </div>
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="col-total-sepetim"><i class="lira icon"></i><b><span class="price-span">${price}</span></b></div>
                    </div>
                </div>
            </div> 
            <div class="ui divider"></div> 

HTML;
        }
        $str.=<<<HTML
        </div>
HTML;

        /**
         * computer sonu
         */

        $str .= <<<HTML
         <span><a href="../buy" class="ui button" id="alisverise-geri-don"><i class="chevron left icon"></i>Alisverise Devam Et</a></span>
         </div>
HTML;
        $str .= <<<HTML
        <div id="total-price-container" style="display: none;"><span>${totalPrice}</span></div>
        <div id="total-count-container" style="display: none;"><span>${totalCount}</span></div>
HTML;

        return $str;

    }

    public function getAllCategories($id)
    {
        $categoryObj = new CategoriesDatabase();
        return $categoryObj->getCategoryName($id);
    }

    /**
     * @return null|Product[]
     */
    public function getAllProducts($category_id)
    {
        $res = $this->getProductDb()->getAllProducts($category_id);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
        }

        /** @var Product[] $res */
        return $res;
    }

    public function getAllCargoPrice($user_id)
    {
        return 11.90;
    }

    public function getAllBasketAsProductArr($user_id)
    {
        $res = $this->getDb()->getAllBasket($user_id);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
            return null;
        }

        $resList = array();
        while ($row = $res->fetch_assoc()) {
            array_push($resList, Product::__constructByMysqliRow($row, true));
        }

        return $resList;
    }

    public function getAllProductsForSubCategory($id)
    {
        $productObj = new ProductDatabase();
        return $productObj->getAllProductsForSubCategory($id);
    }
    /**
     * @return null|Product[]
     */
    public function getAllProductsPrice($small,$large)
    {
        $res = $this->getProductDb()->getAllProductsPrice($small,$large);
        if (!$res) {
            $this->is_error = true;
            $this->error_message = $this->getDb()->getErrorMessage();
        }

        /** @var Product[] $res */
        return $res;
    }

}

?>



