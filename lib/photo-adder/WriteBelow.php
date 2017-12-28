<?php

class WriteBelow{


public function create_below_image($text,$fontSize,$fileName,$outputFileName)
{
    /**
     * Fotoğrafın genişlik ve yükseliğini bulur.
     */
    list($imgWidth, $imgHeight) = getimagesize($fileName);

    /**
     *
     * Gelen fotoğrafa göre genişlik ve uzunluk belirlenir.
     * 20 değeri ile 11 değeri alakalı.
     */
    $canvasWidth = $imgWidth;
    $canvasHeight = $imgHeight + $fontSize;


    /**
     * Gelen fotoğrafa göre boş bir tuval oluşturulur.
     */
    $whiteCanvas = imagecreatetruecolor($canvasWidth, $canvasHeight);

    /**
     * Canvas rengi belirlenir.
     */
    $whiteCanvasColor = imagecolorallocate($whiteCanvas, 255, 255, 255);

    /**
     * Canvas belirlenen renk ile doldurulur.
     */
    imagefill($whiteCanvas, 0, 0, $whiteCanvasColor);


    /**
     * Fotoğraf dosya adı ile alınır
     */
    $png_image = imagecreatefrompng($fileName);

    /**
     * Fotoyu canvasa yerleştir
     */
    imagecopyresampled($whiteCanvas, $png_image, 0, 0, 0, 0, $imgWidth, $imgHeight, $imgWidth, $imgHeight);


    /**
     * Canvasa yazılacak text.
     */
    $blackCanvasTextColor = imagecolorallocate($png_image, 0, 0, 0);

    /**
     * Kullanılacak font.
     */
    $font_path = $_SERVER['DOCUMENT_ROOT'].'/lib/photo-adder/Lato-Bold.ttf';

    /**
     * Ortalama yapmak için gerekli değer.
     */
    $leftPush = $this->calculateTextXPosition($fontSize,mb_strlen($text),$canvasWidth);

    /**
     * Yazıyı fotonun belirlenen yerine bas.
     */
    imagettftext($whiteCanvas, $fontSize, 0, $leftPush, $canvasHeight-30 , $blackCanvasTextColor, $font_path, $text);


    /**
     * Fotoğrafı istenen dosya adında kaydet.
     */
    imagepng($whiteCanvas,$outputFileName);

    /**
     * Mem temizle.
     */
    imagedestroy($whiteCanvas);
}


public function calculateTextXPosition($fontSize,$len,$canvasWidth){
    /**
     * Bir harfin genişliğini bulur.
     */
    $letterWidth = ($fontSize * 3) / 4;

    /**
     * Soldan ne kadar itileceğini canvas boyuna göre hesaplar.
     * İstenen format ortalanması
     */
    $leftPush = ($canvasWidth - ($letterWidth * $len))/2;


    return $leftPush;
}

}