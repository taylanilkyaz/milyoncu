<?php

if (isset($_SESSION['id'])){
    //kullanıcı siparisi bitirdi bilgiler database'e eklenmeli
    require $_SERVER['DOCUMENT_ROOT'].'/admin/buy/Buy.class.php';
    include "../../../system-includes/helper/MailSender.php";
    $mailObj = new MailSender();
    $user_id = $_SESSION['id'];
    $pay_type = $_SESSION['installment_type'];
    $hide_cc_number = $_SESSION['hide_cc_number'];
    $pay_price = $_SESSION['full_pay_price'];
    $is_success_pau = $_SESSION['is_success_pay'];

    $dashboard = new Buy();
    $obj = new AddressDatabase();
    $totalPrice = $dashboard->getAllBasketTotalPrice($user_id) ;
    $cargoPrice = $pay_price;
    $fullPrice = $pay_price;
    $basketList = $dashboard->getAllBasketAsProductArr($user_id);
    $buyed_product_obj = new BuyedProductsDatabase();
    $order_code=$buyed_product_obj->insertBuyedProducts($basketList,$user_id);
    $dashboard->deleteAllBasket($user_id);
    $mailObj->sendMailForSiparisTamamlandi(
            $_SESSION['e-mail'],
            $basketList,$obj->getCargoAddress($user_id),
            $obj->getBillAddress($user_id),
            $_SESSION['name']." ".$_SESSION['surname'],
            $order_code);
    //burada mail ürün yöneticisi maili ile değiştirilecek
    $mailObj->sendMailForSiparisTamamlandi(
        $_SESSION['e-mail'],
        $basketList,$obj->getCargoAddress($user_id),
        $obj->getBillAddress($user_id),
        null,
        $order_code);
}
?>


<div id="teslim-bilgileri-page-id">
    <div id="teslimat-bilgileri-top-content-id" class="ui fluid container">
        <div class="ui tablet stackable steps" id="steps-id">
            <div class="disabled step">
                <i class="truck icon"></i>
                <div class="content">
                    <div class="title">Teslimat Bilgileri</div>
                </div>
            </div>

            <div class="disabled step">
                <i class="payment icon"></i>
                <div class="content">
                    <div class="title">Ödeme Bilgileri</div>
                </div>
            </div>

            <div class="disabled step">
                <i class="info icon"></i>
                <div class="content">
                    <div class="title">Sipariş Özeti</div>
                </div>
            </div>

            <div class="active step">
                <i class="checkmark icon"></i>
                <div class="content">
                    <div class="title">Sipariş Tamamlandı</div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="siparis-tamamlandi-2" class="ui fluid container">
    <div class="ui stackable grid" id="siparis-tamamlandi-grid">
        <div class="two wide computer one wide tablet column  frame"></div>
        <div class="seven wide computer column nine wide tablet column frame">
            <div class="ui segment">
                <p class="ahref">
                    <strong><span class="ui header">Merhaba <?php
                    echo $_SESSION['name'];
                    echo " ";
                    echo $_SESSION['surname'];
                            ?>, siparişiniz onaylandı.</span></strong>
                <h3 class="ui header color margin" >Sipariş Numaranız : <?php echo $order_code?> </h3>
                <p class="box-header-desc"><strong>Alışverişinizde bizi tercih ettiğiniz için teşekkür ederiz</strong></p>
                </p>
            </div>

            <div class="ui segment">
                <div class="order-items-header group">
                    <div class="ui stackable grid ">
                        <div class="five wide column">
                            <div class="col-product-name lftpadd">Ürün</div>
                        </div>
                        <div class="two wide column">
                            <div class="col-amount adet">Adet</div>
                        </div>
                        <div class="three wide column">
                            <div class="col-total toplam">Toplam</div>
                        </div>
                    </div>
                </div>

                <?php
                /**
                 * @var $item Product
                 */
                $totalProductCount = 0;
                foreach ($basketList as $item){
                    $totalProductCount+=$item->getCount();
                    ?>

                    <div class="ui segment substance">
                        <div class="ui stackable grid">
                            <div class="five wide column">
                                <div class="col-product-name"><?php echo $item->getName(); ?></div>
                            </div>
                            <div class="two wide column">
                                <div class="col-amount"><?php echo $item->getCount(); ?></div>
                            </div>
                            <div class="three wide column">
                                <div class="col-total"><?php echo ($item->getCount() * $item->getPrice()); ?> </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>

            </div>

            <div class="ui segment">
                <p class="ahref">
                    <span class="ui header title color">Teslimat Bilgileri  </span>

                <div class="order-items-header group">
                    <div class="ui stackable grid">
                        <div class="eight wide phone eight wide tablet six wide computer column">
                            <div class="col-product-name lftpadd ">Teslimat Adresi</div>
                        </div>
                        <div class="eight wide phone eight wide tablet six wide computer column">
                            <div class="col-delivery lftpadd">Fatura Adresi</div>
                        </div>
                    </div>
                </div>

                <div class="ui stackable grid">

                    <div class="eight wide phone eight wide tablet six wide computer column">
                        <div class="ui segment substance">
                            <div class="col-product-name"><?php echo $obj->getCargoAddress($user_id)?></div>
                        </div>
                    </div>
                    <div class="eight wide phone eight wide tablet six wide computer column">
                        <div class="ui segment substance">
                            <div class="col-product-name"><?php echo $obj->getBillAddress($user_id)?></div>
                        </div>
                    </div>
                </div>
                </p>
            </div>

            <div class="ui segment">
                <p class="ahref">
                    <span class="ui header title color">Ödeme Bilgileri</span>
                <div class="order-items-header group">
                    <div class="ui stackable grid">
                        <div class="eight wide phone eight wide tablet six wide computer column">
                            <div class="col-product-name lftpadd">Kredi Kartı</div>
                        </div>
                        <div class="eight wide phone eight wide tablet six wide computer column">
                            <div class="col-delivery">Tutar</div>
                        </div>

                    </div>
                </div>
                <div class="ui stackable grid">
                        <div class="eight wide phone eight wide tablet six wide computer column">
                        <div class="ui segment substance">
                            <div class="col-product-name">589283********22- ISBANK</div>
                        </div>
                    </div>

                    <div class="eight wide phone eight wide tablet six wide computer column">
                        <div class="ui segment substance">
                            <div class="col-delivery"><?php
                            echo $fullPrice; ?></div>
                        </div>
                    </div>
                </div>
                </p>
            </div>

    </div>
        <div class="three wide computer four wide tablet column frame">
        <div id="fixed-part-siparis-tamamlandi">
            <div class="ui segment"id="fixed-text-right-tamamlandi">
                <h3 class="ui header">
                    <div class="ui dividing header color">Sipariş Özeti
                        <div class="sub header"><?php echo $totalProductCount?> ürün</div>
                    </div>
                </h3>
                <h3 class="ui header">
                    <div class="sub header">Ödenen Tutar</div>
                    <div class="ui header"><i class="lira icon"style="font-size: medium"></i><?php echo floor($pay_price);
                        ?></div>
                </h3>
                <a class="ui primary submit button" href="../../buy">Ürün Sayfasına Dön</a>


            </div>
        </div>
    </div>
    </div>
</div>
