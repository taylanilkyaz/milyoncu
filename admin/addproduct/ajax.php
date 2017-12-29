<?php
    require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
    $uploadfile = PRODUCTIMAGEPATH . basename($_FILES['photo']['name']);
    $productName = $_POST['product-name'];
    $productPrice = floatval($_POST['product-price']);
    $productInfo = $_POST['product-info'];
    $productLongInfo = $_POST['product-long-info'];

    $path_parts = pathinfo($uploadfile);

//yolun 255ten uzun olup olmaması kontrolu
    if (strlen($uploadfile)>255){
        echo "<p>Dosya yolu 255 karakterden fazladır. </p>";
    }
//infonun 255ten uzun olup olmaması kontrolu
    if (strlen($productInfo)>255){
        echo "<p>Girilen ürün açıklaması 255 karakterden fazladır. </p>";
    }
//resmin boyutunu 2mb'den fazla olması kontrolu
    if ($_FILES['photo']['size']>2000000){
        echo "<p>Resmin boyutu 2MB'dan büyüktür. </p>";
    }

    $nameOfFile = "";
//eğer aynı isimde dosya varsa sonuna 2-3-4 getirilerek değiştirilir
    if (file_exists($uploadfile)){
        for ($i = 2 ; $i< 1000 ; $i++){
            $nameOfFile = $path_parts['filename'] . $i . "." . $path_parts['extension'];
            if (!file_exists(PRODUCTIMAGEPATH . $nameOfFile))
                break;
        }
        $uploadfile = PRODUCTIMAGEPATH . $nameOfFile;
    }
//dosyayı klasöre kaydeder
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
        echo "<p>Dosya başarılı şekilde yüklendi ve kaydedildi, adresi burada.</p>";
        echo $uploadfile;
    } else {
        echo "<p>Upload failed";
    }

    $path_parts = pathinfo($uploadfile);
    $nameOfFile=$path_parts['filename'].".".$path_parts['extension'];

    $object2 = new ProductDatabase();
    $object = new Product(null,$productName,$productPrice,$productInfo,$nameOfFile,0,$productLongInfo,1);
    $_SESSION['message']=$object2->insertProduct($object);


redirect_javascript("/admin/addproduct/index.php",1000);

?>