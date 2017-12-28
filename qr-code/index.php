<?php
require '../system-header.php';
require '../system-includes/helper/MailSender.php';
global $debugHelper;
getHeader();
getNavbar();

require("qr-code-form.php");
?>

<link href="/lib/qr-code/qr-code.css" rel="stylesheet" type="text/css"/>
<script src="/lib/qr-code/qr-code.js"></script>
</body>
</html>
