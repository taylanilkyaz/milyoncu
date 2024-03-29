<?php

/**
 * System content sabiti tanımlanıyor.
 */

define('SYSCONTENT', ABSPATH . 'system-content'.DIRECTORY_SEPARATOR );
define('TEMPLATE', SYSCONTENT. 'template'.DIRECTORY_SEPARATOR );
define('STATICCONTENT', SYSCONTENT. 'static'.DIRECTORY_SEPARATOR );
define('HOMEPATH',ABSPATH . 'home'. DIRECTORY_SEPARATOR);
define('LOGINPATH',ABSPATH . 'login' . DIRECTORY_SEPARATOR);
define('REGISTERPATH',ABSPATH . 'register' . DIRECTORY_SEPARATOR);
define('IMAGEPATH', ABSPATH.'assets'.DIRECTORY_SEPARATOR.'images' . DIRECTORY_SEPARATOR);
define('PRODUCTIMAGEPATH',ABSPATH.'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'productimage'.DIRECTORY_SEPARATOR.'512'.DIRECTORY_SEPARATOR);
define("DATABASEPATH",ABSPATH.SYSINC."database".DIRECTORY_SEPARATOR);
define("MODELPATH",ABSPATH.SYSINC."model".DIRECTORY_SEPARATOR);
define("HELPERPATH",ABSPATH.SYSINC."helper".DIRECTORY_SEPARATOR);