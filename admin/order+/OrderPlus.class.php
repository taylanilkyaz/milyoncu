<?php

class OrderPlus{

    public function getOrderString($order_status){
        if ($order_status==0){
            echo "Sipariş verildi";
        }   else if ($order_status==1){
            echo "Ürün hazırlanmaya başlandı";
        }   else if ($order_status==2){
            echo  "Kargo takip numarası girildi";
        }   else if ($order_status==3){
            echo  "Ürün kullanıcıya ulaştı";
        }   else{
            echo "none";
        }
    }
}