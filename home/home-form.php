<?php
$csrf_salt = base64_encode(openssl_random_pseudo_bytes(16));
$_SESSION['csrf'] = $csrf_salt;
?>

<div id="top-content" class="ui fluid container">

    <div class="ui stackable centered grid">
        <div class="ten wide center aligned column">
            <h2 class="ui header">
                Ne Alırsan Bir Milyon!
            </h2>
            <div class="ui inverted divider"></div>
            <div class="sub  header">
                <br>
                <br>
                <b>Güçlü teknik kadromuz ile yenilikçi , dinamik , verimli , güvenilir bir takım ruhu anlayışında ;
                    kalite , zamanındalık ve müşteri memnuniyeti ilkelerinden taviz vermeden dünya standartlarına uygun
                    olarak optimal fiyatlarla ve mümkün olduğunda çok istihdam yaratarak çevremize hizmet sunmaktayız . </b>
            </div>

            <br><br>
        </div>
    </div>

</div>