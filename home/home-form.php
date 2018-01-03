<?php
$csrf_salt = base64_encode(openssl_random_pseudo_bytes(16));
$_SESSION['csrf'] = $csrf_salt;
?>

<div id="top-content" class="ui fluid container">

    <div class="ui stackable centered grid">
        <ul class="slider">
            <li class="one">
                <a href="javascript:;">
                    <h1>Ne Alırsan Bir Milyon!</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime laborum non suscipit nesciunt veritatis nisi fugiat, labore autem aspernatur ratione dolore, itaque, fugit expedita sint.</p>
                </a>
            </li>
            <li class="two">
                <a href="javascript:;">
                    <h1>Yüzlerce Ürün Yüzlerce Çeşit!</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae maxime minus similique. Minus provident, omnis temporibus, voluptatum, odit cum maiores tempora, nobis explicabo ipsum?</p>
                </a>
            </li>
            <li class="three">
                <a href="javascript:;">
                    <h1>Sınırsız Taşıma İmkanı</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium, quis explicabo architecto tempore quia, laboriosam beatae illo eveniet nihil, aliquam vel. Officiis officia, a?</p>
                </a>
            </li>
            <li class="four">
                <a href="javascript:;">
                    <h1>7 Gün / 24 Saat Hizmet</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae quibusdam sed dolores, pariatur minus porro ea sunt fugiat necessitatibus, ipsum est cum tempore quas dolore.</p>
                </a>
            </li>
            <li class="five">
                <a href="javascript:;">
                    <h1>Güvenlik Ve Gizlilik</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt quam culpa amet in, earum minus non soluta, quas autem, distinctio assumenda, libero rem reprehenderit facilis.</p>
                </a>
            </li>
        </ul>
    </div>

</div>