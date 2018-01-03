<?php
$csrf_salt = base64_encode(openssl_random_pseudo_bytes(16));
$_SESSION['csrf'] = $csrf_salt;

/*
$connect =  mysqli_connect("localhost" , "root" , "asd123" , "milyoncu");

if (isset($_POST["insert_btn"]))
{
    $sql = "CALL insertData('".$_POST[email]."' ,'".$_POST[password]."' ,'".$_POST[first_name]."' 
     , '".$_POST[last_name]."' , '".$_POST[tel_no]."' , '".$_POST[tc_no]."')";

    if (mysqli_query($connect ,$sql)){
        header("location:index.php?inserted=1");
    }
}
if (isset($_GET["inserted"]))
{
    echo '<script>alert("data inserted")</script>';
}

*/
?>
<div id="top-content" class="ui fluid container" style=" background-image: url(/assets/fotos/arkaplan.jpg)">
    <div class="ui stackable centered grid" style="margin-top: 10%  ">
        <div class="middle aligned eight wide tablet seven wide computer center aligned column" id="login-form-div">
            <form  class="ui large form" id="login-form" method="post" action="/register/index.php">
                <input type="hidden" name="csrf" id="csrf_salt" value="<?php echo $_SESSION['csrf'] ?>"/>

                <h1 class="header">Kayıt Ekranı</h1>
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

                <div class="field">
                    <div class="ui left icon input">
                        <i class="phone icon"></i>
                        <input type="text" name="tel_number" placeholder="03122619999(Opsiyonel)">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="flag icon"></i>
                        <input type="text" name="tc_no" placeholder="TC(Opsiyonel)">
                    </div>
                </div>
                <input value="Aktivasyon Gönder" class="ui big fluid button" name="insert_btn" type="submit" id="login-submit">
                <div class="ui error message"></div>
            </form>
        </div>
    </div>
</div>