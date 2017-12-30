<script src="/lib/functional/clipboard.min.js"></script>

<?php

require "Order.php";
$orderObj = new Order();
$obj = new OrderBuyRelationDatabase();
$buyedObj = new BuyedProductsDatabase();
$arr = $obj->getAllOrdersForUser($_SESSION['id']);
?>

<div class="ui page dimmer" id="copy-dimmer">
    <div class="content">
        <div class="center">
            <h2>
                <i class="keyboard icon"></i>
                Kopyalandı
            </h2>
        </div>
    </div>
</div>

<div id="order-container" class="goodmargin" style="margin-left: 150px ; margin-right: 150px">
    <div class="ui divider"></div>

    <div class="ui stackable centered one column  grid">

        <div class="sixteen wide column">
            <div class="ui styled fluid accordion">
                <?php
                for ($i = 0;
                $i < count($arr);
                $i++){
                //kullanıcının bir siparişinin içinde bulunan ürünler ve adetleri alındı
                $res = $buyedObj->getAllBuyedProducts($arr[$i]['sipariş_kodu']);
                $resList = array();
                while ($row = $res->fetch_assoc()) {
                    array_push($resList, Product::__constructByMysqliRow($row, true));
                }

                //siparişin bitip bitmediği kontrolü
                    ?>
                    <div class="title">
                        <div class="ui grid">
                            <div class="sixteen wide column">
                                <i class="dropdown icon"></i>
                                <div class="header-2 sline">
                                    <?php for ($j = 0; $j < count($resList); $j++) {
                                        $oneProduct = $resList[$j];
                                        /**
                                         * @var $oneProduct Product
                                         */
                                        echo $oneProduct->getCount() . " Adet " . $oneProduct->getName();
                                        if ($j != count($resList) - 1) {
                                            echo ", ";
                                        }
                                    } ?>

                                </div>
                                <?php
                                echo $orderObj->selectIcon($arr[$i]['sipariş_durumu']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="active content">
                        <?php if ($arr[$i]['sipariş_durumu'] >= 2) {
                            ?>
                            <h3 class="header sline"> Kargo No : </h3>
                            <div class="ui action input" >
                                <input type="text" value="<?php echo $arr[$i]['kargo_numarası'] ?>">
                                <button style="margin-left: 5px" data-clipboard-text="<?php echo $arr[$i]['kargo_numarası'] ?>"
                                        class="ui teal right labeled icon button btn">

                                    <i class="copy icon"></i>
                                    Kopyala
                                </button>
                            </div>

                            <?php
                        }
                        $var = $orderObj->getOrderStatus($arr[$i]['sipariş_kodu'], $arr[$i]['sipariş_durumu'], $arr[$i]['ekleme_zamanı']);
                        echo $var;
                        ?>

                    </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>

    </div>

    <script>
        (function () {
            new Clipboard('.btn');
        })();
    </script>





