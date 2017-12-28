<?php
require '../system-header.php';
require 'Activation.php';
$activation = new Activation();
global $debugHelper;

if (!$activation->isGetData()) {
    require("activation-form2.php");
}   else {
    //adam aktivasyon kodu girdi, kontrolleri sağla
    $res=$activation->makeControls();
    if (!$res){
        $_SESSION['message']=$activation->getErrorMessage();
        redirect_javascript("/home/index.php");
    } else{
        $activation->makeUserActive();
        redirect_javascript("/login/index.php");
    }
}

?>

<script src="/lib/register/register.js"></script>
</body>
</html>
