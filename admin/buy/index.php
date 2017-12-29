<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
$controllerObj = new Controller();


getAdminHeader();
?>

<div id="dashboard">
    <?php
    require 'buy-form.php';
    ?>

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