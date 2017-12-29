<?php

/**
 * Database ayarları.
 */

/**
 * Encode UTF-8 olarak ayarlanıyor.
 */
mb_internal_encoding( 'UTF-8' );

/**
 * Veritabanı ismi
 */
define('DB_NAME', 'b4u_dna');

/**
 * Veritabanı kullanıcı adı
 */
define('DB_USER', 'root');

/**
 * Veritabanı kullanıcı şifresi
 */
define('DB_PASSWORD', 'asd123');

global $dev;
/**
 * Veritabanı Host Adresi
 */
define('DB_HOST', 'localhost');

/**
 * Charset
 */
define('DB_CHARSET', 'utf8');


/**
 * Collate
 *
 */
//TODO ileride ihtiyaça göre şekillenecek.
define('DB_COLLATE', '');


