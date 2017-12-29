<?php
    require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
    $object2 = new ProductDatabase();
    $nameOfFile = "";
    $productName = $_POST['product_name'];
    $productPrice = floatval($_POST['product_price']);
    $productInfo = $_POST['product_desc'];
    $productLongInfo = $_POST['product_long_desc'];
    $productId = $_POST['product_id'];
//infonun 255ten uzun olup olmaması kontrolu
    if (strlen($productInfo)>255){
        echo "<p>Girilen ürün açıklaması 255 karakterden fazladır. </p>";
    }

    if (strcmp($_FILES['photo']['name'],"")!=0){
        $uploadfile = PRODUCTIMAGEPATH . basename($_FILES['photo']['name']);
        $path_parts = pathinfo($uploadfile);
        //yolun 255ten uzun olup olmaması kontrolu
        if (strlen($uploadfile)>255){
            echo "<p>Dosya yolu 255 karakterden fazladır. </p>";
        }
        //resmin boyutunu 2mb'den fazla olması kontrolu
        if ($_FILES['photo']['size']>2000000){
            echo "<p>Resmin boyutu 2MB'dan büyüktür. </p>";
        }

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
        $object2->editProduct($productName,$productPrice,$productInfo,$nameOfFile,$productId,$productLongInfo);
    }
    else{
        $object2->editProductWithoutImage($productName,$productPrice,$productInfo,$productId,$productLongInfo);
    }


redirect_javascript("/admin/editproduct/index.php",1000);