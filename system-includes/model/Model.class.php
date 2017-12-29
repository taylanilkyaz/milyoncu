<?php

class Model{
    public static function timeFormat($order_date){

        @setlocale(LC_ALL, 'turkish');
        $datetime_strtotime = strtotime($order_date);
        $veritabani_zaman = strftime("%d.%m.%Y, %A, %H.%M",$datetime_strtotime);
        $date    = iconv('latin5','utf-8',$veritabani_zaman);
        return $date;
    }
}
