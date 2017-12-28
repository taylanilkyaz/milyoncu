
<?php
include('phpqrcode/qrlib.php');

if (isset($_GET['context'])){
    $tempDir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/qr-codes/';
    $tempDirr = md5($_GET['context']);
    $codeContents = $_GET['context'];
    if (!file_exists($tempDir.$tempDirr.'_L.png')){
        QRcode::png($codeContents, $tempDir. $tempDirr.'_L.png', QR_ECLEVEL_L,20);
        QRcode::png($codeContents, $tempDir. $tempDirr.'_M.png', QR_ECLEVEL_M,20);
        QRcode::png($codeContents, $tempDir. $tempDirr.'_Q.png', QR_ECLEVEL_Q,20);
        QRcode::png($codeContents, $tempDir. $tempDirr.'_H.png', QR_ECLEVEL_H,20);
    }
    echo md5($_GET['context']);
}
// how to save PNG codes to server




