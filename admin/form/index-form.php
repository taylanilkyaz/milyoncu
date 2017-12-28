<div id="taylan" class="ui pointing menu ">
    <div class="logo-sidebar">
        <a href="/index.php">
            <img src="/assets/fotos/logo.png"></a>
    </div>
    <?php
    if (isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] == UserTypes::$TYPICAL_USER) {
            ?>
            <a href="/admin/edituser" class="item">
                Profil
                <i class="left aligned large user icon"></i>
            </a>

            <a href="/admin/buy" class="item">
                Satın Al
                <i class="left aligned large shopping bag icon"></i>
            </a>

            <a href="/admin/sepetim" class="item">
                Sepeti Görüntüle
                <i class="left aligned large shop icon"></i>
            </a>

            <a href="/admin/buyed" class="item">
                Satın Aldıklarım
                <i class="left aligned large suitcase icon"></i>
            </a>

            <a href="/admin/order" class="item">
                Sipariş Durumu
                <i class="left aligned large shipping icon"></i>
            </a>

            <a href="/admin/ticket" class="item">
                Destek
                <i class="left aligned large  announcement icon"></i>
            </a>

            <a href="/logout" class="item"> Çıkış Yap

                <i class="left aligned large sign out icon"></i>
            </a>

            <?php
        } else if ($_SESSION['user_type'] == UserTypes::$ADMIN_USER) {
            ?>

            <a href="/admin/addproduct" class="item">
                Ürün Ekleme
                <i class="left aligned large plus square outline icon"></i>
            </a>

            <a href="/admin/editproduct" class="item">
                Ürün Düzenleme
                <i class="left aligned large edit icon"></i>
            </a>

            <a href="/admin/listall" class="item">
                Kullanıcı Listele
                <i class="left aligned large list icon"></i>
            </a>

            <a href="/admin/order+" class="item">
                Sipariş Takip
                <i class="left aligned large shipping icon"></i>
            </a>

            <a href="/admin/ticket" class="item">
                Destek
                <i class="left aligned large  announcement icon"></i>
            </a>

            <a href="/admin/iletisim" class="item">
                İletişim
                <i class="left aligned large  comments outline icon"></i>
            </a>

            <a href="/logout" class="item"> Çıkış Yap

                <i class="left aligned large sign out icon"></i>
            </a>

            <?php
        }
    }

    ?>

</div>