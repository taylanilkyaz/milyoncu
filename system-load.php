<?php
/**
 * -ABSPATH constantı değeri verilir.
 * -Config dosyası yüklenir
 * -Settings dosyası yüklenir
 */

/** ABSPATH' i tanımlar */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
}




if ( file_exists( ABSPATH . 'system-config.php') ) {

    /**
     * Config file 'i yüklüyorum.
     */
    require_once( ABSPATH . 'system-config.php' );


    /**
     * Sistem ayarlarını yüklüyorum ve ilgili dosyaları çağırıyorum.
     */
    require_once(ABSPATH . 'system-settings.php');


}else{
    die('system-config dosyası bulunamadı.');
}