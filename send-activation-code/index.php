<?php
require '../system-header.php';

require '../system-includes/helper/MailSender.php';
global $debugHelper;

getHeader();
getNavbar();
$userDatabaseObj = new UserDatabase();
$activationDatabaseObj = new ActivationDatabase();
$mailSender = new MailSender();

if (isset($_GET['email'])){
    $mail = $_GET['email'];
    //kullanıcı yeni activasyon kodu istiyor
    $user_id = $userDatabaseObj->get_user_id_by_mail($mail);
    //eski aktivasyon kodunu silmeliyiz.
    $activationDatabaseObj->deleteRow($user_id);
    //yeni kod göndermeliyiz
    $message = $mailSender->sendMailForActivation($mail);
    redirect_javascript("/login/index.php?user=".$_GET['email']);
}   else{
    redirect_javascript("/login/index.php");
}

?>

</body>
</html>
