<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
$controllerObj = new Controller();
$bool = $controllerObj->controllUserLevel(UserTypes::$LABARATORY_USER);
if (!$bool){
    redirect_javascript("/error/index.php");
}
getAdminHeader();
?>

<div id="icon-container" class="ui fluid container">
    <button class="ui left floated button"><i id="menu-icon" class="huge sidebar icon"></i></button>
</div>

<div id="dashboard">
    <h1 class="ui header" id="header-id">Upload Sample Result</h1>
    <?php
    //getNavbar();
    require 'pdf-upload-form.php';
    ?>
</div>
<?php
require '../form/index-form.php';
require '../form/right-sidebar.php';
require '../form/bottom-sidebar.php';
?>

<script type="text/javascript" src="/lib/admin/compoments/base.js"></script>
<script type="text/javascript" src="/lib/admin/compoments/buy.js"></script>
<script type="text/javascript" src="/lib/admin/compoments/resultUpload.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/admin/admin-style.css">

</body>
</html>