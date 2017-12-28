<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';

require 'Home.php';
global $debugHelper;

$home = new Home();
getHeader();
getNavbar();

require 'home-form.php';
?>

<script type="text/javascript" src="../lib/home/home.js"></script>

<link rel="stylesheet" type="text/css" href="/lib/home/slick/slick.css">
<link rel="stylesheet" type="text/css" href="/lib/home/slick/slick-theme.css">
<script src="/lib/home/slick/slick.js" type="text/javascript" charset="utf-8"></script>

</body>
</html>
