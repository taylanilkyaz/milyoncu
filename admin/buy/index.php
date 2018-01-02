<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
$controllerObj = new Controller();


getAdminHeader();
?>
<style>
    .left-menu a {
        color: #404040 !important;
        font-weight: 700;
    }

    .left-menu a:hover {
        color: #ffffff !important;
        font-weight: bolder;
    }
</style>
<div id="dashboard" class="ui stackable grid">

    <div class="two wide column left-menu">
        <div class="ui vertical sticky menu"
             style="left: 10px;font-size: 18px; top: 100px;position: fixed;background-color: #4d97a9">

            <form class="ui stackable grid" action="index.php" method="post">
                <div class="item">
                    <div class="ui fluid search column"style="margin-top: 2%">
                        <div class="ui fluid big icon input">
                            <input id="search" name="search" class="prompt" type="text" placeholder="Ara..." style="font-size: 15px">
                            <i class="search icon"></i>
                        </div>
                    </div>
                </div>
            </form>

            <div class="item">
                <div class="header" style="font-size: x-large"><a href="index.php">Ürünler</a></div>
                <div class="menu">
                    <a class="item" href="#1">
                        <b>Züccaciye</b>
                    </a>

                    <a class="item" href="#2">
                        <b>Kırtasiye</b>
                    </a>
                    <a class="item" href="#3">
                        <b>Aydınlatma</b>
                    </a>
                    <a class="item" href="#4">
                        <b>Bujiteri</b>
                    </a>
                    <a class="item" href="#5">
                        <b>Mutfak & Banyo</b>
                    </a>
                    <a class="item" href="#6">
                        <b>Hırdavat</b>
                    </a>
                    <a class="item" href="#7">
                        <b>Oyuncak</b>
                    </a>
                    <a class="item" href="#8">
                        <b>Temizlik</b>
                    </a>
                    <a class="item" href="#9">
                        <b>Hediyelik</b>
                    </a>

                </div>
            </div>
            <div class="item">
                <div class="header" style="font-size: 18px ; margin-bottom: 15px">Fiyat Filtresi</div>

                <form class="ui stackable grid" action="index.php" method="post">
                    <div class="eight wide column ui mini input focus" style="padding-right: 2px">
                        <input type="text" name="smallval" id="smallval" placeholder="Min...">
                    </div>

                    <div class="eight wide column ui mini input focus "
                         style="padding-left: 2px ; margin-right: inherit">
                        <input type="text" name="largeval" id="largeval" placeholder="Max...">
                    </div>

                    <div class="sixteen wide column" style="text-align: center ;padding-top: 0px">
                        <button class=" ui primary button" type="submit" id="filtrele-ara"
                                style="background-color: #41C4E2 ; color: white">
                            Ara
                        </button>
                    </div>
                </form>


            </div>

        </div>

    </div>
    <div class="thirteen wide column">
        <?php
        require 'buy-form.php';
        ?>
    </div>
    <div class="one wide column"></div>


</div>

<?php
require '../form/index-form.php';
?>

<script type="text/javascript" src="/lib/admin/compoments/base.js"></script>
<script type="text/javascript" src="/lib/admin/compoments/buy.js"></script>
<script type="text/javascript" src="/lib/functional/Semantic-UI-Alert.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/functional/Semantic-UI-Alert.css">
<link rel="stylesheet" media="all"
      href="//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic,700italic%7CPT+Serif:400,700,400italic,700italic:latin"/>

</body>
</html>