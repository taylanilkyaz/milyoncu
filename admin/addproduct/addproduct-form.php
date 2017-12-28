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

<!--
eklenmek istenen ürünlerin resmi, fiyatı, ismi ve açıklaması alınır
-->
<div class="ui stackable centered grid" id="add-product-container">
    <div class="middle aligned ten wide center aligned column">
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
                    <textarea id="product-text-area" name="product-long-info" placeholder="Uzun Ürün Açıklaması"></textarea>
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
