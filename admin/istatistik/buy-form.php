<div id="buy-container">

    <?php $buy = new Buy();
    $mean = $buy->getMeanPrice();
    $type = $buy->getProductCount();
    $cargocom = $buy ->getMostCargo();?>

    <h1 class="ui center aligned header">Ortalama Ürün Fiyatı : <?php echo $mean["AVG(fiyat)"]; ?> TL </h1>
    <div class="ui divider"></div>
    <h1 class="ui center aligned header">Toplam Ürün Çeşidi : <?php echo $type["COUNT(*)"]; ?></h1>
    <div class="ui divider"></div>
    <h1 class="ui center aligned header">En Çok Kullanılan Kargo Şirketi : <?php echo $cargocom["isim"]." (".$cargocom["value"].")"; ?> </h1>
    <div class="ui divider"></div>
    <h1 class="ui center aligned header">En Pahalı Üç Ürün</h1>
    <div class="ui divider"></div>
    <div class="ui four column doubling stackable centered grid">
        <?php
        /**
         * @var $product Product
         */
        $buy = new Buy();
        $products = $buy->getMaxThree();
        $i = 0;
        foreach ($products as $product) {?>

            <div class="center aligned centered column">
                <div data-id="<?= $i++; ?>"class="ui segment">

                    <img class="ui centered fluid image"
                         src="/assets/images/productimage/512/<?=$product->getImagePath() ?>">

                    <div class="bottom-detail">
                        <p class="name"><?php echo $product->getName() ?></p>
                        <p class="price"><i class="lira icon"></i><?php echo floor($product->getPrice()); ?></p>
                        <p class="desc"><?php echo substr($product->getShortDesc(),0,62)."..." ?></p>
                    </div>
                </div>

                <div class="add-basket-button" >
                    <i class="add circle icon"></i>Sepete Ekle
                </div>

                <div class="urun-incele-button" href="../product-description?name=<?php echo $product->getName();?>">
                    <i class="search orange icon"></i>Detaylı İncele
                </div>
            </div>

        <?php } ?>
    </div>
    <h1 class="ui center aligned header">En Ucuz Üç Ürün</h1>
    <div class="ui divider"></div>
    <div class="ui four column doubling stackable centered grid">
        <?php
        /**
         * @var $product Product
         */
        $buy = new Buy();
        $products = $buy->getMinThree();
        $i = 0;
        foreach ($products as $product) {?>

            <div class="center aligned centered column">
                <div data-id="<?= $i++; ?>"class="ui segment">

                    <img class="ui centered fluid image"
                         src="/assets/images/productimage/512/<?=$product->getImagePath() ?>">

                    <div class="bottom-detail">
                        <p class="name"><?php echo $product->getName() ?></p>
                        <p class="price"><i class="lira icon"></i><?php echo floor($product->getPrice()); ?></p>
                        <p class="desc"><?php echo substr($product->getShortDesc(),0,62)."..." ?></p>
                    </div>
                </div>

                <div class="add-basket-button" >
                    <i class="add circle icon"></i>Sepete Ekle
                </div>

                <div class="urun-incele-button" href="../product-description?name=<?php echo $product->getName();?>">
                    <i class="search orange icon"></i>Detaylı İncele
                </div>
            </div>

        <?php } ?>
    </div>
    <h1 class="ui center aligned header">En Çok Satan Ürün </h1>
    <div class="ui divider"></div>
    <div class="ui four column doubling stackable centered grid">
        <?php
        /**
         * @var $product Product
         */
        $buy = new Buy();
        $products = $buy->getSoldMost();
        $i = 0;
        foreach ($products as $product) {?>

            <div class="center aligned centered column">
                <div data-id="<?= $i++; ?>"class="ui segment">

                    <img class="ui centered fluid image"
                         src="/assets/images/productimage/512/<?=$product->getImagePath() ?>">

                    <div class="bottom-detail">
                        <p class="name"><?php echo $product->getName() ?></p>
                        <p class="price"><i class="lira icon"></i><?php echo floor($product->getPrice()); ?></p>
                        <p class="desc"><?php echo substr($product->getShortDesc(),0,62)."..." ?></p>
                    </div>
                </div>

                <div class="add-basket-button" >
                    <i class="add circle icon"></i>Sepete Ekle
                </div>

                <div class="urun-incele-button" href="../product-description?name=<?php echo $product->getName();?>">
                    <i class="search orange icon"></i>Detaylı İncele
                </div>
            </div>

        <?php } ?>
    </div>
</div>
<div id="error-dimmer" class="ui page dimmer">
    <div class="content">
        <h2 class="ui inverted icon header">
            <i class="warning icon"></i>
            Üye olmadan satın alma işlemi yapamazsınız.
            <br>
            <br>

            <a href="/register" class="item">
                <div class="ui primary button">Kayıt Ol</div>
            </a>

            <a href="/register" class="item" style="padding-bottom: 20px">
                <div class="ui primary button">Giriş Yap</div>
            </a>
            <br>
            <br>
            <a id="href-id" href="" class="item">
                <div class="ui primary button">Üye olmadan ürün incelemek için tıklayınız.</div>
            </a>
        </h2>

    </div>
</div>

