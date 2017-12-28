<?php

/**
 * Debug işlemlerini kolaylaştırmak için oluşturulmuştur.
 */

class DebugHelper{

    public function printInfoMessage($message){
        echo "<div style='font-size:20px;margin: 10px 0px;padding:12px;color: #00529B;background-color: #BDE5F8;'>INFO : $message</div>";
    }

    public function printSuccessMessage($message){
        echo "<div style='font-size:20px;margin: 10px 0px;padding:12px;color: #4F8A10;background-color: #DFF2BF;'>SUCCESS : $message</div>";
    }

    public function printWarningMessage($message){
        echo "<div style='font-size:20px;margin: 10px 0px;padding:12px;color: #9F6000;background-color: #FEEFB3;'>WARNING : $message</div>";
    }

    public function printErrorMessage($header,$message){
        $var = "<div class=\"ui icon message\">
            <i class=\"inbox icon\"></i>
            <div class=\"content\">
                <div class=\"header\"> {$header}</div>
                <p>{$message}</p>
            </div>
        </div>";

        echo $var;
    }
}