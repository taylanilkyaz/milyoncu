<?php

include 'OrderPlus.class.php';

if (isset($_SESSION['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/admin/buy/Buy.class.php';
    $obj = new BuyedProductsDatabase();
    $relation_obj = new OrderBuyRelationDatabase();
    $user_obj = new UserDatabase();
    $order_code_array = $relation_obj->getAllOrderCodes();
    $addressObj = new AddressDatabase();
    $classObj = new OrderPlus();

}

?>

<div id="error-dimmer" class="ui page dimmer">
    <div class="content">
        <h2 class="ui inverted icon header">
            <i class="mail icon"></i>
            Hatalı İşlem Yaptınız !
            <div class="sub header">İşlemler sırayla yapılmalı.</div>
        </h2>
    </div>
</div>

<div id="success-dimmer" class="ui page dimmer">
    <div class="content">
        <h2 class="ui inverted icon header">
            <i class="mail icon"></i>
            Kaydedildi
            <div class="sub header">Siparişin Kargo Numarasını Kaydettiniz.</div>
        </h2>
    </div>
</div>

<div id="orderplus-container" class="ui fluid container">
    <div class="ui styled fluid accordion">
        <div class="active title" id="header-title" style="clickable:false">
            <div class="ui stackable grid ">
                <div class="one wide column">
                    <i class="dropdown icon" style="display: none;"></i>
                </div>
                <div class="one wide column">
                    <div class="col-product-name lftpadd">İsim Soyisim</div>
                </div>
                <div class="center aligned five wide column talign">
                    <div class="col-delivery ">Alınan Ürünler</div>
                </div>
                <div class="one wide column talign">
                    <div class="col-shipping-option">Sipariş Kodu</div>
                </div>
                <div class="two wide column talign">
                    <div class="col-amount ">Sipariş Tarihi</div>
                </div>
                <div class="two wide column talign">Fatura Adresi
                </div>
                <div class="two wide column talign">Kargo Adresi
                </div>
                <div class="two wide column talign">Sipariş Durumu
                </div>

            </div>
        </div>
        <div class="content"></div>
    </div>

    <div class="ui styled fluid accordion">
        <?php
        for ($i = 0;
        $i < count($order_code_array);
        $i++) {
        $res = $obj->getAllBuyedProducts($order_code_array[$i]['order_code']);
        $resList = array();
        while ($row = $res->fetch_assoc()) {
            array_push($resList, Product::__constructByMysqliRow($row, true));
        }
        //order code arrayin her biri için user id den isim almalıyız
        //order code bildiğimiz elemanın tarihini almalıyız
        $order_date = $relation_obj->getAddDate($order_code_array[$i]['order_code']);
        $customerUserId = $obj->getCustomerId($order_code_array[$i]['order_code']);
        $customerNameAndSurname = $user_obj->getCustomerName($customerUserId);
        $order_status = $relation_obj->getOrderStatus($order_code_array[$i]['order_code']);
        ?>

        <?php
        if ($i == 0){
        ?>
        <div class="active title">
            <?php
            }   else{ ?>
            <div class="title">
                <?php
                }
                ?>

                <div class="ui stackable grid ">
                    <div class="one wide column">
                        <i class="dropdown icon"></i>
                    </div>
                    <div class="one wide column">
                        <div class="col-product-name lftpadd"><?php echo $customerNameAndSurname ?></div>
                    </div>
                    <div class="five wide column talign">
                        <div class="col-delivery "><?php
                            for ($j = 0; $j < count($resList); $j++) {
                                $oneProduct = $resList[$j];
                                /**
                                 * @var $oneProduct Product
                                 */
                                echo $oneProduct->getCount() . " Adet " . $oneProduct->getName();
                                if ($j != count($resList) - 1) {
                                    echo ", ";
                                }
                            }
                            ?></div>
                    </div>
                    <div class="one wide column talign">
                        <div class="col-shipping-option order-code-container"><?php echo $order_code_array[$i]['order_code']; ?></div>
                    </div>
                    <div class="two wide column talign">
                        <div class="col-amount "><?php
                            echo $obj->timeFormat($order_date)
                            //echo $order_date; ?></div>
                    </div>
                    <div class="two wide column talign"><?php
                        echo $relation_obj->getBillAddress($order_code_array[$i]['order_code']);
                        ?>
                    </div>
                    <div class="two wide column talign"><?php
                        echo $relation_obj->getCargoAddress($order_code_array[$i]['order_code']);
                        ?>
                    </div>
                    <div class="two wide column talign order-status-string-container"><?php echo $classObj->getOrderString($order_status) ?></div>
                </div>
            </div>
            <?php
            if ($i == 0){
            ?>
            <div class="active content">
                <?php
                }   else{ ?>
                <div class="content">
                    <?php
                    }
                    ?>
                    <div class="thirteen wide column" data-group="checkBoxes" id="order-plus-content">
                        <div class="ui stackable two column grid">
                            <div class="column">
                                <div class="status-container" style="display: none"
                                     id="<?php echo $order_status ?>"></div>
                                <div class="sefa" id="<?php echo $order_code_array[$i]['order_code']; ?>">
                                    <div class="ui toggle checkbox" data-status="0">
                                        <input type="checkbox" name="public">
                                        <label>Sipariş Verildi </label>
                                    </div>

                                    <div class="ui toggle checkbox" data-status="1">
                                        <input type="checkbox" name="public">
                                        <label>Ürün Hazırlanmaya Başlandı </label>
                                    </div>

                                    <div class="ui toggle checkbox cargo" data-status="2">
                                        <input type="checkbox" name="public">
                                        <label>Kargo takip numarası girildi.
                                            <span>Kargo Numarası :
                                        </span>
                                        </label>
                                    </div>

                                    <!--   cargo no alanı ayrıldı -->
                                    <div class="ui input focus shipping" <?php if ($order_status < 2){ ?>
                                         style="display: none" <?php } ?>data-status="input">
                                        <input type="text" placeholder="Kargo Numarası"
                                               value="<?php echo $order_code_array[$i]['cargo_no'] ?>">
                                        <button style="width: 100%" class="ui green button submit-cargo-no">Kaydet
                                        </button>
                                    </div>

                                    <div class="ui toggle checkbox" data-status="3">
                                        <input type="checkbox" name="public">
                                        <label>Ürün size ulaştı. </span> </label>
                                    </div>

                                    <div class="ui toggle checkbox" data-status="4">
                                        <input type="checkbox" name="public">
                                        <label>Ürün merkezimize ulaştı. </label>
                                    </div>

                                    <div class="ui toggle checkbox" data-status="5">
                                        <input type="checkbox" name="public">
                                        <label>Ürün test aşamasında. </span> </label>
                                    </div>

                                    <div class="ui toggle checkbox" data-status="6">
                                        <input type="checkbox" name="public">
                                        <label>Sonuçlar hazır.</label>
                                    </div>

                                </div>
                            </div>
                            <div class="column">
                                <div class="qr-code-container">

                                </div>
                                <input class="qr-size" type="number" placeholder="Boyut Giriniz.">
                                <button class="ui right labeled icon button">
                                    <i class="qrcode icon"></i>
                                    Barkod üretmek için tıklayınız.
                                </button>
                            </div>

                        </div>
                        <div class="ui stackable two column grid">
                            <div class="column">
                                <h2>Türkçe Belgeler</h2>
                                <a href="/assets/documents/turkce/inst-hakkında.pdf"
                                   target="_blank">
                                    <button class="ui left labeled icon button">
                                        <i class="qrcode icon"></i>
                                        Belge 1
                                    </button>
                                </a>

                                <a href="/assets/documents/turkce/saglik-dna.pdf"
                                   target="_blank">
                                    <button class="ui left labeled icon button">
                                        <i class="qrcode icon"></i>
                                        Belge 2
                                    </button>
                                </a>

                                <a href="/assets/documents/turkce/saglik-klinik.pdf"
                                   target="_blank">
                                    <button class="ui left labeled icon button">
                                        <i class="qrcode icon"></i>
                                        Belge 3
                                    </button>
                                </a>

                                <a href="/assets/documents/turkce/soy-toplama.pdf"
                                   target="_blank">
                                    <button class="ui left labeled icon button">
                                        <i class="qrcode icon"></i>
                                        Belge 4
                                    </button>
                                </a>
                            </div>
                            <div class="column">
                                <h2>İngilizce Belgeler</h2>
                                <a href="/assets/documents/turkce/inst-hakkında.pdf"
                                   target="_blank">
                                    <button class="ui left labeled icon button">
                                        <i class="qrcode icon"></i>
                                        Belge 1
                                    </button>
                                </a>

                                <a href="/assets/documents/turkce/saglik-dna.pdf"
                                   target="_blank">
                                    <button class="ui left labeled icon button">
                                        <i class="qrcode icon"></i>
                                        Belge 2
                                    </button>
                                </a>

                                <a href="/assets/documents/ingilizce/saglik-klinik.pdf"
                                   target="_blank">
                                    <button class="ui left labeled icon button">
                                        <i class="qrcode icon"></i>
                                        Belge 3
                                    </button>
                                </a>

                                <a href="/assets/documents/ingilizce/soy-toplama.pdf"
                                   target="_blank">
                                    <button class="ui left labeled icon button">
                                        <i class="qrcode icon"></i>
                                        Belge 4
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>

            </div>
        </div>

        <div class="ui fullscreen modal">
            <div class="content generated-qr-container" style="text-align: center">

            </div>
        </div>





