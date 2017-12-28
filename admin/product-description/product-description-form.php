<!--
eklenmek istenen ürünlerin resmi, fiyatı, ismi ve açıklaması alınır
-->
<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
$productName = $_GET['name'];
$productName = str_replace("%"," ",$productName);
getAdminHeader();
$productDatabaseObj = new ProductDatabase();
$categoriesDatabaseObj = new CategoriesDatabase();
$product = $productDatabaseObj->getProductByName($productName);
$commentDatabaseObj = new CommentDatabase();
$comments = $commentDatabaseObj->getAllCommentsForProduct($product->getId());
$categoryName = $categoriesDatabaseObj->getCategoryName($product->getCategory());
$commentModelObj = [];
for ($i = 0; $i < count($comments); $i++) {
    array_push($commentModelObj, $comments[$i]);
}

$rateArray = $commentDatabaseObj->getRateArray($product->getId());
$sum = 0;
$weightSum = 0;
$floorAverage = 0;
for ($i = 0; $i < count($rateArray); $i++) {
    $sum += $rateArray[$i];
    $weightSum += $rateArray[$i] * ($i + 1);
}
if ($sum != 0) {
    $average = $weightSum / $sum;
    $average = number_format($average, 1, '.', '');
    $fiveStarRate = floor($rateArray[4] / $sum * 100);
    $fourStarRate = floor($rateArray[3] / $sum * 100);
    $threeStarRate = floor($rateArray[2] / $sum * 100);
    $twoStarRate = floor($rateArray[1] / $sum * 100);
    $oneStarRate = floor($rateArray[0] / $sum * 100);
    $floorAverage = floor($average);
}

$userDatabaseObj = new UserDatabase();
?>
<div class="ui segment"style="margin-left: -1.2%">
    <div class="ui big breadcrumb">
        <a class="section" href="/home/index.php">Ana Sayfa</a>
        <i class="right chevron icon divider"></i>
        <a class="section" href="/admin/buy/index.php">Satın Al</a>
        <i class="right chevron icon divider"></i>
        <a class="section" href="#"><?php echo ucwords($categoryName['name']) ?></a>
        <i class="right chevron icon divider"></i>
        <div class="active section"><?php echo $product->getName() ?></div>
    </div>
</div>
<div class="ui stackable grid" id="product-description-id">
    <div class="eight wide center aligned column" style="border: 2px solid #F5F5F5 ;padding-top: 3%;" >
        <img  style="max-width: 256px; width: 100%" src='/assets/images/productimage/512/<?= $product->getImagePath()?>'
             >
    </div>

    <div class="eight wide column">
        <div class="field" id="product-id-field" style="display: none;"><?php echo $product->getId() ?></div>
        <div class="field" id="product-name-field"><h2><?php echo $product->getName() ?></h2>
        </div>
        <div class="field">
            <div class="product-sale-prices" style="width: 100% ; padding-top: 10px>
                <div class="ui grid">
            <div style="display: none;">
                <div class="three wide grid">
                    <div class="sale-part">%6</div>
                </div>
                <div class="seven wide grid">
                    <div class="price-line">
                        <div class="currency-line">
                            <span><strike>225,00 TL</strike></span>
                        </div>
                        <div class="discount-price">
                            <span class="product-price">
                                211,50 TL
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <span id="price-part" style="display: inline"><?php echo $product->getPrice() ?> <i class="lira icon"></i></span>

            <div class="six wide grid"  style="margin-top: 1%">
                <div class="ui huge star rating" id="product-rate" data-rating="<?= $floorAverage?>" data-max-rating="5"></div>

                <div class="ui stackable labels">
                    <a class="ui label" id="comment">
                        Yorum (<span></span>)
                    </a>
                    <span>|</span>
                    <a class="ui label" id="product-comment-button">
                        Yorum Yap
                    </a>
                </div>

            </div>
        </div>
    </div>

    <br>
    <!-- indirim yoksa gözükmeyecek-->
    <div class="ui divider"></div>
    <div class="price-unit-box">
        <div class="ui form">
            <div class="fields flex-product-examined">
                <div class="six wide field">
                    <div class="count-input" id="product-count-input">
                        <a class="incr-btn" data-action="decrease" href="#" title="Azalt">&minus;</a>
                        <input class="quantity" type="text" name="quantity" value="1 adet"/>
                        <a class="incr-btn" data-action="increase" href="#" title="Arttır">&plus;</a>
                    </div>
                </div>
                <div class="ten wide field">
                    <div class="ui bottom attached button" id="add-basket-button">
                        <i class="big add icon"></i>
                        Sepete Ekle
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (count($comments) == 0) {
        ?>
        <div class="ui segment">
            <div class="field">     <!-- eger daha önceden yorum yapılmışsa gözükmeyecek-->
                <div class="content">
                    <div class="header">İlk yorumu sen yaz</div>
                    <div class="meta">
                        <span class="date">Bu ürünle ilgili fikirlerini diğer kullanıcılarla paylaş.</span>
                    </div>
                    <button class="ui button" id="product-description-button">
                        Yorumları Görüntüle
                    </button>

                </div>
                <br>
            </div>
        </div>
        <?php
    }
    ?>


    <div class="ui divider"></div>
</div>

</div>

<div class="ui top attached tabular menu" id="tab-id">
    <a class="item active" data-tab="first">Ürün Açıklaması</a>
    <a class="item" data-tab="second">Yorumlar</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="first">
    <?php
    $lowerStr = mb_strtolower($productName);
    $lowerStr = str_replace(" ","-",$lowerStr);
    $lowerStr = str_replace("ü","u",$lowerStr);
    $lowerStr = str_replace("ç","c",$lowerStr);
    $lowerStr = str_replace("ı","i",$lowerStr);
    $lowerStr = str_replace("\'","",$lowerStr);
    $lowerStr = str_replace("ş","s",$lowerStr);
    $lowerStr = str_replace("ö","o",$lowerStr);
    $lowerStr = str_replace("ğ","g",$lowerStr);

    ?>
    <?php
    ?>
    <div class="container">
        <?php echo $product->getLongDesc()?>
    </div>
    <h2 class="ui header">Detaylı Ürün İnceleme sayfası için <a href="/bilgi/<?=urlencode($lowerStr) ?>">buraya tıklayın</a> </h2>

</div>
<div class="ui bottom attached tab segment" data-tab="second">
    <div id="rating-bar-container">
    </div>

    <form class="ui reply form" id="comment-form" style="margin-top: 4%">

        <button class="ui button" id="yorum-yap-button">
            <i class="talk outline icon"></i>Yorum Yap
        </button>
        <div id="form-click-submit" style="display: none;">
            <div class="ui items">
                <div class="item">
                    <div class="content">
                        <a class="header" id="form-cancel-button">Yorum Yap</a>
                    </div>
                </div>
            </div>

            <div class="ui massive star rating" id="comment-rate" data-rating="0" data-max-rating="5"
                 style="padding-bottom: 20px"></div>
            <div class="field">
                <textarea id="content-id" placeholder="Yorum" rows="6"></textarea>
            </div>
            <div class="field">
                <textarea id="description-title-id" rows="3" placeholder="Yorum Başlığı(Opsiyonel)"></textarea>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="example" checked="checked" id="anonymous-id">
                    <label>İsmim görünsün</label>
                </div>
            </div>
            <div class="ui primary submit labeled icon button" id="submit-comment">
                <i class="icon send"></i>Gönder
            </div>
        </div>
    </form>
    <div class="ui divider"></div>
    <div class="left floated left aligned six wide column">
        <table id="comment-table" class="ui celled table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th></th>
            </tr>
            </thead>
            <tbody id="comment-tbody">

            </tbody>
        </table>
    </div>
</div>
</div>