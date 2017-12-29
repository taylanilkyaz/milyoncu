<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$TYPICAL_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}
getAdminHeader();

?>

<div id="icon-container" class="ui fluid container">
    <button class="ui left floated button">
        <i id="menu-icon" class="huge sidebar icon"></i>
    </button>
    <button class="ui right floated button">
        <i id="shop-icon" class="huge shop icon"></i>
    </button>
</div>

<div id="dashboard">
    <?php
    require ("teslimat-bilgileri-form.php");;
    ?>

</div>

<?php
require '../../form/index-form.php';
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/kart-dosyalari/dist/card.js"></script>
<link href="/lib/admin/styles/odeme.css" rel="stylesheet" type="text/css"/>
<script src="/lib/admin/compoments/odeme.js"></script>

</body>
</html>

