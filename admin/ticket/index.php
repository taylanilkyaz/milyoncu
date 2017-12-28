<?php

require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
getAdminHeader();

    require '../form/index-form.php';
    require '../form/right-sidebar.php';
    require '../form/bottom-sidebar.php';



?>

<div id="dashboard">
    <div class="pusher">
        <h1 id="header-id" class="ui header">Destek</h1>

        <div class="large ui buttons">
        <button id="open-ticket" class="ui blue basic button">Açık Talep</button>
        <button id="close-ticket" class="ui blue basic button">Kapalı Talep</button>
        <button id="submit-ticket" class="ui blue basic button">Yeni Talep</button>
        </div>
        <div class="ui divider"></div>
    </div>

    <?php
    require 'ticket-form.php';
    ?>

</div>



<script src="../../lib/admin/compoments/base.js"></script>
<script src="../../lib/admin/compoments/ticket.js"></script>
</body>
</html>