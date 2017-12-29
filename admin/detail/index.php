<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
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

<div class="pusher" id="dashboard">
    <div id="inline-container">
        <?php
        require 'detail-form.php';
        //require 'inline-detail-form.php';
        ?>
    </div>
</div>

<?php
require '../form/index-form.php';
?>

<script src="/lib/admin/compoments/base.js"></script>
<script src="/lib/admin/compoments/detail.js"></script>
</body>
</html>