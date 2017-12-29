<?php

require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
getAdminHeader();

    require '../form/index-form.php';

?>

<div id="dashboard">
    <div class="pusher ui stackable centered grid">
        <div class="eight wide column">
            <h1 id="header-id" class="ui header">Destek ve İletişim</h1>
            <div class="large ui buttons">
                <button id="open-ticket" class="ui blue basic button">Önceki Sorular</button>
                <button id="submit-ticket" class="ui blue basic button">Yeni Soru</button>
            </div>
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