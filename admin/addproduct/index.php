<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$ADMIN_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}
getAdminHeader();
?>

<div id="dashboard">
    <h1 id="header-id" class="ui header" style="margin-top: 0px ; color: #5C5B59">Ürün Ekle</h1>

    <?php
    require 'addproduct-form.php';
    ?>

</div>

<?php
require "../form/index-form.php";
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/admin/compoments/addProduct.js"></script>
<script type="text/javascript" src="/lib/admin/compoments/buy.js"></script>


</body>
</html>