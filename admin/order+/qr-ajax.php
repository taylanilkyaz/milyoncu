
<?php
include('../../lib/phpqrcode/qrlib.php');
include ('../../lib/photo-adder/WriteBelow.php');

if (isset($_GET['context'])){
    $tempDir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/qr-codes/';
    $tempDirr = md5($_GET['context']);
    $codeContents = $_GET['context'];
    $writeBelow = new WriteBelow();
    if (!file_exists($tempDir.$tempDirr.'_L.png')){
        QRcode::png($codeContents, $tempDir. $tempDirr.'_L.png', QR_ECLEVEL_L,12);
        $writeBelow->create_below_image($codeContents,14,$tempDir.$tempDirr.'_L.png',$tempDir.$tempDirr.'_L_sub.png');
    }
    echo md5($_GET['context']);
}
// how to save PNG codes to server




