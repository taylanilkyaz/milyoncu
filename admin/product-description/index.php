<?php
include "../../system-includes/helper/Controller.class.php";
include "../../system-includes/database/UserTypes.class.php";

$productName = $_GET['name'];

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
    <h1 class="ui header">ÜRÜN DETAYLARI</h1>

    <?php
    //getNavbar();
    require("product-description-form.php");
    ?>

</div>

<?php
require "../form/index-form.php";
?>

<script src="/lib/admin/compoments/base.js"></script>
<script type="text/javascript" src="/lib/admin/compoments/buy.js"></script>
<script src="/lib/zoom/jquery.elevatezoom.js"></script>
<link href="/lib/table/table.css" rel="stylesheet" type="text/css"/>
<script src="/lib/admin/compoments/productDescription.js"></script>
<script src="/lib/table/data-table.js"></script>
<script src="/lib/table/table.js"></script>
<script src="/lib/table/tablee.js"></script>
<script type="text/javascript" src="/lib/functional/Semantic-UI-Alert.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/functional/Semantic-UI-Alert.css">

</body>
</html>