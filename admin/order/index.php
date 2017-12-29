<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$TYPICAL_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}
getAdminHeader();
?>

<div id="icon-container" class="ui fluid container">
    <button class="ui left floated button"><i id="menu-icon" class="huge sidebar icon"></i></button>
    <button class="ui right floated button"><i id="shop-icon" class="huge shop icon"></i></button>
</div>
<div id="dashboard">
    <h1 id="header-id" class="ui header">Sipariş Durumu</h1>
    <?php
    require 'order-form.php';
    ?>

</div>

<?php
require '../form/index-form.php';
require '../form/bottom-sidebar.php';
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/admin/compoments/order.js"></script>
</body>
</html>