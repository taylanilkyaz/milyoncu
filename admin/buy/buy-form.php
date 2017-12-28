<div id="buy-container">
    <?php
    if (isset($_GET['value']))
    {
        $subCategoryId = $_GET['value'];
        $subCategory = new SubCategoryDatabase();
        $subCategoryName = $subCategory->getCategoryName($subCategoryId);
        ?>

        <h1 class="ui center aligned header"><?php echo ucwords($subCategoryName) ?></h1>
        <div class="ui big breadcrumb">
            <a class="section" href="/detail/index.php">Ürünler</a>
            <i class="right chevron icon divider"></i>
            <div class="active section"><?php echo ucwords($subCategoryName) ?></div>
        </div>
        <div class="ui divider"></div>
        <div class="ui four column doubling stackable centered grid">
        <?php
        /**
         * @var $product Product
         */
        $buy = new Buy();
        $products = $buy->getAllProductsForSubCategory($subCategoryId);
        $i = 0;
        foreach ($products as $product) {?>

                <div class="center aligned centered column">
                    <div data-id="<?= $i++; ?>"class="ui segment<?php if ($product->getExpertActive() == 1) {  echo " featured"; }?>">

                        <img class="ui centered fluid image"
                             src="/assets/images/productimage/512/<?=$product->getImagePath() ?>">

                        <div class="bottom-imgs">
                            <div class="center aligned centered eight wide column">
                                <div class="x wtf-red active-x"></div>
                                <div class="x wtf-blue"></div>
                                <div class="x wtf-green"></div>
                            </div>
                        </div>

                        <div class="bottom-detail">
                            <p class="name"><?php echo $product->getName() ?></p>
                            <p class="price"><i class="lira icon"></i><?php echo floor($product->getPrice()); ?></p>
                            <p class="desc"><?php echo substr($product->getShortDesc(),0,62)."..." ?></p>
                        </div>
                    </div>

                    <?php if ($product->getExpertActive() == 1) {?>
                        <div class="top-event">
                            Uzman Önerisi
                        </div>
                    <?php } ?>

                    <div class="add-basket-button" >
                        + Sepete Ekle
                    </div>

                    <div class="urun-incele-button" href="../product-description?name=<?php echo $product->getName();?>">
                        + Ürün İncele
                    </div>
                </div>

        <?php
        }?>
        </div>

    <?php
    } else {
        for ($i = 1; $i < 5; $i++) {
            $buy = new Buy();
            $category = $buy->getAllCategories($i);

            ?>
            <h1 class="ui center aligned header"><?php echo ucwords($category['name']) ?></h1>
            <div class="ui divider"></div>
            <div class="ui four column doubling stackable centered grid" style="padding-bottom: 20px">
                <?php
                $products = $buy->getAllProducts($i);
                foreach ($products as $product) {
                    /**
                     * @var $product Product
                     */
                    ?>
                    <div class="center aligned centered column">
                        <div class="ui segment <?php
                        if ($product->getExpertActive() == 1) {
                            ?>
                                featured
                <?php
                        }
                        ?>">
                            <img class="ui centered fluid image"
                                 src="/assets/images/productimage/512/<?=$product->getImagePath() ?>">

                            <div class="bottom-imgs">
                                <div class="center aligned centered eight wide column">
                                    <div class="x wtf-red active-x"></div>
                                    <div class="x wtf-blue"></div>
                                    <div class="x wtf-green"></div>
                                </div>
                            </div>

                            <div class="bottom-detail">
                                <p class="name"><?php echo $product->getName() ?></p>
                                <p class="price"><i class="lira icon"></i>
                                    <?php echo floor($product->getPrice()); ?></p>
                                <p class="desc"><?php echo substr($product->getShortDesc(),0,62)."..." ?></p>
                            </div>
                            <?php
                            if ($product->getExpertActive() == 1) {
                                ?>
                                <div class="top-event">
                                    Uzman Önerisi
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        <div class="add-basket-button">
                            + Sepete Ekle
                        </div>
                        <div class="urun-incele-button" href="../product-description?name=<?php echo $product->getName()?>">
                            + Ürün İncele
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>

            <?php
        }
    }
    ?>
</div>
<div id="error-dimmer" class="ui page dimmer">
    <div class="content">
        <h2 class="ui inverted icon header">
            <i class="warning icon"></i>
            Üye olmadan satın alma işlemi yapamazsınız.
            <br>
            <a href="/register" class="item">
                <div class="ui primary button">Kayıt Ol</div>
            </a>
            <a href="/register" class="item" style="padding-bottom: 20px">
                <div class="ui primary button">Giriş Yap</div>
            </a>
            <br>
            <a id="href-id" href="" class="item">
                <div class="ui primary button">Üye olmadan ürün incelemek için tıklayınız.</div>
            </a>
        </h2>

    </div>
</div>

