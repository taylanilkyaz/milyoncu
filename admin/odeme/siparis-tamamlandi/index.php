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
    <?php
    require("siparis-tamamlandi-form.php");;
    ?>

</div>

<?php
require '../../form/index-form.php';
?>
<script src="../../../lib/admin/compoments/base.js"></script>
<script src="../../../lib/kart-dosyalari/dist/card.js"></script>
<link href="../../../lib/odeme-three-four/site.css" rel="stylesheet" type="text/css"/>
<script src="../../../lib/odeme-three-four/site.js"></script>
</html>

