<?php
$dev = 'localhost';
//$dev = 'milyoncu.dev';

if($dev == 'localhost' || $dev == 'milyoncu.dev'){
    /**Error report Ayarları **/
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}

setlocale(LC_ALL, 'tr_TR.UTF-8');
date_default_timezone_set('Europe/Istanbul');


function redirect($str){
    global $dev;
    header('Location: http://'. $dev . $str);
    exit;
}

function redirect_javascript($str,$delay=0){
    global $dev;
    $redirectScript = <<<script
        <script type="text/javascript">
           setTimeout(function(){ 
                window.location.replace("http://{$dev}{$str}");
                }, $delay);
        </script>
script;
    echo $redirectScript;
}

function isSessionStarted(){
    if (session_status() == PHP_SESSION_NONE) {
        return false;
    }

    return true;
}

function startSessionIfNot(){
    if(!isSessionStarted())
        session_start();

}

function authControl(){

    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){
        return;
    }else{
        require "auth-control/index.php";
        exit;
    }

}

startSessionIfNot();


$DEBUG = true;
/**
 * Template'i ve geliştirme ortamını yükler.
 */
if ( !isset($b4u_did_header) ) {

    //Bir kere yüklenmesini sağlayacak
    $b4u_did_header = true;

    // Sistem kütüphanesini yükle
    require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR.'system-load.php' );

}

spl_autoload_register(function ($class_name) {
    $sources = array(
        DATABASEPATH.$class_name.'.class.php',
        MODELPATH.$class_name.'.class.php',
        HELPERPATH.$class_name.'.class.php',
        );

    $file = debug_backtrace(false,2)[1]['file'];
    $lastDirectory = substr($file,0,strrpos($file,DIRECTORY_SEPARATOR));
    array_push($sources,$lastDirectory . DIRECTORY_SEPARATOR .$class_name .  ".class.php");


    foreach($sources as $dir){
        if(is_readable($dir)){
            require $dir;
            break;
        }
    }

});
