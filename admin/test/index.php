<?php

require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';


?>
<head>
    <script src="/lib/functional/clipboard.min.js"></script>

</head>
<body>
    <div class="ui action input">
        <input id="post-shortlink" value="https://ac.me/qmE_jpnYXFo">
        <button class="button" id="copy-button" data-clipboard-target="#post-shortlink">Copy</button>
    </div>
</body>
<script>
    (function(){
        new Clipboard('#copy-button');
    })();
</script>
