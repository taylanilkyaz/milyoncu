<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$LABARATORY_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}

getAdminHeader();
?>



<div id="icon-container" class="ui fluid container">
    <button class="ui left floated button">
        <i id="menu-icon" class="huge sidebar icon"></i>
    </button>
</div>

<div id="dashboard">
    <h1 class="ui header">Barcode Tracking</h1>

    <?php
    //getNavbar();
    require 'barcode-tracking-form.php';
    ?>

</div>

<?php
require "../form/index-form.php";
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/admin/compoments/barcode-tracking.js"></script>
<script src="/lib/table/data-table.js"></script>
<script src="/lib/table/barcode-table.js"></script>
<script src="/lib/table/tablee.js"></script>

</body>
</html>