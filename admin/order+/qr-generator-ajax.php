<?php
include('../../lib/phpqrcode/qrlib.php');
include ('../../lib/photo-adder/WriteBelow.php');

if (isset($_GET['context']) && isset($_GET['size'])){
    $size = $_GET['size'];
    $tempDir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/qr-codes/';
    $tempDirr = md5($_GET['context']);
    $codeContents = $_GET['context'];
    $writeBelow = new WriteBelow();
    if (!file_exists($tempDir.$tempDirr.'_L_'.$size.'.png')){
        QRcode::png($codeContents, $tempDir.$tempDirr.'_L_'.$size.'.png', QR_ECLEVEL_L,$size);
        $writeBelow->create_below_image($codeContents,$size,$tempDir.$tempDirr.'_L_'.$size.'.png',$tempDir.$tempDirr.'_L_'.$size.'_sub.png');
    }
    echo $tempDirr;
}
// how to save PNG codes to server




