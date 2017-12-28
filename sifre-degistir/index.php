<?php
require '../system-header.php';
require 'ChangePassword.php';
require 'ForgotPassword.php';
require '../activation/Activation.php';
require '../system-includes/helper/MailSender.php';
global $debugHelper;
$changePassword = new ChangePassword();
$forgotPassword = new ForgotPassword();
$mailSender = new MailSender();
$activation = new Activation();
$database_obj = new Database();
getHeader();
getNavbar();

/*
 * kullanıcının girdiği e-mail sistemde var mı diye kontrol edilecek
 */
if ($changePassword->isGetData()){
    //activation kontrolünü yap
    $activation->makeControls();
    $changePassword->updatePassword($_GET['email'],$_GET['password']);
    redirect_javascript("/login/index.php");
}   else{
    if ($changePassword->isPostData()){
        if ($forgotPassword->makeControl()){
            $mailSender->sendMailForPasswordChange($_POST['email'],$_POST['first_password']);
            redirect_javascript("/home/index.php");
        } else{
            $_SESSION['message'] = $forgotPassword->getErrorMessage();
            require "sifremi-degistir-form.php";
        }
    } else {
        require "sifremi-degistir-form.php";
    }
}

?>

<link href="/lib/sifre-degistir/sifre-degistir.css" rel="stylesheet" type="text/css"/>
<script src="/lib/sifre-degistir/sifre-degistir.js"></script>
</body>
</html>
