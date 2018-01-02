<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$ADMIN_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}
getAdminHeader();
?>

<div id="dashboard" style="margin-left: 150px ; margin-right: 150px ;">
    <h1 id="header-id" class="ui header" style="margin-top: 0px ; margin-bottom: 20px ; color: #5C5B59">Sipariş Takibi</h1>


    <?php
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