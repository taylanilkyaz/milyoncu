<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
$controllerObj = new Controller();


getAdminHeader();
?>
<style>
    .left-menu a {
        color: #404040 !important;
        font-weight: 700;
    }

    .left-menu a:hover {
        color: #ffffff !important;
        font-weight: bolder;
    }
</style>
<div id="dashboard" class="ui stackable grid">

    <div class="two wide column left-menu">

    </div>
    <div class="thirteen wide column">
        <?php
        require 'buy-form.php';
        ?>
    </div>
    <div class="one wide column"></div>


</div>

<?php
require '../form/index-form.php';
?>

<script type="text/javascript" src="/lib/admin/compoments/base.js"></script>
<script type="text/javascript" src="/lib/admin/compoments/buy.js"></script>
<script type="text/javascript" src="/lib/functional/Semantic-UI-Alert.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/functional/Semantic-UI-Alert.css">
<link rel="stylesheet" media="all"
      href="//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic,700italic%7CPT+Serif:400,700,400italic,700italic:latin"/>

</body>
</html>