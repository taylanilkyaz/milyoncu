<?php
$csrf_salt = base64_encode(openssl_random_pseudo_bytes(16));
$_SESSION['csrf'] = $csrf_salt;
?>

<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo "<script type='text/javascript'>alert('${message}');</script>";
    unset ($_SESSION['message']);
}
?>
<script>
  $(function () {
    $('.ui.dropdown').dropdown()
  });
</script>
<!--
eklenmek istenen ürünlerin resmi, fiyatı, ismi ve açıklaması alınır
-->
<div class="ui stackable centered grid" id="add-product-container">

    <div class="middle aligned ten wide center aligned column">
        <div class="ui selection dropdown ust-kategori" style="margin-bottom: 10px;margin-right: 20px">
            <input type="hidden" name="ust_kategori" id="ust_kategori"  onchange="getState()" >
            <i class="dropdown icon"></i>
            <div class="default text">Kategori</div>
            <div class="menu">
                <?php
                $category = new CategoriesDatabase();
                for ($i = 1; $i < 5; $i++) {
                    $categoryName = $category->getCategoryNameNonSeq($i);
                    ?>
                    <div class="item" data-value="<?php echo $i; ?>"><?php echo ucwords($categoryName)?></div>
                <?php } ?>
            </div>
        </div>

        <div class="ui selection dropdown alt-kategori" style="margin-bottom: 10px;margin-left: 20px">
            <input type="hidden" name="alt_kategori" id="alt_kategori"  onchange="getState2()" >
            <i class="dropdown icon"></i>
            <div class="default text">Alt Kategori</div>
            <div id="alt_menu" class="menu">

            </div>
        </div>

        <form class="ui large form" enctype="multipart/form-data" method="POST" action="ajax.php">
            <input type="hidden" name="csrf" id="csrf_salt" value="<?php echo $_SESSION['csrf'] ?>"/>

            <div class="field">
                <div class="ui fluid input">
                    <input type="file" name="photo">
                </div>
            </div>

            <div class="field">
                <div class="ui fluid input">
                    <input type="text" name="product-name" placeholder="Ürün ismi">
                </div>
            </div>

            <div class="field">
                <div class="ui fluid input">
                    <input type="text" name="product-price" placeholder="Ürün Fiyatı">
                </div>
            </div>

            <div class="field">
                <div class="field">
                    <textarea id="product-text-area" name="product-info" placeholder="Kısa Ürün Açıklaması"></textarea>
                </div>
            </div>

            <div class="field">
                <div class="field">
                    <textarea id="product-text-area" name="product-long-info"
                              placeholder="Uzun Ürün Açıklaması"></textarea>
                </div>
            </div>

            <div class="field">
                <button class="large ui blue button" id="add-product-button">
                    Kaydet
                </button>
            </div>

        </form>
    </div>
</div>
<script>

    function getState(val) {

        $("#alt_menu").empty();
        var value = $("#ust_kategori").val();
        if (value==='1'){
            var $menu =  $('.alt-kategori').find('.menu');

            $menu.append('<div class="item" data-value="1">Fall</div>');
            $menu.append('<div class="item" data-value="2">Summer</div>');

            //reinitialize drop down
            $('.ui.dropdown.seasons').dropdown();
        } else  if (value==='2'){
            var $menu =  $('.alt-kategori').find('.menu');

            $menu.append('<div class="item" data-value="1">Salak</div>');

            //reinitialize drop down
            $('.ui.dropdown.seasons').dropdown();
        } else  if (value==='3'){
            var $menu =  $('.alt-kategori').find('.menu');

            $menu.append('<div class="item" data-value="1">Canım</div>');
            $menu.append('<div class="item" data-value="2">Tatlım</div>');
            $menu.append('<div class="item" data-value="3">Şekerim</div>');

            //reinitialize drop down
            $('.ui.dropdown.seasons').dropdown();
        } else {

        }
    }
    function getState2(val) {
        var value = $("#alt_kategori").val();

    }
</script>