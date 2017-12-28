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
    require("odeme-bilgileri-form.php");;
    ?>

</div>

<?php
require '../../form/index-form.php';
require '../../form/right-sidebar.php';
require '../../form/bottom-sidebar.php';
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/kart-dosyalari/dist/card.js"></script>

<link href="/lib/admin/styles/odeme.css" rel="stylesheet" type="text/css"/>
<script src="/lib/admin/compoments/odeme.js"></script>


<link href="/lib/virtual-keyboard/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="/lib/virtual-keyboard/css/keyboard.min.css" rel="stylesheet" type="text/css"/>

<link href="/lib/virtual-keyboard/js/jquery.mobile-1.4.5.min.js" rel="stylesheet" type="text/css"/>
<script src="/lib/virtual-keyboard/js/jquery-ui.min.js"></script>
<script src="/lib/virtual-keyboard/js/jquery.keyboard.extension-mobile.min.js"></script>
<script src="/lib/virtual-keyboard/js/jquery.keyboard.min.js"></script>
<script src="/lib/virtual-keyboard/js/jquery.mousewheel.min.js"></script>

<script type="text/javascript" src="/lib/functional/Semantic-UI-Alert.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/functional/Semantic-UI-Alert.css">

</body>
</html>

