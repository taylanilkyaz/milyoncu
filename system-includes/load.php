<?php
/**
 * These functions are needed to load WordPress.
 *
 * @package WordPress
 */

/**
 * Return the HTTP protocol sent by the server.
 *
 * @since 4.4.0
 *
 * @return string The HTTP protocol. Default: HTTP/1.0.
 */
function system_get_server_protocol() {
    $protocol = $_SERVER['SERVER_PROTOCOL'];
    if ( ! in_array( $protocol, array( 'HTTP/1.1', 'HTTP/2', 'HTTP/2.0' ) ) ) {
        $protocol = 'HTTP/1.0';
    }
    return $protocol;
}


/**
 * Don't load all of WordPress when handling a favicon.ico request.
 *
 * Instead, send the headers for a zero-length favicon and bail.
 *
 * @since 3.0.0
 */
function wp_favicon_request() {
    if ( '/favicon.ico' == $_SERVER['REQUEST_URI'] ) {
        header('Content-Type: image/vnd.microsoft.icon');
        exit;
    }
}

/**
 * Start the WordPress micro-timer.
 *
 * @since 0.71
 * @access private
 *
 * @global float $timestart Unix timestamp set at the beginning of the page load.
 * @see timer_stop()
 *
 * @return bool Always returns true.
 */
function timer_start() {
    global $timestart;
    $timestart = microtime( true );
    return true;
}


/**
 * timer start fonksiyonu çağrıldıktan sonra bu fonksiyon arasındaki zamanı hesaplar.
 * @param int $display 0|false sonucu yazdırmaz sadece sonucu geri döndürür
 *                     1|true sonucu yazdırır ve sonucu geri döndürür
 * @param int $precision noktadan sonraki hassaslık
 * @return string
 */
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $timeend = microtime( true );
    $timetotal = $timeend - $timestart;
    $r = number_format( $timetotal, $precision );
    if ( $display )
        echo $r;
    return $r;
}

/**
 * Load the database class file and instantiate the `$wpdb` global.
 *
 * @since 2.5.0
 *
 * @global wpdb $wpdb The WordPress database class.
 */
function require_wp_db() {
    global $wpdb;

    require_once( ABSPATH . WPINC . '/wp-db.php' );
    if ( file_exists( WP_CONTENT_DIR . '/db.php' ) )
        require_once( WP_CONTENT_DIR . '/db.php' );

    if ( isset( $wpdb ) ) {
        return;
    }

    $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );
}

/**
 * Set the database table prefix and the format specifiers for database
 * table columns.
 *
 * Columns not listed here default to `%s`.
 *
 * @since 3.0.0
 * @access private
 *
 * @global wpdb   $wpdb         The WordPress database class.
 * @global string $table_prefix The database table prefix.
 */
function wp_set_wpdb_vars() {
    global $wpdb, $table_prefix;
    if ( !empty( $wpdb->error ) )
        dead_db();

    $wpdb->field_types = array( 'post_author' => '%d', 'post_parent' => '%d', 'menu_order' => '%d', 'term_id' => '%d', 'term_group' => '%d', 'term_taxonomy_id' => '%d',
        'parent' => '%d', 'count' => '%d','object_id' => '%d', 'term_order' => '%d', 'ID' => '%d', 'comment_ID' => '%d', 'comment_post_ID' => '%d', 'comment_parent' => '%d',
        'user_id' => '%d', 'link_id' => '%d', 'link_owner' => '%d', 'link_rating' => '%d', 'option_id' => '%d', 'blog_id' => '%d', 'meta_id' => '%d', 'post_id' => '%d',
        'user_status' => '%d', 'umeta_id' => '%d', 'comment_karma' => '%d', 'comment_count' => '%d',
        // multisite:
        'active' => '%d', 'cat_id' => '%d', 'deleted' => '%d', 'lang_id' => '%d', 'mature' => '%d', 'public' => '%d', 'site_id' => '%d', 'spam' => '%d',
    );

    $prefix = $wpdb->set_prefix( $table_prefix );

    if ( is_wp_error( $prefix ) ) {
        wp_load_translations_early();
        wp_die(
        /* translators: 1: $table_prefix 2: wp-config.php */
            sprintf( __( '<strong>ERROR</strong>: %1$s in %2$s can only contain numbers, letters, and underscores.' ),
                '<code>$table_prefix</code>',
                '<code>wp-config.php</code>'
            )
        );
    }
}


/**
 * Determines if SSL is used.
 *
 * @since 2.6.0
 * @since 4.6.0 Moved from functions.php to load.php.
 *
 * @return bool True if SSL, otherwise false.
 */
function is_ssl() {
    if ( isset( $_SERVER['HTTPS'] ) ) {
        if ( 'on' == strtolower( $_SERVER['HTTPS'] ) ) {
            return true;
        }

        if ( '1' == $_SERVER['HTTPS'] ) {
            return true;
        }
    } elseif ( isset($_SERVER['SERVER_PORT'] ) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        return true;
    }
    return false;
}

/**
 * Converts a shorthand byte value to an integer byte value.
 *
 * @since 2.3.0
 * @since 4.6.0 Moved from media.php to load.php.
 *
 * @link https://secure.php.net/manual/en/function.ini-get.php
 * @link https://secure.php.net/manual/en/faq.using.php#faq.using.shorthandbytes
 *
 * @param string $value A (PHP ini) byte value, either shorthand or ordinary.
 * @return int An integer byte value.
 */
function wp_convert_hr_to_bytes( $value ) {
    $value = strtolower( trim( $value ) );
    $bytes = (int) $value;

    if ( false !== strpos( $value, 'g' ) ) {
        $bytes *= GB_IN_BYTES;
    } elseif ( false !== strpos( $value, 'm' ) ) {
        $bytes *= MB_IN_BYTES;
    } elseif ( false !== strpos( $value, 'k' ) ) {
        $bytes *= KB_IN_BYTES;
    }

    // Deal with large (float) values which run into the maximum integer size.
    return min( $bytes, PHP_INT_MAX );
}

