<?php

class Order{

    function selectIcon($order_status){
        $str = "";
        if ($order_status==0){
            $str .=<<<HTML
HTML;
        }   else if ($order_status==1){
            $str .=<<<HTML
HTML;
        }   else if ($order_status==2){
            $str .=<<<HTML
HTML;
        }   else if ($order_status==3){
            $str .=<<<HTML
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
                     <i class=\"arrow right icon\"></i>
                     <div class=\"content\">
                          <a class=\"header\">Sipariş Verildi - Sipariş No : ". $order_code ." </a>
                          <div class=\"description\"><i class=\"small-information\">".$buyedObj->timeFormat($order_add_time)."</i></div>
                     </div>
                </div>";

        }  if ($order_status>=1){
                $str.=
                    "<div class=\"item\">
                        <i class=\"arrow right icon\"></i>
                        <div class=\"content\">
                            <a class=\"header\">Ürün Hazırlanmaya başlandı</a>
                            <div class=\"description\"><i class=\"small-information\">".$buyedObj->timeFormat($arr[0]['ekleme_zamanı'])."</i></div>
                        </div>
                    </div>";

        }  if ($order_status>=2){
            $str.="
                <div class=\"item\">
                            <i class=\"arrow right icon\"></i>
                            <div class=\"content\">
                                <a class=\"header\">Ürün kargoya teslim edildi.</a>
                                <div class=\"description\"><i class=\"small-information\">".$buyedObj->timeFormat($arr[1]['ekleme_zamanı'])."</i></div>
                            </div>
                        </div>";

        }  if ($order_status>=2){
            $str.="
                <div class=\"item\">
                            <i class=\"arrow right icon\"></i>
                            <div class=\"content\">
                                <a class=\"header\">Kargo takip numarası girildi : ${cargo_no}</a>
                                <div class=\"description\"><i class=\"small-information\">".$buyedObj->timeFormat($arr[1]['ekleme_zamanı'])."</i></div>
                            </div>
                        </div>";

        }  if ($order_status>=3){
            $str.="
                <div class=\"item\">
                            <i class=\"arrow right icon\"></i>
                            <div class=\"content\">
                                <a class=\"header\">Ürün size ulaştı.</a>
                                <div class=\"description\"><i class=\"small-information\">".$buyedObj->timeFormat($arr[2]['ekleme_zamanı'])."</i> </div>
                            </div>
                        </div>";


        }
        $str.="
</div>";



        return $str;

    }
}



