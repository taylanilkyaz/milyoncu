<?php
/**
 * WordPress için taban ayar dosyası.
 *
 * Bu dosya şu ayarları içerir: MySQL ayarları, tablo öneki,
 * gizli anahtaralr ve ABSPATH. Daha fazla bilgi için 
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php düzenleme}
 * yardım sayfasına göz atabilirsiniz. MySQL ayarlarınızı servis sağlayıcınızdan edinebilirsiniz.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * @package WordPress
 */

// ** MySQL ayarları - Bu bilgileri sunucunuzdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define('DB_NAME', 'b4u_dna_shop');

/** MySQL veritabanı kullanıcısı */
define('DB_USER', 'root');

/** MySQL veritabanı parolası */
define('DB_PASSWORD', 'asd123');

/** MySQL sunucusu */
define('DB_HOST', 'localhost');

/** Yaratılacak tablolar için veritabanı karakter seti. */
define('DB_CHARSET', 'utf8');

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define('DB_COLLATE', '');

/**#@+
 * Eşsiz doğrulama anahtarları.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz. Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_ ,+?~lY9VTD8b(0L0|-:1+x:}|>A9E}sU-Z [d=4$]v(aB?E+&8}d`&94$z<Ai-');
define('SECURE_AUTH_KEY',  'BZAh18,bhq;!|$24E+n-/#`D/{.#l&gz;S;I&3La>D=j;>[C(V_+QN+690K66Jk$');
define('LOGGED_IN_KEY',    'YXLs6r1g#*gVP9qkc*epe?1eUw}ukZ1x#I+A|C9U.afd6)lH#P(2c8L8f+4KFBhG');
define('NONCE_KEY',        'b`!ekq@M*ok?Sgg%]-+x598P|A*sA~s4MR)k&AU1~n;T:HZ`m4P4,.X_;-1?MaLz');
define('AUTH_SALT',        '%)J1$szY+%NOToxS/VHzVF-X;(65bkJ!-M%Bd<rSyr~Ha)Dr&)Rq[QJrATa 6#zB');
define('SECURE_AUTH_SALT', 'Z$:i+G.GhEuPfgdAnV<YDHWSZl4$eh<U0_y][e^DwT*`k0aNyNG{p$7}B[hs~|@V');
define('LOGGED_IN_SALT',   '[8h2`1!z[U`Z##wl*F>Ay1:qN!lp=CRfz[[:>H^H)JfhH#Fe-kw`g|]T+as`{Cm.');
define('NONCE_SALT',       'A4`uEn]<^]awsbf|M} >A#,uGs_7~mZxy?#c6-84i96Jpfq<CEPl3YIUO-|RH4v{');
/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix  = 'wp_';

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri "true" yaparak geliştirme sırasında hataların ekrana basılmasını sağlayabilirsiniz.
 * Tema ve eklenti geliştiricilerinin geliştirme aşamasında WP_DEBUG
 * kullanmalarını önemle tavsiye ederiz.
 */
define('WP_DEBUG', false);

/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** WordPress değişkenlerini ve yollarını kurar. */
require_once(ABSPATH . 'wp-settings.php');
