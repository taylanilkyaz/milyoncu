
<div id="top-content" class="ui fluid container">
    <div class="ui stackable centered grid">
        <div class="middle aligned five wide center aligned column">
            <form class="ui large form" id="login-form" method="post" action="/sifre-degistir/index.php">
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
                        unset($_SESSION['message']);
                    }
                    ?>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="email-id" type="email" name="email" placeholder="Email adresinizi giriniz">
                    </div>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="first-password-id" type="password" name="first_password" placeholder="Yeni Şifrenizi giriniz">
                    </div>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="second-password-id" type="password"name="second_password" placeholder="Yeni Şifrenizi tekrar giriniz">
                    </div>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <div id="check_equal" style="display: none">
                            <i class="check circle big icon"></i>
                            Şifremi Değiştir butonuna tıkladıktan sonra,
                            Email'inize gidip yeni şifrenizi aktifleştirebilirsiniz.
                        </div>
                    </div>
                </div>

                <input value="Şifremi Değiştir" class="ui fluid big submit disabled button" type="submit" id="login-submit">

                <p class="smalller-text"><i class="big hide icon"></i>Bilgileriniz hiç kimseyle kati suretle paylaşılmaz.<p>
                <p class="smalller-text"><i class="big lock icon"></i>Tüm kütüphane sistemi SHA-512 şifreleme ile korunur.<p>
            </form>
        </div>
    </div>
</div>
