<?php
require '../system-header.php';
require 'Login.php';
global $debugHelper;
$login = new Login();
getHeader();
getNavbar();

if($login->isPostData()){
    if ($_POST['csrf'] == $_SESSION['csrf']){
        $res = $login->do_login_post_data();
        if(!$res){
            //$debugHelper->printErrorMessage("Hata : ",$login->getErrorMessage());
            //kullanıcı deger girdi fakat sisteme kayıtlı değil
            $_SESSION['message']=$login->getErrorMessage();
        }
    }
}

if($login->isAlreadyLogin()){
    redirect_javascript('/admin/');
}else{
    require ("login-form.php");
}

?>
<script src="/lib/regular/login/login.js"></script>
</body>
</html>
