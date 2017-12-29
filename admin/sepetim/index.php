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

    <?php
    //getNavbar();
    require 'sepetim-form.php';
    ?>

</div>

<?php
require "../form/index-form.php";
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/admin/compoments/sepetim.js"></script>


</body>
</html>