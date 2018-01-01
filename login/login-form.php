<?php
$csrf_salt = base64_encode(openssl_random_pseudo_bytes(16));
$_SESSION['csrf'] = $csrf_salt;
?>
<div id="top-content" class="ui fluid container">
    <div class="ui stackable centered grid">
        <div class="middle aligned five wide center aligned column">

            <form class="ui large form" id="login-form" method="post" action="/login/index.php">
                <input type="hidden" name="csrf" id="csrf_salt" value="<?php echo $_SESSION['csrf'] ?>"/>
                <h1 class="header">Giriş Ekranı</h1>
                <div class="field">
                    <?php
                    if (isset($_SESSION['message'])) {
                        $message = $_SESSION['message'];
                        ?>

                        <div class="ui icon message">
                            <i class="warning icon"></i>
                            <div class="content">
                                <?php
                                echo $message
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="field">
                    <?php

                    if (isset($_SESSION['message'])){
                        $message = $_SESSION['message'];
                        if (strcmp("Kullanıcı aktif değildir. Mailinize gelen aktivasyon butonuna tıklayınız.
                                    Aktivasyon maili size ulaşmadıysa, yeniden aktivasyon maili almak için tıklayınız.",$message)==0){
                            $href = "/send-activation-code?email=".$_POST['email'];
                            ?>
                            <div class="field">
                                <a href="<?php echo $href?>" id="re-activate-code-send-submit" >Aktivasyon Gönder</a>
                            </div>
                    <?php
                        }
                    }
                    unset($_SESSION['message']);
                    ?>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" value="<?php if(isset($_GET['user'])) echo $_GET['user']; ?>" name="email" placeholder="E-Posta">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Şifre">
                    </div>
                </div>
                <input value="Giriş Yap" class="ui fluid big submit button submit" type="submit" id="login-submit" name="action">
                <div class="field">
                    <a href="/sifre-degistir" id="sifremi-degistir-submit" >Şifremi Unuttum</a>
                </div>

            </form>
        </div>
    </div>
</div>
