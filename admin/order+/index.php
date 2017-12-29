<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$ADMIN_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}
getAdminHeader();
?>

<div id="icon-container" class="ui fluid container">
    <button class="ui left floated button"><i id="menu-icon" class="huge sidebar icon"></i></button>
    <button class="ui right floated button"><i id="shop-icon" class="huge shop icon"></i></button>
</div>

<div id="dashboard" style="margin-left: 150px ; margin-right: 150px">
    <h1 id="header-id" class="ui header" style="margin-top: -50px ; margin-bottom: -15px">Sipariş Takibi</h1>

    <button onclick="window.history.back()" style="margin-top: 15px; margin-bottom: 15px; " class="ui labeled icon button">
        <i class="left chevron icon"></i>
        Geri Dön
    </button>

    <?php
    //getNavbar();
    require 'order+-form.php';
    ?>
</div>

<?php
require '../form/index-form.php';
?>

<script src="/lib/functional/clipboard.min.js"></script>
<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/admin/compoments/orderPlus.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/admin/admin-style.css">

</body>
</html>