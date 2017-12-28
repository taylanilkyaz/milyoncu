<?php
$csrf_salt = base64_encode(openssl_random_pseudo_bytes(16));
$_SESSION['csrf'] = $csrf_salt;
?>
<div id="top-content" class="ui fluid container">
    <div class="ui stackable centered grid">
        <div class="middle aligned eight wide tablet seven wide computer center aligned column" id="login-form-div">
            <form  class="ui large form" id="login-form" method="post" action="/register/index.php">
                <input type="hidden" name="csrf" id="csrf_salt" value="<?php echo $_SESSION['csrf'] ?>"/>

                <h1 class="header">Kayıt Ol</h1>
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
                    <div class="ui left icon labeled input">
                        <i class="mail icon"></i>
                        <input type="text" name="email" placeholder="E-Posta">
                        <div class="ui corner label"><i class="star icon"></i></div>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon labeled input">
                        <i class="privacy icon"></i>
                        <input type="password" name="password" placeholder="Şifre">
                        <div class="ui corner label"><i class="star icon"></i></div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="ui left icon labeled input">
                            <i class="user icon"></i>
                            <input type="text" name="first_name" placeholder="Ad">
                            <div class="ui corner label"><i class="star icon"></i></div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon labeled input">
                            <i class="user icon"></i>
                            <input type="text" name="last_name" placeholder="Soyad">
                            <div class="ui corner label"><i class="star icon"></i></div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="ui left icon labeled input">
                            <i class="user icon"></i>
                            <input type="text" name="mother_name" placeholder="Anne adı(Opsiyonel)">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon labeled input">
                            <i class="user icon"></i>
                            <input type="text" name="father_name" placeholder="Baba adı(Opsiyonel)">
                        </div>
                    </div>
                </div>


                <div class="field">
                    <div class="ui left icon input">
                        <i class="phone icon"></i>
                        <input type="text" name="tel_number" placeholder="03122619999(Opsiyonel)">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="mother_maiden" placeholder="Anne Kızlık Soyadı(Opsiyonel)">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="flag icon"></i>
                        <input type="text" name="tc_no" placeholder="TC(Opsiyonel)">
                    </div>
                </div>
                <input value="Aktivasyon Gönder" class="ui big fluid button" type="submit" id="login-submit">
                <div class="ui error message"></div>

                <p class="smalller-text"><i class="big hide icon"></i>Bilgileriniz hiç kimseyle kati suretle paylaşılmaz.<p>
                <p class="smalller-text"><i class="big lock icon"></i>Tüm sistem SHA-512 şifreleme ile korunur.<p>
            </form>
        </div>
    </div>
</div>