<?php
require "../buy/Buy.class.php";
$buyObj = new Buy();
$user_id = $_SESSION['id'];
//$arr = $buyObj->getAllBasketForPage($user_id);
?>


<div id="sepetim-segment" class="ui fluid container">
    <form class="ui large form" action="../odeme/teslimat-bilgileri" method="get">
        <div class="ui stackable centered grid" id="sepetim-top-grid">
            <div class="three wide computer column"></div>
            <div class="center aligned eight wide computer column">
                <div class="ui segment left aligned" id="sepet-id">
                    <span class="ui header" id="titlecolor"><b>Sepetim</b></span>

                    <div class="ui divider"></div>
                    <div id="product-container">

                    </div>
                </div>
            </div>
            <div class="left floated three wide tablet three wide computer column ">
                <div class="ui segment" id="fixed-part-id-sepetim">
                    <h1 class="ui header" id="rightscreen"><b>Sipariş Özeti</b>
                        <div class="sub header right aligned" id="count-container"><span></span></div>
                    </h1>
                    <div class="ui divider"></div>
                    <div class="ui header" id="rightscreen-odtu">Ödenecek Tutar</div>
                    <div class="ui header" id="price"><b><i class="lira icon"></i><span></span></b></div>
                    <a href="../odeme/teslimat-bilgileri/index.php" class="ui primary submit button" id="alisveris-tamamla">Alışverişi Tamamla<i class="chevron right icon"></i></a>
                </div>
            </div>
        </div>

    </form>
</div>