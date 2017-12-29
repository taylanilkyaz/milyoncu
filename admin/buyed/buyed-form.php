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
<?php
if (count($arr)!=0){
    ?>
    <br>
    <div style="text-align: center; ">
        <button class="ui large green button" onClick="doExport('#buyed-table', {type: 'doc'});">
            DOC Dosyası İndir
        </button>
        <button class="ui large blue button" onClick="doExport('#buyed-table', {type: 'json'});">
            JSON Dosyası İndir
        </button>
    </div>
    <?php
}
?>
<script type="text/javascript" src="/lib/tableExport/libs/js-xlsx/xlsx.core.min.js"></script>
<script type="text/javascript" src="/lib/tableExport/libs/FileSaver/FileSaver.min.js"></script>
<script type="text/javascript" src="/lib/tableExport/libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="/lib/tableExport/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script type="text/javascript" src="/lib/tableExport/libs/html2canvas/html2canvas.min.js"></script>
<script type="text/javascript" src="/lib/tableExport/tableExport.js"></script>

<script type="text/javaScript">

    function doExport(selector, params) {
        var options = {
            //ignoreRow: [1,11,12,-2],
            //ignoreColumn: [4,5,6,7],
            //pdfmake: {enabled: true},
            fileName: 'SatinAldiklarim'
        };

        $.extend(true, options, params);

        $(selector).tableExport(options);
    }

    function DoOnCellHtmlData(cell, row, col, data) {
        var result = "";
        if (data != "") {
            var html = $.parseHTML( data );

            $.each( html, function() {
                if ( typeof $(this).html() === 'undefined' )
                    result += $(this).text();
                else if ( $(this).is("input") )
                    result += $('#'+$(this).attr('id')).val();
                else if ( $(this).is("select") )
                    result += $('#'+$(this).attr('id')+" option:selected").text();
                else if ( $(this).hasClass('no_export') !== true )
                    result += $(this).html();
            });
        }
        return result;
    }

    function DoOnCsvCellData(cell, row, col, data) {
        var result = data;
        if (result != "" && row > 0 && col == 0) {
            result = "\x1F" + data;
        }
        return result;
    }

    function DoOnXlsxCellData(cell, row, col, data) {
        var result = data;
        if (result != "" && (row < 1 || col != 0)) {
            if ( result == +result )
                result = +result;
        }
        return result;
    }

    function DoOnMsoNumberFormat(cell, row, col) {
        var result = "";
        if (row > 0 && col == 0)
            result = "\\@";
        return result;
    }

</script>
