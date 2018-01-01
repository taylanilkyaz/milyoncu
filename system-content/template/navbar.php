<div id="navbar">
    <div class="ui large menu grid">

        <div class="computer only row">
            <a href="/home" class="header item" style="background-color: #5C5B59">
                <img class="ui logo-size image" src="/assets/fotos/yenilogo.jpg">
            </a>

            <div class="right menu">

            <?php if (isset($_SESSION['e-mail'])) { ?>

            <?php } else { ?>

                <a href="/admin/buy" class="item">
                    <div class="ui primary button" style="background-color: #ffe004 ; color:#5C5B59;">Ürünler</div>
                </a>
                <a href="/register" class="item">
                    <div class="ui primary button" style="background-color: #ffe004 ; color:#5C5B59;" >Kayıt Ol</div>
                </a>

                <a href="/login" class="item">
                    <div class="ui primary button" style="background-color: #ffe004 ; color:#5C5B59;">Giriş Yap</div>
                </a>
            <?php } ?>

        </div>
    </div>

</div>
</div>