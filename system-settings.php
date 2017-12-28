<?php

/**
 * SYSTEM INCLUDES KLASÖRÜ TANIMLANDI
 */
define( 'SYSINC', 'system-includes' . DIRECTORY_SEPARATOR );

// Include files required for initialization.
require( ABSPATH . SYSINC . 'load.php' );
require( ABSPATH . SYSINC . 'system-constant.php' );

/**
 * Template'i çağırıyorum.
 */
require( ABSPATH. SYSINC . 'template.php');