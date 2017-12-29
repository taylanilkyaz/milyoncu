<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';

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

<div id="dashboard">
    <h1 class="ui header" style="margin-top: -50px ; margin-bottom: -10px; text-align: center">Kullanıcı Listele</h1>
    <?php
    //getNavbar();
    require 'listall-form.php';
    ?>
</div>


<?php
require '../form/index-form.php';
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/admin/compoments/listAll.js"></script>
<script src="/lib/admin/compoments/listAllEdit.js"></script>
<script src="/lib/table/data-table.js"></script>
<script src="/lib/table/table.js"></script>
<script src="/lib/table/tablee.js"></script>
</body>
</html>