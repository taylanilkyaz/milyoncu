<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
$order_code = $_POST['order_code'];
$targetfolder = $_SERVER['DOCUMENT_ROOT'] . "/assets/results/";

$targetfolder = $targetfolder . md5($order_code).".pdf";

$ok = 1;

$file_type = $_FILES['file']['type'];

if ($file_type == "application/pdf") {

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
        //dosya başarılı şekilde yüklendi ise kullanıcıya mail gönder
        $ok=2;
    } else {
        $ok=0;
    }

} else {
    $ok=-1;
}
redirect_javascript('/admin/result-upload/index.php?success='.$ok);
?>