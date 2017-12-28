<div id="navbar">
    <div class="ui large menu grid">

        <div class="computer only row" id="#homepage-navbar-computer">
            <a href="/home" class="header item">
                <img class="ui logo-size image" src="/assets/fotos/logo.png">
            </a>

            <div class="right menu">

            <?php if (isset($_SESSION['e-mail'])) { ?>

            <?php } else { ?>

                <a href="/admin/buy" class="item">
                    <div class="ui primary button">Ürünler</div>
                </a>
                <a href="/register" class="item">
                    <div class="ui primary button">Kayıt Ol</div>
                </a>

                <a href="/login" class="item">
                    <div class="ui primary button">Giriş Yap</div>
                </a>
            <?php } ?>

        </div>
    </div>

</div>
</div>