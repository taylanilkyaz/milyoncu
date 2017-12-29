<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$TYPICAL_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}
getAdminHeader();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'ileri') {
        //action for update here
        unset($_POST['action']);
    } else if ($_POST['action'] == 'geri') {
        //action for delete
        unset($_POST['action']);
        redirect_javascript('/teslimat-bilgileri/ajax.php');
    }
}
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
    require("siparis-ozeti-form.php");;
    ?>

</div>

<?php
require '../../form/index-form.php';
require '../../form/bottom-sidebar.php';
?>

<script src="../../../lib/admin/compoments/base.js"></script>
<script src="../../../lib/kart-dosyalari/dist/card.js"></script>
<link href="../../../lib/odeme-three-four/site.css" rel="stylesheet" type="text/css"/>
<script src="../../../lib/odeme-three-four/site.js"></script>
</body>
</html>

