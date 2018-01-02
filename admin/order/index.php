<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$TYPICAL_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}
getAdminHeader();
?>

<div id="dashboard">
    <h1 id="header-id" class="ui header" style="margin-top: 0px ; color: #5C5B59">Sipariş Durumu</h1>
    <?php
    require 'order-form.php';
    ?>

</div>

<?php
require '../form/index-form.php';
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/admin/compoments/order.js"></script>
</body>
</html>