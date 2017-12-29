<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
if ($_SESSION['user_type']==UserTypes::$TYPICAL_USER){
    redirect_javascript("/admin/buy");
}   else if ($_SESSION['user_type']==UserTypes::$LABARATORY_USER){
    redirect_javascript("/admin/barcode-tracking");
}   else if ($_SESSION['user_type']==UserTypes::$ADMIN_USER){
    redirect_javascript("/admin/order+");
}
?>

<div id="dashboard">
    <div id="icon-container" class="ui fluid container">
        <button class="ui left floated button"><i id="menu-icon" class="huge sidebar icon"></i></button>
        <button class="ui right floated button"><i id="shop-icon" class="huge shop icon"></i></button>
    </div>
<?php
getAdminHeader();
?>
</div>

<?php
    require 'form/index-form.php';
?>