<div id="user-pointing-menu" class="ui pointing menu ">
    <div class="logo-sidebar">
        <?php
        if (isset($_SESSION['user_type'])) {
        ?>
        <a href="/admin">
            <?php }
            else{
            ?>
            <a href="/home" style="background-color: #5C5B59">
            <?php  }  ?>
            <img src="/assets/fotos/yenilogo.jpg" ></a>
    </div>
    <div class="right menu">
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

                <a href="/logout" class="item"> Çıkış Yap

                    <i class="left aligned large sign out icon"></i>
                </a>

                <?php
            }
        }
        else{
            ?>
            <a href="/admin/istatistik" class="item">
                <div class="ui primary button" style="background-color: #ffe004 ; color:#5C5B59;">İstatistikler</div>
            </a>

            <a href="/admin/buy" class="item">
                <div class="ui primary button" style="background-color: #ffe004 ; color:#5C5B59;">Ürünler</div>
            </a>
            <a href="/register" class="item">
                <div class="ui primary button" style="background-color: #ffe004 ; color:#5C5B59;" >Kayıt Ol</div>
            </a>

            <a href="/login" class="item" >
                <div class="ui primary button" style="background-color: #ffe004 ; color:#5C5B59;">Giriş Yap</div>
            </a>
        <?php
        }

        ?>
    </div>


</div>