<?php
require '../system-header.php';

require 'Register.php';
require '../system-includes/helper/MailSender.php';
global $debugHelper;

getHeader();
getNavbar();

$register = new Register();
$mailSender = new MailSender();
if($register->isPostData()){
    if ($_POST['csrf'] == $_SESSION['csrf']){
        $res = $register->createUserPostData();

        /**
         * Hatalı Giriş
         */
        if(!$res){
            $_SESSION['message']=$register->getErrorMessage();
        }else{
            //adama kod gönderilecek
            $message = $mailSender->sendMailForActivation($_POST['email']);
            //burayı kontrol etmeliyiz
            $_SESSION['message'] = $message;
            redirect_javascript("/login/index.php?user=".$_POST['email']);
        }
    }
}

if($register->isAlreadyLogin()){
    redirect_javascript("/home/index.php");
}else{
    require 'register-form.php';
}

?>

<script src="/lib/register/register.js"></script>
</body>
</html>
