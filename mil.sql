-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                10.1.22-MariaDB - mariadb.org binary distribution
-- Sunucu İşletim Sistemi:       Win32
-- HeidiSQL Sürüm:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- b4u_dna için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `b4u_dna` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `b4u_dna`;

-- tablo yapısı dökülüyor b4u_dna.adres_kullanıcı_relation
CREATE TABLE IF NOT EXISTS `adres_kullanıcı_relation` (
  `kullanıcı_id` int(11) NOT NULL,
  `fatura_adresi_id` int(11) DEFAULT NULL,
  `kargo_adresi_id` int(11) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT '1',
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.adres_kullanıcı_relation: ~6 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `adres_kullanıcı_relation` DISABLE KEYS */;
INSERT IGNORE INTO `adres_kullanıcı_relation` (`kullanıcı_id`, `fatura_adresi_id`, `kargo_adresi_id`, `aktif`, `id`) VALUES
	(1, NULL, 1, 1, 1),
	(1, 1, NULL, 1, 2),
	(6, NULL, 2, 1, 3),
	(6, 2, NULL, 1, 4),
	(1, 3, NULL, 0, 5),
	(1, NULL, 3, 0, 6);
/*!40000 ALTER TABLE `adres_kullanıcı_relation` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.aktivasyon_kodu
CREATE TABLE IF NOT EXISTS `aktivasyon_kodu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aktivasyon_kodu` int(11) NOT NULL,
  `gönderim_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kullanıcı_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.aktivasyon_kodu: ~9 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `aktivasyon_kodu` DISABLE KEYS */;
INSERT IGNORE INTO `aktivasyon_kodu` (`id`, `aktivasyon_kodu`, `gönderim_zamanı`, `kullanıcı_id`) VALUES
	(3, 290704, '2017-09-13 17:31:03', 5),
	(4, 221183, '2017-09-18 17:04:24', 6),
	(5, 397018, '2017-09-18 17:06:59', 7),
	(6, 341519, '2017-09-18 17:29:20', 8),
	(8, 484777, '2017-09-19 16:52:23', 9),
	(9, 890711, '2017-09-19 18:31:45', 6),
	(10, 172349, '2017-09-19 18:32:14', 7),
	(11, 378939, '2017-09-19 18:33:31', 8),
	(12, 510627, '2017-12-29 03:20:58', 6);
/*!40000 ALTER TABLE `aktivasyon_kodu` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.alt_kategori
CREATE TABLE IF NOT EXISTS `alt_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `üst_id` int(11) DEFAULT NULL,
  `isim` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.alt_kategori: ~13 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `alt_kategori` DISABLE KEYS */;
INSERT IGNORE INTO `alt_kategori` (`id`, `üst_id`, `isim`) VALUES
	(1, 1, 'baba'),
	(2, 1, 'anne hamilelik'),
	(3, 1, 'kardeş'),
	(4, 1, 'büyükanne büyükbaba'),
	(5, 1, 'hala amca'),
	(6, 1, 'sadakatsizlik'),
	(7, 2, 'kedi'),
	(8, 2, 'köpek'),
	(9, 2, 'kuş'),
	(10, 2, 'at'),
	(11, 3, 'sağlıklı yaşam'),
	(12, 3, 'hastalık'),
	(13, 4, 'köken testleri');
/*!40000 ALTER TABLE `alt_kategori` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.fatura_adresi
CREATE TABLE IF NOT EXISTS `fatura_adresi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `soyad` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ülke` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `il` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ilçe` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `mahalle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `açık_adres` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `postakodu` int(11) NOT NULL DEFAULT '0',
  `telefon_numarası` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `adres_tipi` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.fatura_adresi: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `fatura_adresi` DISABLE KEYS */;
INSERT IGNORE INTO `fatura_adresi` (`id`, `ad`, `soyad`, `ülke`, `il`, `ilçe`, `mahalle`, `açık_adres`, `postakodu`, `telefon_numarası`, `adres_tipi`) VALUES
	(1, 'ayhan', 'yünt', 'tr', 'sivas', 'merkez', 'aydoğan', 'fatih mahallesi', 58040, '05456772303', 'ev'),
	(2, 'ayşe', 'akcan', 'tr', 'ankara', 'çankaya', 'beytepe', 'hacettepe üniversitesi', 6800, '05386151818', 'beytepe'),
	(3, 'ayhan', 'yünt', 'Türkiye', 'ankara', 'çankaya', 'beytepe', 'Hacettepe Teknokent', 6800, '05325698745', 'iş');
/*!40000 ALTER TABLE `fatura_adresi` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.kargo_adresi
CREATE TABLE IF NOT EXISTS `kargo_adresi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `soyad` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ülke` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `il` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ilçe` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `mahalle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `açık_adres` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `postakodu` int(11) NOT NULL DEFAULT '0',
  `telefon_numarası` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `adres_tipi` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.kargo_adresi: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kargo_adresi` DISABLE KEYS */;
INSERT IGNORE INTO `kargo_adresi` (`id`, `ad`, `soyad`, `ülke`, `il`, `ilçe`, `mahalle`, `açık_adres`, `postakodu`, `telefon_numarası`, `adres_tipi`) VALUES
	(1, 'ayhan', 'yünt', 'tr', 'sivas', 'merkez', 'aydoğan', 'fatih mahallesi', 58040, '05456772303', 'ev'),
	(2, 'ayşe', 'akcan', 'tr', 'ankara', 'çankaya', 'beytepe', 'hacettepe üniversitesi', 6800, '05386151818', 'beytepe'),
	(3, 'ayhan', 'yünt', 'Türkiye', 'ankara', 'çankaya', 'beytepe', 'Hacettepe Teknokent', 6800, '05325698745', 'iş');
/*!40000 ALTER TABLE `kargo_adresi` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.kategori: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT IGNORE INTO `kategori` (`id`, `isim`) VALUES
	(1, 'aile'),
	(2, 'hayvan'),
	(3, 'sağlık'),
	(4, 'köken');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.kullanıcılar
CREATE TABLE IF NOT EXISTS `kullanıcılar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `e_mail` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `tc` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `şifre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `soyad` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ekleme_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `telefon_numarası` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `e_mail` (`e_mail`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.kullanıcılar: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kullanıcılar` DISABLE KEYS */;
INSERT IGNORE INTO `kullanıcılar` (`id`, `e_mail`, `tc`, `şifre`, `ad`, `soyad`, `ekleme_zamanı`, `telefon_numarası`, `aktif`, `admin`) VALUES
	(1, 'ayhanyunt@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ayhan', 'yünt', '2017-08-06 20:42:45', '05456772303', 1, 0),
	(2, 'ednarge@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ali kemal', 'kırçakçı', '2017-08-07 12:37:46', '', 1, 1),
	(3, 'laboratuvar@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'labaratuvar', 'test', '2017-08-07 12:39:00', '', 1, 0),
	(5, 'test@test.com', '11111111111', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'test', 'deneme', '2017-09-13 17:28:42', '000000', 1, 0),
	(6, 'ayseakcan1907@gmail.com', '12565605338', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ayşe', 'akcan', '2017-12-29 03:20:58', '05386151818', 1, 0);
/*!40000 ALTER TABLE `kullanıcılar` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.loginattempts
CREATE TABLE IF NOT EXISTS `loginattempts` (
  `IP` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Attempts` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `e-mail` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.loginattempts: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `loginattempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginattempts` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.satın_alınanlar
CREATE TABLE IF NOT EXISTS `satın_alınanlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanıcı_id` int(11) NOT NULL DEFAULT '0',
  `ürün_id` int(11) NOT NULL,
  `sipariş_kodu` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.satın_alınanlar: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `satın_alınanlar` DISABLE KEYS */;
INSERT IGNORE INTO `satın_alınanlar` (`id`, `kullanıcı_id`, `ürün_id`, `sipariş_kodu`) VALUES
	(1, 1, 9, 'B1000001'),
	(2, 1, 8, 'B1000001'),
	(3, 1, 1, 'B1000002'),
	(4, 1, 2, 'B1000002'),
	(5, 1, 8, 'B1000002');
/*!40000 ALTER TABLE `satın_alınanlar` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.sepet
CREATE TABLE IF NOT EXISTS `sepet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ürün_id` int(11) NOT NULL,
  `kullanıcı_id` int(11) NOT NULL,
  `işlem_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`kullanıcı_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.sepet: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sepet` DISABLE KEYS */;
INSERT IGNORE INTO `sepet` (`id`, `ürün_id`, `kullanıcı_id`, `işlem_zamanı`) VALUES
	(3, 1, 5, '2017-09-19 19:17:43'),
	(4, 2, 6, '2017-12-29 17:21:38'),
	(5, 2, 6, '2017-12-29 17:21:39'),
	(9, 40, 1, '2017-12-30 02:44:44');
/*!40000 ALTER TABLE `sepet` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.sipariş_ilişkileri
CREATE TABLE IF NOT EXISTS `sipariş_ilişkileri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sipariş_kodu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ekleme_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `güncelleme_zamanı` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sipariş_durumu` int(11) NOT NULL DEFAULT '0',
  `kullanıcı_id` int(11) NOT NULL,
  `kargo_adres_id` int(11) DEFAULT NULL,
  `fatura_adres_id` int(11) DEFAULT NULL,
  `kargo_numarası` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.sipariş_ilişkileri: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sipariş_ilişkileri` DISABLE KEYS */;
INSERT IGNORE INTO `sipariş_ilişkileri` (`id`, `sipariş_kodu`, `ekleme_zamanı`, `güncelleme_zamanı`, `sipariş_durumu`, `kullanıcı_id`, `kargo_adres_id`, `fatura_adres_id`, `kargo_numarası`) VALUES
	(1, 'B1000001', '2017-08-17 20:22:45', '2017-12-30 03:39:10', 3, 1, 1, 1, 'S757465'),
	(2, 'B1000002', '2017-08-17 20:23:11', '2017-12-30 03:49:37', 2, 1, 1, 1, 'S457876');
/*!40000 ALTER TABLE `sipariş_ilişkileri` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.sorular
CREATE TABLE IF NOT EXISTS `sorular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanıcı_id` int(11) NOT NULL,
  `başlık` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `açıklama` text COLLATE utf8_unicode_ci NOT NULL,
  `ana_soru_id` int(11) NOT NULL,
  `ana_soru` tinyint(4) NOT NULL,
  `aktif` tinyint(4) NOT NULL,
  `ekleme_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`kullanıcı_id`),
  KEY `parent_ticket_id` (`ana_soru_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.sorular: ~11 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sorular` DISABLE KEYS */;
INSERT IGNORE INTO `sorular` (`id`, `kullanıcı_id`, `başlık`, `açıklama`, `ana_soru_id`, `ana_soru`, `aktif`, `ekleme_zamanı`) VALUES
	(1, 6, 'Para Sorunu', 'Fiyatlar çok fazla', -1, 1, 1, '2017-12-29 16:06:55'),
	(2, 2, '', 'N ealaka Efendim. Adı üstünde Milyoncu yuz', 1, 0, 1, '2017-12-29 16:07:49'),
	(3, 6, '', 'Aloooo', 1, 0, 1, '2017-12-29 16:15:30'),
	(4, 1, 'Kargo çok yavaş', 'Bir hafta da anca geliyor. Kontrol etmelisiniz.', -1, 1, 1, '2017-12-29 16:22:25'),
	(5, 2, '', 'Haklısınız. İnceleyeceğiz', 4, 0, 1, '2017-12-29 16:22:54'),
	(6, 2, '', 'Teşekkürler.', 4, 0, 1, '2017-12-29 16:25:02'),
	(7, 1, '', 'Ben Teşekkür Ederim', 4, 0, 1, '2017-12-29 16:33:32'),
	(8, 2, '', 'Özür Dileriz', 1, 0, 1, '2017-12-29 16:50:47'),
	(9, 6, '', 'Ne demek. aslında çok haklısınız.', 1, 0, 1, '2017-12-29 16:56:42'),
	(10, 6, '', 'Cevap atabilirdiiniz ama.', 1, 0, 1, '2017-12-29 17:08:11'),
	(11, 2, '', 'Haklısınız efendim. Size daha iyi hizmet verebilmek için uğraşmaktayız', 1, 0, 1, '2017-12-29 17:08:59');
/*!40000 ALTER TABLE `sorular` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.status_update_time
CREATE TABLE IF NOT EXISTS `status_update_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_status` int(11) NOT NULL,
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.status_update_time: ~13 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `status_update_time` DISABLE KEYS */;
INSERT IGNORE INTO `status_update_time` (`id`, `order_code`, `order_status`, `add_time`) VALUES
	(15, 'B1000002', 6, '2017-12-29 19:03:32'),
	(22, '<br />\n<font size=\'1\'><table class=\'xdebug-error x', -1, '2017-12-30 03:22:59'),
	(26, 'B1000001', 4, '2017-12-30 03:26:52'),
	(27, 'B1000001', 5, '2017-12-30 03:26:53'),
	(28, 'B1000001', 6, '2017-12-30 03:26:53'),
	(31, 'B1000002', 3, '2017-12-30 03:27:06'),
	(32, 'B1000002', 4, '2017-12-30 03:27:08'),
	(33, 'B1000002', 5, '2017-12-30 03:27:08'),
	(34, 'B1000001', 1, '2017-12-30 03:39:03'),
	(35, 'B1000001', 2, '2017-12-30 03:39:07'),
	(36, 'B1000001', 3, '2017-12-30 03:39:10'),
	(37, 'B1000002', 1, '2017-12-30 03:39:29'),
	(38, 'B1000002', 2, '2017-12-30 03:49:37');
/*!40000 ALTER TABLE `status_update_time` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.stored_card
CREATE TABLE IF NOT EXISTS `stored_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `card_user_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bin_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_holder_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.stored_card: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `stored_card` DISABLE KEYS */;
INSERT IGNORE INTO `stored_card` (`id`, `user_id`, `card_user_key`, `card_token`, `card_alias`, `bin_number`, `card_holder_name`, `add_datetime`) VALUES
	(2, 1, NULL, NULL, NULL, NULL, 'ayhan yünt', '2017-08-19 21:46:18'),
	(3, 6, NULL, NULL, NULL, NULL, 'ayşe akcan', '2017-12-29 17:26:29'),
	(5, 6, NULL, NULL, NULL, NULL, 'ayse akcan', '2017-12-29 17:32:43');
/*!40000 ALTER TABLE `stored_card` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.ürün
CREATE TABLE IF NOT EXISTS `ürün` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(255) NOT NULL,
  `fiyat` float NOT NULL,
  `kısa_açıklama` varchar(255) NOT NULL,
  `resim_yeri` varchar(255) NOT NULL,
  `alt_kategori_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `uzun_açıklama` text,
  PRIMARY KEY (`id`),
  KEY `name` (`isim`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- b4u_dna.ürün: ~24 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `ürün` DISABLE KEYS */;
INSERT IGNORE INTO `ürün` (`id`, `isim`, `fiyat`, `kısa_açıklama`, `resim_yeri`, `alt_kategori_id`, `kategori_id`, `uzun_açıklama`) VALUES
	(1, 'Bebek Cinsiyet Testi', 218.68, 'Bebek mi bekliyorsunuz? Kız mı yoksa erkek mi?  Bu test ile gebeliğin 9.haftasından itibaren aklınızdaki tüm soru işaretlerini kaldırıyoruz.', 'arkaplan2.jpg', 2, 1, 'Bebek mi bekliyorsunuz? Kız mı yoksa erkek mi?  Bebek cinsiyet testi ile bu soruya cevap almanızısağlıyoruz. Test, gebeliğin 9.haftasından itibaren uygulanabilir olup, son derece bilimsel tahminler sunar. Testimiz, kan örneğinizi kullanarak, akredite edilmiş laboratuvarlarımızdayapılır ve % 98 oranında doğruluk sağlar. '),
	(2, 'Hamilelikte Down Sendromu Testi', 490.42, 'Bebeğinizin Down Sendromlu olarak doğmasından endişe mi ediyorsunuz? Bu test ile gebeliğin 10. Haftasından itibaren sonucu öğrenebilirsiniz.', 'arkaplan3.jpg', 2, 1, 'Günümüzde, Down Sendromu\'nun erken teşhisi için %100 güvenli, Non-invaziv Prenatal Test (NIPT) adı verdiğimiz bir test mevcuttur.Bu test,gebeliğin 10. haftasından itibaren,anneden alınan kan örnekleri kullanılarak yapılır. Bebeğinizin Down Sendrom\'lu genleri taşıyıp taşımadığını %99 doğrulukla öğrenmeniz mümkün.'),
	(3, 'Küresel Konum Belirleme ile Köken Testi', 231.62, 'Bu test sizi atalarınızın geldiği ülkelere, şehirlere ve hatta adalara kadar götürebilir. Kökenlerinizi keşfetmeye hazır olun.', 'kuresel-konum-belirleme-testi.png', 13, 4, 'Bu test sizi atalarınızın geldiği ülkelere, şehirlere ve hatta adalara kadar götürebilir. Kökenlerinizi keşfetmeye hazır olun. '),
	(4, 'DNA\'ya göre Soy Testi', 166.93, 'Kökenlerinizi keşfetmek ve ailenizin geçmişi hakkında daha fazla şey öğrenmenin yolu bu testle başlar. ', 'arkaplan4.jpg', 13, 4, 'Bu biyo-coğrafik soy testi, gerçekleştirilmesi diğer testlere göre oldukça kolay ve yanlışsız bir testtir. Kökenlerinizi keşfetmek ve ailenizin geçmişi hakkında daha fazla şey öğrenmenin yolu bu testle başlar.'),
	(5, 'Atalara İlişkin Köken Testi', 192.8, 'Herkesin aklına bu soru mutlaka gelir: Atalarımız bu topraklara nereden geldiler? Sorunun cevabını zaten biliyorum diyorsanız o kadar emin olmayın ve soyunuzu çözmeye bu test başlayın.', 'atalara-iliskin-koken-testi.png', 13, 4, 'Herkesin aklına bu soru mutlaka gelir: Atalarımız bu topraklara nereden geldiler? Sorunun cevabını zaten biliyorum diyorsanız o kadar emin olmayın deriz. Soyunuzu çözmeye bu test başlayın. Testimiz, soy bilginizi benzersiz bir bakış açısıyla resmeder ve grafiklerle gösteri. Numuneler alındıktan sonraki 2 hafta içinde sonuçlarınız hazır! '),
	(6, 'Çölyak Hastalığı Genetik Testi', 148.81, 'Bu test Çölyak hastalığına genetik yatkınlığınız olup olmadığını sizlere en doğru şekilde söylüyor. Erken teşhis için hemen testimizi sipariş edin.', 'colyak-hastaligi-testi.png', 12, 3, 'Çölyak hastalığı genetik testi, çölyak hastalığına genetik yatkınlığınız olup olmadığını sizlere en doğru şekilde söylüyor. Erken teşhis için hemen testimizi sipariş edin.'),
	(7, 'Kanser Yatkınlığı İçin Yeni Nesil Kanser Panelleri', 0, 'Her kanser kalıtsal değildir fakat bazıları ise kalıtsaldır. Belirli bir kanser türüne ait gen taşıyıp taşımadığınızı öğrenmek istemez miydiniz?', 'kanser-yatkinligi-testi.png', 12, 3, 'Her kanser kalıtsal değildir fakat bazıları ise kalıtsaldır. Belirli bir kanser türüne ait gen taşıyıp taşımadığınızı öğrenmek istemez miydiniz ?'),
	(8, 'Sperm Belirleme Testi', 116.46, 'Kafanızdaki soru işaretlerine bir son vermenin zamanı gelmedi mi? ', 'sperm-belirleme-testi.png', 6, 1, 'Eşiniz ya da sevgilinizin sizi aldattığını mı düşünüyorsunuz? Sperm olduğundan şüphelendiğiniz lekeler mi buldunuz? Testimizi kullanın.'),
	(9, 'Sadakatsizlik DNA Testi', 386.93, 'Kafanızdaki soru işaretlerine bir son vermenin zamanı gelmedi mi? Şüphelerinizden testimiz sayesinde kurtulabilirsiniz. Şüphelerinizden testimiz sayesinde kurtulabilirsiniz.', 'sadakat-dna.png', 6, 1, 'Kafanızdaki soru işaretlerine bir son vermenin zamanı gelmedi mi? Şüphelerinizden testimiz sayesinde kurtulabilirsiniz. '),
	(10, 'Afetzede Kimliği Belirleme Testi', 0, 'DNA profillemesi, afetzedenin kimliklerini tanımlamada bir numaralı araçtır. Afetzedelerin kimliklerinin tanınmasında yardımcı olan bu testi sizlere sunuyoruz.', 'afetzede-kimligi-belirleme-testi.png', 12, 3, 'DNA profillemesi ,afetzedenin kimliklerini tanımlamada bir numaralıaraçtır. Afetzedelerin kimliklerinin tanınmasında yardımcı olan kadavradan doku çıkarma (ekstraksiyon) aletini sizlere sunuyoruz.'),
	(11, 'Sağlık ve Yaşam Tarzı DNA Testi', 128.11, 'Genetiğiniz sağlık ve refahınızı tamamen değiştirebilir. Yaşam tarzınızı değiştirmek ve sağlığınızı bir üst seviyeye çıkarmak istiyorsanız bu test tam size göre.', 'saglik-yasam-tarzi-dna-testi.png', 11, 3, 'Genetiğiniz sağlık ve refahınızı tamamen değiştirebilir.Sağlık ve Yaşam Tarzı DNA Testi bunu sizin yapıyor. Yaşam tarzınızıdeğiştirmek,sağlığınızı bir üst seviyeye çıkarmak için  testimizi sipariş edin. '),
	(12, 'Diyet ve Beslenme DNA Testi', 153.98, 'Diyet yapmaktan ve hiçbir şekilde sonuç alamamaktan bıktınız mı? Genetik ve beslenme artık el ele! Bu test size bu konuda yardımcı olacak. ', 'diyet-ve-beslenme-dna-testi.png', 11, 3, 'Diyet yapmaktan ve hiçbir şekilde sonuç alamamaktan bıktınız mı? Diyet ve Beslenme DNA Testi size bu konuda yardımcı olacak. Genetik ve beslenme el ele! Kilo vermek konusunda yaşadığınız sorunları geride bırakın.'),
	(13, 'Cilt Bakımı DNA Testi', 257.5, 'Unutmayın, herkesin cildi aynı değildir! Testimiz, benzersiz genetik yapınıza bakarak cildinizin yaşlanma sürecinin daha iyi kontrol edilmesini sağlar.', 'cilt-bakim-testi.png', 11, 3, 'Unutmayın, herkesin cildi aynıdeğildir! Testimiz, cildinizin koruyucu tedavisinde ve cildinizin bakımında en mükemmel nokta olup, benzersiz genetik yapınıza bakarak yaşlanma sürecinin daha iyi kontrol edilmesini sağlar. Sizlere sunduğumuz bu test, en yeni ve yenilikçi DNA testidir ve cildinizin tedavisi ve bakımının temelini oluşturur. '),
	(14, 'DNA ile Köpek Cinsi Belirleme Testi', 63.41, 'Karma cins bir köpeğe sahipseniz bu test kesinlikle size göre. İnsanlar size köpeğinizin cinsini sorduğunda artık zorluk çekmeyeceksiniz.', 'dna-ile-kopek-cinsiyet-belirleme-testi.png', 8, 2, 'Karma cins bir köpeğe sahipseniz bu test kesinlikle size göre. İnsanlar size köpeğinizin cinsini sorduğunda artık zorluk çekmeyeceksiniz '),
	(15, 'Köpek Irkı Kimlik Saptama Testi', 84.11, 'Köpeğiniz melez mi yoksa safkan mı? Sahibi olduğunuz köpeğin cinsini henüz bilmiyor ve öğrenmek istiyorsanız testimiz tam da ihtiyacınız olan şey.', 'kopek-irki-belirleme-testi.png', 8, 2, 'Köpeğiniz melez mi yoksa safkan mı? Sahibi olduğunuz köpeğin cinsini henüz bilmiyor ve öğrenmek istiyorsanız testimiz tam da ihtiyacınız olan şey. '),
	(16, 'Anne Olmadan Köpek DNA Testi', 257.5, 'Annenin numunesi olmadan bile köpeğinize ebeveyn testi yapabiliyoruz. Sonuçlarınız 10 iş günü içerisinde hazır.', 'anne-olmadan-kopek-dna-testi.png', 8, 2, 'Annenin numunesi olmadan bile köpeğinize ebevyn testi yapabiliyoruz. Sonuçlarınız 10 iş günü içerisinde hazır.'),
	(17, 'Köpek Ebeveyn Testi', 166.92, 'Patili dostunuzun gerçek ebeveynlerini kesin bir şekilde bulmak istemez miydiniz? Bu test sayesinde, köpeğinizin gerçek soyağacına bilimsel yollarla ulaşabilirsiniz.', 'köpek-ebevyn-testi.png', 8, 2, 'Patili dostunuzun gerçek ebeveynlerini kesin bir şekilde bulmak istemez miydiniz?Bu test sayesinde, köpek yetiştiricileri ve köpek sahipleri,% 99,9 doğrulukla köpeğin gerçek soyağacına bilimsel yollarla ulaşabilecekler.'),
	(18, 'Kalıtsal Köpek Hastalıkları ve Özellikleri Testi', 63.41, 'Sevgili köpeğinizin herhangi bir kalıtsal hastalığı olduğundan endişe ediyor olabilirsiniz. Sorularınızın cevabı için testimizi sipariş edebilirsiniz.', 'kalitsal-kopek-hastaliklari-testi.png', 8, 2, 'Sevgili köpeğinizin herhangi bir kalıtsal hastalığı olduğundan endişe ediyor olabilirsiniz. Daha önce bundan etkilenmemiş olabilir fakat bundan sonrasında da böyle mi olacak? Sorularınızın cevabı için testimizi sipariş edebilirsiniz.'),
	(19, 'Kuş Cinsiyet Belirleme Testi', 122.93, 'Kuşların cinsiyetlerini belirlemek oldukça zor. Testimiz sayesinde,%100 doğrulukla kuşlarınızın cinsiyetini öğrenebilmenizi sağlıyoruz.', 'kus-cinsiyet-testi.png', 9, 2, 'Kuşların cinsiyetlerini belirlemek oldukça zor. Testimiz sayesinde,%100 doğrulukla kuşlarınızın cinsiyetini öğrenebilmenizi sağlıyoruz. '),
	(20, 'Kedigiller Polikistik Böbrek Hastalığı DNA Testi', 50.46, 'Kedilerinizin sağlığının sizler için ne kadar önemli olduğunu biliyoruz. Onların ömrünü uzatmayı ve daha sağlıklı bir yaşam sürmelerini amaçlıyoruz.', 'kedigiller-polistik-bobrek-hastaligi-testi.png', 7, 2, 'Kedilerinizin sağlığının sizler için ne kadar önemli olduğunu biliyoruz. Onların ömrünü uzatmayı amaçlıyor,daha sağlıklı bir yaşam sürmelerini sağlıyoruz. '),
	(21, 'At DNA Testi', 0, 'Testimiz sayesinde at sahiplerinin ve at yetiştiricilerinin, atların sağlıklı yaşam seviyelerini en üst seviyeye çıkarmaları amaçlanmıştır. ', 'at-dna-testi.png', 10, 2, 'Testimiz sayesinde at yetiştiricilerinin, atların sağlıklıyaşam seviyelerini en üst seviyeye çıkarmaları amaçlanmıştır. Herhangi bir sağlık sorununa yatkınları olup olmadığını testimiz sayesinde öğrenebilirsiniz. '),
	(35, 'Köpek Dışkısıyla DNA Testi', 0, 'Sorumsuz köpek sahiplerinden bıktınız mı? Testimiz, köpeklerinin kakalarını halka açık yerlerden temizlemeyen köpek sahiplerini tespit etmenizi sağlıyor.', 'kopek-diskisi-ile-dna-testi.png', 8, 2, 'Sorumsuz köpek sahiplerinden bıktınız mı? Testimiz,köpeklerinin kakalarınıhalka açık yerlerden temizlemeyen köpek sahiplerini tespit etmenizi sağlıyor. '),
	(39, 'Koyun Sabun', 5, 'Süslü ve Kokulu sabun', '12841251_1074548082612917_8682153281614067795_o.jpg', 1, 1, 'tanesi 5 lira'),
	(40, 'Steteskop', 15, 'Oyuncak', 'stethoscope.png', 1, 1, 'Dokturculuk için üretildi');
/*!40000 ALTER TABLE `ürün` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.ürün_yorumları
CREATE TABLE IF NOT EXISTS `ürün_yorumları` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ürün_id` int(11) DEFAULT NULL,
  `kullanıcı_id` int(11) DEFAULT NULL,
  `başlık` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `içerik` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekleme_zamanı` datetime DEFAULT CURRENT_TIMESTAMP,
  `puan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.ürün_yorumları: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `ürün_yorumları` DISABLE KEYS */;
INSERT IGNORE INTO `ürün_yorumları` (`id`, `ürün_id`, `kullanıcı_id`, `başlık`, `içerik`, `ekleme_zamanı`, `puan`) VALUES
	(3, 8, 1, 'rewqq', 'qwerwq', '2017-09-13 14:31:09', 4),
	(9, 1, 1, 'ayhan5', 'ayhan', '2017-09-13 17:13:06', 4),
	(10, 1, 1, 'ayhan6', 'ayhan', '2017-09-13 17:14:20', 4),
	(11, 2, 1, '', 'güzel ürün faydalı', '2017-12-30 02:31:40', 3);
/*!40000 ALTER TABLE `ürün_yorumları` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
