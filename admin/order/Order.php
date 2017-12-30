<?php

class Order{

    function selectIcon($order_status){
        $str = "";
        if ($order_status==0){
            $str .=<<<HTML
            <i class="dropbox big icon"></i> 
HTML;

        }   else if ($order_status==1){
            $str .=<<<HTML
            <i class="users big icon"></i> 
HTML;
        }   else if ($order_status==2){
            $str .=<<<HTML
            <i class="shipping big icon"></i> 
HTML;
        }   else if ($order_status==3){
            $str .=<<<HTML
            <i class="marker big icon"></i> 
HTML;
        }
        return $str;
    }

    function getOrderStatus($order_code,$order_status,$order_add_time){
        $buyedObj = new BuyedProductsDatabase();
        $obj = new StatusUpdateDatabase();
        $relationObj = new OrderBuyRelationDatabase();
        if ($order_status>1)
            $cargo_no = $relationObj->getCargoNo($order_code);
        $arr = $obj->getStatusUpdateTimes($order_code);
        $str = "
<div class=\"ui list\">";

        if ($order_status>=0){
            $str.=
                "<div class=\"item\">
                     <i class=\"dropbox big icon\"></i>
                     <div class=\"content\">
                          <a class=\"header\">Sipariş Verildi - Sipariş No : ". $order_code ." </a>
                          <div class=\"description\">Sipariş isteği başarıyla alındı. <i class=\"small-information\">".$buyedObj->timeFormat($order_add_time)."</i></div>
                     </div>
                </div>";

        }  if ($order_status>=1){
                $str.=
                    "<div class=\"item\">
                        <i class=\"users big icon\"></i>
                        <div class=\"content\">
                            <a class=\"header\">Ürün Hazırlanmaya başlandı</a>
                            <div class=\"description\">Ürün hazırlıkları yapılıyor. <i class=\"small-information\">".$buyedObj->timeFormat($arr[0]['ekleme_zamanı'])."</i></div>
                        </div>
                    </div>";

        }  if ($order_status>=2){
            $str.="
                <div class=\"item\">
                            <i class=\"shipping big icon\"></i>
                            <div class=\"content\">
                                <a class=\"header\">Ürün kargoya teslim edildi.</a>
                                <div class=\"description\">Ürün hazırlanması bitti ve kargoya teslim edildi.<i class=\"small-information\">".$buyedObj->timeFormat($arr[1]['ekleme_zamanı'])."</i></div>
                            </div>
                        </div>";

        }  if ($order_status>=2){
            $str.="
                <div class=\"item\">
                            <i class=\"sort numeric ascending big icon\"></i>
                            <div class=\"content\">
                                <a class=\"header\">Kargo takip numarası girildi.</a>
                                <div class=\"description\">Kargo takip no : ${cargo_no} <i class=\"small-information\">".$buyedObj->timeFormat($arr[1]['ekleme_zamanı'])."</i></div>
                            </div>
                        </div>";

        }  if ($order_status>=3){
            $str.="
                <div class=\"item\">
                            <i class=\"marker big icon\"></i>
                            <div class=\"content\">
                                <a class=\"header\">Ürün size ulaştı.</a>
                                <div class=\"description\">Kargo ürünü başarıyla teslim etti. <i class=\"small-information\">".$buyedObj->timeFormat($arr[2]['ekleme_zamanı'])."</i> </div>
                            </div>
                        </div>";


        }
        $str.="
</div>";



        return $str;

    }
}



