<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$TYPICAL_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}

getAdminHeader();
?>

<div id="dashboard">
    <h1 id="header-id" class="ui header" style="margin-top: 0px ; color: #5C5B59"" >Satın Aldıklarım</h1>
    <?php
    require 'buyed-form.php';
    ?>

</div>

<?php
require '../form/index-form.php';
?>

<script src="/lib/admin/compoments/base.js"></script>
</body>
</html>