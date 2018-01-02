<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
if ($_SESSION['user_type']==UserTypes::$TYPICAL_USER){
    redirect_javascript("/admin/buy");
}   else if ($_SESSION['user_type']==UserTypes::$ADMIN_USER){
    redirect_javascript("/admin/order+");
}
?>

<div id="dashboard">

<?php
getAdminHeader();
?>
</div>

<?php
    require 'form/index-form.php';
?>