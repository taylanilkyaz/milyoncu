<?php
$csrf_salt = base64_encode(openssl_random_pseudo_bytes(16));
$_SESSION['csrf'] = $csrf_salt;
?>

<div id="top-content" class="ui fluid container">

    <div class="ui stackable centered grid">
        <ul class="slider">
            <li class="one">
                <a href="javascript:;">
                    <h1 style="background-color:rgba(230,202,3,0.5)">Ne Alırsan Bir Milyon!</h1>
                    <p>Ucuz fiyatlarımızla piyasayı yerinden oynatmaya geliyoruz . Ürünlerimizi mutlaka incelemelisiniz ! </p>
                </a>
            </li>
            <li class="two">
                <a href="javascript:;">
                    <h1 style="background-color:rgba(0, 0, 0, 0.5) ; color: white;">Yüzlerce Ürün Yüzlerce Çeşit!</h1>
                    <p>Kategorilere bölünmüş yüzlerce ürün ve yüzlerce çeşit sizin alışveriş işlerinizi oldukça kolaylaştıracak . </p>
                </a>
            </li>
            <li class="three">
                <a href="javascript:;">
                    <h1 style="background-color:rgba(255,239,213,0.5) ; color: #4b4b4b">Sınırsız Taşıma İmkanı</h1>
                    <p>Artık evinizden istediğiniz ürün yada ürünleri sınırsız kargo imkanlarıyla , kolayca alabilirsiniz . Buna sadece bir tık uzaksınız !</p>
                </a>
            </li>
            <li class="four">
                <a href="javascript:;">
                    <h1 style="background-color: indianred">7 Gün / 24 Saat Hizmet</h1>
                    <p>İstediğiniz saat ya da istediğiniz gün sipariş gerçekleştirebilirsiniz . </p>
                </a>
            </li>
            <li class="five">
                <a href="javascript:;">
                    <h1 style="background-color:rgba(255,255,255,0.5) ; color: white">Güvenlik Ve Gizlilik</h1>
                    <p>Herhangi bir güvenlik kaygınız olmasın . Size ait hiç bir bilgi dışarı ile kesinlikle paylaşılmaz . Bu yüzden gönül rahatlığı ile alışveriş yapabilirsiniz. </p>
                </a>
            </li>
        </ul>
    </div>

</div>