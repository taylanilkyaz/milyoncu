<?php

require "../order/Order.php";
$orderObj = new Order();
$obj = new OrderBuyRelationDatabase();
$buyedObj = new BuyedProductsDatabase();
$arr = $obj->getAllOrdersForUser($_SESSION['id']);
?>

<table id="buyed-table" class="ui sortable very basic large table">
    <thead>
    <tr>
        <th class="four wide">Paket Adı</th>
        <th class="two wide">Fiyat</th>
        <th class="one wide">Sayısı</th>
        <th class="four wide">Tarihi</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < count($arr); $i++) {
        //kullanıcının bir siparişinin içinde bulunan ürünler ve adetleri alındı
        $res = $buyedObj->getAllBuyedProducts($arr[$i]['order_code']);
        $resList = array();
        while ($row = $res->fetch_assoc()) {
            array_push($resList, Product::__constructByMysqliRow($row, true));
        }
        $paketAdi = "";
        $totalPrice = 0;
        $totalCount = 0;
        for ($j = 0; $j < count($resList); $j++) {
            $oneProduct = $resList[$j];
            /**
             * @var $oneProduct Product
             */
            $totalCount += $oneProduct->getCount();
            $totalPrice += $oneProduct->getPrice() * $oneProduct->getCount();
            $paketAdi .= $oneProduct->getCount() . " Adet " . $oneProduct->getName();
            if ($j != count($resList) - 1) {
                $paketAdi .= ", ";
            }
        }
        ?>
        <tr>
            <td><?php echo $paketAdi ?></td>
            <td><?php echo $totalPrice ?></td>
            <td><?php echo $totalCount ?></td>
            <td><?php echo $arr[$i]['add_time'] ?></td>


        </tr>
        <?php
    }
    ?>
    <?php
    if (count($arr)==0){
        ?>
        <tr>
            <td>Henüz sipariş verilmemiştir.</td>
        </tr>
    <?php
    }
    ?>

    </tbody>
</table>