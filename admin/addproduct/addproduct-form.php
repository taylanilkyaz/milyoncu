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
        <form class="ui large form" enctype="multipart/form-data" method="POST" action="ajax.php">

        <div class="ui selection dropdown ust-kategori" style="margin-bottom: 10px;margin-right: 20px">
            <input type="hidden" name="ust_kategori" id="ust_kategori"  onchange="getState()" >
            <i class="dropdown icon"></i>
            <div class="default text">Kategori</div>
            <div class="menu">
                <?php
                $category = new CategoriesDatabase();
                for ($i = 1; $i < 10; $i++) {
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

    var menu1  = $("#ust_kategori").val();
    var menu2  = $("#alt_kategori").val();

    if (menu1>0 && menu2>0){
        alert("değeler hazır");
    }

    function getState(val) {
        $("#alt_menu").empty();
        var value = $("#ust_kategori").val();
        var $menu =  $('.alt-kategori').find('.menu');

        if (value==='1'){
            $menu.append('<div class="item" data-value="1">Cam</div>');
            $menu.append('<div class="item" data-value="2">Porselen</div>');

        } else  if (value==='2'){
            $menu.append('<div class="item" data-value="3">Defter</div>');
            $menu.append('<div class="item" data-value="4">Kalem</div>');

        } else  if (value==='3'){
            $menu.append('<div class="item" data-value="5">Avize</div>');
            $menu.append('<div class="item" data-value="6">Masa Lambası</div>');

        }else  if (value==='4'){
            $menu.append('<div class="item" data-value="7">Küpe</div>');
            $menu.append('<div class="item" data-value="8">Kolye</div>');
            $menu.append('<div class="item" data-value="9">Yüzük</div>');

        } else  if (value==='5'){
            $menu.append('<div class="item" data-value="10">Bardak</div>');
            $menu.append('<div class="item" data-value="11">Çatal Bıçak</div>');
            $menu.append('<div class="item" data-value="12">Çaydanlık</div>');
            $menu.append('<div class="item" data-value="13">Tencere</div>');
            $menu.append('<div class="item" data-value="14">Banyo Aksesuarı</div>');

        } else  if (value==='6'){
            $menu.append('<div class="item" data-value="20">Hırdavat</div>');

        }else  if (value==='7') {
            $menu.append('<div class="item" data-value="15">Kızlara Özel</div>');
            $menu.append('<div class="item" data-value="16">Erkeklere Özel</div>');

        } else  if (value==='8') {
            $menu.append('<div class="item" data-value="17">Kişisel Bakım</div>');
            $menu.append('<div class="item" data-value="18">Ev Temizliği</div>');

        } else {
            $menu.append('<div class="item" data-value="19">Hediye</div>');
        }
        $('.ui.dropdown.seasons').dropdown();

    }
    function getState2(val) {
        var value = $("#alt_kategori").val();
    }

</script>