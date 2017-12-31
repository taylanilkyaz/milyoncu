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


-- milyoncu için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `milyoncu` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `milyoncu`;

-- tablo yapısı dökülüyor milyoncu.adres_kullanıcı_relation
CREATE TABLE IF NOT EXISTS `adres_kullanıcı_relation` (
  `kullanıcı_id` int(11) NOT NULL,
  `fatura_adresi_id` int(11) DEFAULT NULL,
  `kargo_adresi_id` int(11) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT '1',
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.adres_kullanıcı_relation: ~6 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `adres_kullanıcı_relation` DISABLE KEYS */;
INSERT IGNORE INTO `adres_kullanıcı_relation` (`kullanıcı_id`, `fatura_adresi_id`, `kargo_adresi_id`, `aktif`, `id`) VALUES
	(1, NULL, 1, 1, 1),
	(1, 1, NULL, 1, 2),
	(6, NULL, 2, 1, 3),
	(6, 2, NULL, 1, 4),
	(1, 3, NULL, 0, 5),
	(1, NULL, 3, 0, 6);
/*!40000 ALTER TABLE `adres_kullanıcı_relation` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.aktivasyon_kodu
CREATE TABLE IF NOT EXISTS `aktivasyon_kodu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aktivasyon_kodu` int(11) NOT NULL,
  `gönderim_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kullanıcı_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.aktivasyon_kodu: ~9 rows (yaklaşık) tablosu için veriler indiriliyor
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

-- tablo yapısı dökülüyor milyoncu.alt_kategori
CREATE TABLE IF NOT EXISTS `alt_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `üst_id` int(11) DEFAULT NULL,
  `isim` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.alt_kategori: ~20 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `alt_kategori` DISABLE KEYS */;
INSERT IGNORE INTO `alt_kategori` (`id`, `üst_id`, `isim`) VALUES
	(1, 1, 'cam'),
	(2, 1, 'porselen'),
	(3, 2, 'defter'),
	(4, 2, 'kalem'),
	(5, 3, 'avize'),
	(6, 3, 'masa lambası'),
	(7, 4, 'küpe'),
	(8, 4, 'kolye'),
	(9, 4, 'yüzük'),
	(10, 5, 'bardak'),
	(11, 5, 'çatal bıçak'),
	(12, 5, 'çaydanlık'),
	(13, 5, 'tencere'),
	(14, 5, 'banyo aksesuarları'),
	(15, 7, 'kız'),
	(16, 7, 'erkek'),
	(17, 8, 'kişisel bakım'),
	(18, 8, 'ev temizliği'),
	(19, 9, 'hediye'),
	(20, 6, 'hırdavat');
/*!40000 ALTER TABLE `alt_kategori` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.fatura_adresi
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

-- milyoncu.fatura_adresi: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `fatura_adresi` DISABLE KEYS */;
INSERT IGNORE INTO `fatura_adresi` (`id`, `ad`, `soyad`, `ülke`, `il`, `ilçe`, `mahalle`, `açık_adres`, `postakodu`, `telefon_numarası`, `adres_tipi`) VALUES
	(1, 'ayhan', 'yünt', 'tr', 'sivas', 'merkez', 'aydoğan', 'fatih mahallesi', 58040, '05456772303', 'ev'),
	(2, 'ayşe', 'akcan', 'tr', 'ankara', 'çankaya', 'beytepe', 'hacettepe üniversitesi', 6800, '05386151818', 'beytepe'),
	(3, 'ayhan', 'yünt', 'Türkiye', 'ankara', 'çankaya', 'beytepe', 'Hacettepe Teknokent', 6800, '05325698745', 'iş');
/*!40000 ALTER TABLE `fatura_adresi` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.girişler
CREATE TABLE IF NOT EXISTS `girişler` (
  `id` int(11) NOT NULL,
  `e_mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `giriş_zamanı` datetime NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `çıkış_zamanı` datetime NOT NULL,
  PRIMARY KEY (`çıkış_zamanı`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.girişler: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `girişler` DISABLE KEYS */;
/*!40000 ALTER TABLE `girişler` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.kargo_adresi
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

-- milyoncu.kargo_adresi: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kargo_adresi` DISABLE KEYS */;
INSERT IGNORE INTO `kargo_adresi` (`id`, `ad`, `soyad`, `ülke`, `il`, `ilçe`, `mahalle`, `açık_adres`, `postakodu`, `telefon_numarası`, `adres_tipi`) VALUES
	(1, 'ayhan', 'yünt', 'tr', 'sivas', 'merkez', 'aydoğan', 'fatih mahallesi', 58040, '05456772303', 'ev'),
	(2, 'ayşe', 'akcan', 'tr', 'ankara', 'çankaya', 'beytepe', 'hacettepe üniversitesi', 6800, '05386151818', 'beytepe'),
	(3, 'ayhan', 'yünt', 'Türkiye', 'ankara', 'çankaya', 'beytepe', 'Hacettepe Teknokent', 6800, '05325698745', 'iş');
/*!40000 ALTER TABLE `kargo_adresi` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.kargo_şirketleri
CREATE TABLE IF NOT EXISTS `kargo_şirketleri` (
  `id` int(11) NOT NULL,
  `isim` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `süre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fiyat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `isim` (`isim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.kargo_şirketleri: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kargo_şirketleri` DISABLE KEYS */;
INSERT IGNORE INTO `kargo_şirketleri` (`id`, `isim`, `süre`, `fiyat`) VALUES
	(1, 'Aras Kargo', '6', '6'),
	(2, 'Sürat Kargo', '5', '8'),
	(3, 'Ups Kargo', '4', '9'),
	(4, 'Hızlı Kargo', '3', '10');
/*!40000 ALTER TABLE `kargo_şirketleri` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.kategori: ~9 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT IGNORE INTO `kategori` (`id`, `isim`) VALUES
	(1, 'züccaciye'),
	(2, 'kırtasiye'),
	(3, 'Aydınlatma'),
	(4, 'bujiteri'),
	(5, 'Mutfak & Banyo'),
	(6, 'Hırdavat'),
	(7, 'Oyuncak'),
	(8, 'Temizlik'),
	(9, 'Hediyelik');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.kaydedilen_kartlar
CREATE TABLE IF NOT EXISTS `kaydedilen_kartlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanıcı_id` int(11) DEFAULT NULL,
  `kart_numarası` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ad_soyad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cvc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ay` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yıl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekleme_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.kaydedilen_kartlar: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kaydedilen_kartlar` DISABLE KEYS */;
INSERT IGNORE INTO `kaydedilen_kartlar` (`id`, `kullanıcı_id`, `kart_numarası`, `ad_soyad`, `cvc`, `ay`, `yıl`, `ekleme_zamanı`) VALUES
	(10, 6, '1111111111111111', 'ayse akcan', '555', '10', '20', '2017-12-31 01:30:44');
/*!40000 ALTER TABLE `kaydedilen_kartlar` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.kullanıcılar
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

-- milyoncu.kullanıcılar: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kullanıcılar` DISABLE KEYS */;
INSERT IGNORE INTO `kullanıcılar` (`id`, `e_mail`, `tc`, `şifre`, `ad`, `soyad`, `ekleme_zamanı`, `telefon_numarası`, `aktif`, `admin`) VALUES
	(1, 'ayhanyunt@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ayhan', 'yünt', '2017-08-06 20:42:45', '05456772303', 1, 0),
	(2, 'milyoncu@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ali kemal', 'kırçakçı', '2017-08-07 12:37:46', '', 1, 1),
	(6, 'ayseakcan1907@gmail.com', '12565605338', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ayşe', 'akcan', '2017-12-29 03:20:58', '05386151818', 1, 0);
/*!40000 ALTER TABLE `kullanıcılar` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.satın_alınanlar
CREATE TABLE IF NOT EXISTS `satın_alınanlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanıcı_id` int(11) NOT NULL DEFAULT '0',
  `ürün_id` int(11) NOT NULL,
  `sipariş_kodu` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.satın_alınanlar: ~20 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `satın_alınanlar` DISABLE KEYS */;
INSERT IGNORE INTO `satın_alınanlar` (`id`, `kullanıcı_id`, `ürün_id`, `sipariş_kodu`) VALUES
	(1, 1, 9, 'B1000001'),
	(2, 1, 8, 'B1000001'),
	(3, 1, 1, 'B1000002'),
	(4, 1, 2, 'B1000002'),
	(5, 1, 8, 'B1000002'),
	(6, 1, 8, 'B1000003'),
	(7, 1, 8, 'B1000003'),
	(8, 1, 8, 'B1000003'),
	(9, 6, 2, 'B1000004'),
	(10, 6, 2, 'B1000004'),
	(11, 6, 2, 'B1000004'),
	(12, 6, 2, 'B1000004'),
	(13, 6, 8, 'B1000005'),
	(14, 6, 10, 'B1000005'),
	(15, 6, 10, 'B1000005'),
	(16, 6, 10, 'B1000005'),
	(17, 6, 11, 'B1000005'),
	(18, 6, 11, 'B1000005'),
	(19, 6, 8, 'B1000006'),
	(20, 6, 8, 'B1000006');
/*!40000 ALTER TABLE `satın_alınanlar` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.sepet
CREATE TABLE IF NOT EXISTS `sepet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ürün_id` int(11) NOT NULL,
  `kullanıcı_id` int(11) NOT NULL,
  `işlem_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`kullanıcı_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.sepet: ~30 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sepet` DISABLE KEYS */;
INSERT IGNORE INTO `sepet` (`id`, `ürün_id`, `kullanıcı_id`, `işlem_zamanı`) VALUES
	(3, 1, 5, '2017-09-19 19:17:43'),
	(13, 8, 3, '2017-12-30 19:38:23'),
	(14, 9, 3, '2017-12-30 19:38:25'),
	(15, 10, 3, '2017-12-30 19:38:26'),
	(16, 11, 3, '2017-12-30 19:38:27'),
	(17, 7, 3, '2017-12-30 19:38:28'),
	(18, 12, 3, '2017-12-30 19:38:29'),
	(19, 13, 3, '2017-12-30 19:38:29'),
	(20, 14, 3, '2017-12-30 19:38:31'),
	(21, 15, 3, '2017-12-30 19:38:31'),
	(22, 16, 3, '2017-12-30 19:38:32'),
	(23, 1, 3, '2017-12-30 19:38:33'),
	(24, 2, 3, '2017-12-30 19:38:34'),
	(25, 3, 3, '2017-12-30 19:38:34'),
	(26, 17, 3, '2017-12-30 19:38:35'),
	(27, 18, 3, '2017-12-30 19:38:36'),
	(28, 19, 3, '2017-12-30 19:38:37'),
	(29, 20, 3, '2017-12-30 19:38:37'),
	(30, 21, 3, '2017-12-30 19:38:38'),
	(31, 4, 3, '2017-12-30 19:38:39'),
	(32, 5, 3, '2017-12-30 19:38:40'),
	(33, 35, 3, '2017-12-30 19:38:41'),
	(34, 39, 3, '2017-12-30 19:38:41'),
	(35, 6, 3, '2017-12-30 19:38:43'),
	(36, 40, 3, '2017-12-30 19:38:43'),
	(37, 41, 3, '2017-12-30 19:38:44'),
	(38, 42, 3, '2017-12-30 19:38:49'),
	(39, 43, 3, '2017-12-30 19:38:49'),
	(40, 7, 3, '2017-12-30 19:43:27'),
	(41, 7, 3, '2017-12-30 19:43:27');
/*!40000 ALTER TABLE `sepet` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.sipariş_durumu
CREATE TABLE IF NOT EXISTS `sipariş_durumu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sipariş_kodu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `durum` int(11) NOT NULL,
  `ekleme_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.sipariş_durumu: ~19 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sipariş_durumu` DISABLE KEYS */;
INSERT IGNORE INTO `sipariş_durumu` (`id`, `sipariş_kodu`, `durum`, `ekleme_zamanı`) VALUES
	(15, 'B1000002', 6, '2017-12-29 19:03:32'),
	(22, '<br />\n<font size=\'1\'><table class=\'xdebug-error x', -1, '2017-12-30 03:22:59'),
	(26, 'B1000001', 4, '2017-12-30 03:26:52'),
	(27, 'B1000001', 5, '2017-12-30 03:26:53'),
	(28, 'B1000001', 6, '2017-12-30 03:26:53'),
	(32, 'B1000002', 4, '2017-12-30 03:27:08'),
	(33, 'B1000002', 5, '2017-12-30 03:27:08'),
	(34, 'B1000001', 1, '2017-12-30 03:39:03'),
	(35, 'B1000001', 2, '2017-12-30 03:39:07'),
	(36, 'B1000001', 3, '2017-12-30 03:39:10'),
	(39, 'B1000002', 1, '2017-12-30 16:04:13'),
	(40, 'B1000002', 2, '2017-12-30 17:05:13'),
	(41, 'B1000002', 3, '2017-12-30 17:05:17'),
	(42, 'B1000003', 1, '2017-12-30 17:05:22'),
	(43, 'B1000003', 2, '2017-12-30 17:05:23'),
	(44, 'B1000003', 3, '2017-12-30 17:05:24'),
	(45, 'B1000004', 1, '2017-12-31 01:38:37'),
	(46, 'B1000005', 1, '2017-12-31 01:38:40'),
	(47, 'B1000006', 1, '2017-12-31 01:38:42');
/*!40000 ALTER TABLE `sipariş_durumu` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.sipariş_ilişkileri
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.sipariş_ilişkileri: ~6 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sipariş_ilişkileri` DISABLE KEYS */;
INSERT IGNORE INTO `sipariş_ilişkileri` (`id`, `sipariş_kodu`, `ekleme_zamanı`, `güncelleme_zamanı`, `sipariş_durumu`, `kullanıcı_id`, `kargo_adres_id`, `fatura_adres_id`, `kargo_numarası`) VALUES
	(1, 'B1000001', '2017-08-17 20:22:45', '2017-12-30 03:39:10', 3, 1, 1, 1, 'S757465'),
	(2, 'B1000002', '2017-08-17 20:23:11', '2017-12-30 17:05:17', 3, 1, 1, 1, 'S457876'),
	(3, 'B1000003', '2017-12-30 16:58:27', '2017-12-30 17:05:35', 3, 1, 1, 1, 'S457877'),
	(4, 'B1000004', '2017-12-31 00:16:35', '2017-12-31 01:38:37', 1, 6, 2, 2, NULL),
	(5, 'B1000005', '2017-12-31 00:47:33', '2017-12-31 01:38:40', 1, 6, 2, 2, NULL),
	(6, 'B1000006', '2017-12-31 01:34:51', '2017-12-31 01:38:42', 1, 6, 2, 2, NULL);
/*!40000 ALTER TABLE `sipariş_ilişkileri` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.sorular
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.sorular: ~12 rows (yaklaşık) tablosu için veriler indiriliyor
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
	(11, 2, '', 'Haklısınız efendim. Size daha iyi hizmet verebilmek için uğraşmaktayız', 1, 0, 1, '2017-12-29 17:08:59'),
	(12, 6, 'Kart kaydetmek ', 'Kart kaydetmek güvenli midir?', -1, 1, 1, '2017-12-31 00:19:19');
/*!40000 ALTER TABLE `sorular` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.ürün
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- milyoncu.ürün: ~27 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `ürün` DISABLE KEYS */;
INSERT IGNORE INTO `ürün` (`id`, `isim`, `fiyat`, `kısa_açıklama`, `resim_yeri`, `alt_kategori_id`, `kategori_id`, `uzun_açıklama`) VALUES
	(1, 'İkili Metal Banyo Köşelik', 20, 'Banyonuzun daha derli toplu olması için bu ürünü almalısınız.', '2-li-metal-banyo-koselik.JPG', 14, 5, 'Banyonuzun daha derli toplu olması için bu ürünü almalısınız.'),
	(2, 'Metal Çöp Kovası', 15, 'Hacmi 3 litre olup , evinizin havasını değiştirebilecek bir üründür . ', '3-litre-metal-cop-kovasi.JPG', 14, 5, 'Hacmi 3 litre olup , evinizin havasını değiştirebilecek bir üründür . '),
	(3, 'Üçlü Metal Banyo Köşelik', 30, 'Banyonuzun daha derli toplu olması için bu ürünü almalısınız.', '3-lu-metal-banyo-koselik.JPG', 14, 5, 'Banyonuzun daha derli toplu olması için bu ürünü almalısınız.'),
	(4, 'Koli Bandı', 5, '30 metre boyunda ,  her zemine uygun , şeffaf bir üründür ', '30-metre-koli-bandi-seffaf.JPG', 20, 6, '30 metre boyunda ,  her zemine uygun , şeffaf bir üründür '),
	(5, 'Japon Yapıştırıcısı', 3, '502 markalı olup , kullanılan zeminleri saniyeler içerisinde tamamen yapıştırır. ', '502-yapistirici-.jpg', 20, 6, '502 markalı olup , kullanılan zeminleri saniyeler içerisinde tamamen yapıştırır. '),
	(6, 'Temizlik Bezi', 3, 'Acord 3 lü temizlik bezi ile cam , mermer ,ahşap zeminlerinizi parlatın', 'acord-3lu-temizlik-bezi.jpg', 18, 8, 'Acord 3 lü temizlik bezi ile cam , mermer ,ahşap zeminlerinizi parlatın'),
	(7, 'Ahşap Havan', 8, 'Farklı boyutlarda yüzde yüz organik ve ahşaptır.', 'ahsap-havan.JPG', 12, 3, 'Farklı boyutlarda yüzde yüz organik ve ahşaptır.'),
	(8, 'Porselen Çay Takımı', 40, 'Özel misafirlerinize çay sunmak mükemmel bir üründür .', 'beyaz-porselen-cay-takimi.JPG', 2, 1, 'Özel misafirlerinize çay sunmak mükemmel bir üründür .'),
	(9, 'Cam Nescafe Takımı', 35, 'Özel misafirlerinize kahve sunmak için , tam istediğiniz özelliklerde cam nescafe takımıdır .', 'cam-nescafe-takimi.JPG', 1, 1, 'Özel misafirlerinize kahve sunmak için , tam istediğiniz özelliklerde cam nescafe takımıdır .'),
	(10, 'Renkli Defter', 5, 'Notlarınızı kaydetmek için , farklı renklere sahip mükemmel defter', 'defter.jpg', 3, 2, 'Notlarınızı kaydetmek için , farklı renklere sahip mükemmel defter'),
	(11, 'Tükenmez Kalem', 3, 'Yazınıza estetiklik ve renk katabilecek mükemmel bir üründür', 'kalem.jpg', 4, 2, 'Yazınıza estetiklik ve renk katabilecek mükemmel bir üründür'),
	(12, 'Taşlı Avize', 60, 'Evinizi aydınlatacak , özenle seçilmiş taşlarla ile süslenmis avize', 'avize.jpg', 5, 3, 'Evinizi aydınlatacak , özenle seçilmiş taşlarla ile süslenmis avize'),
	(13, 'Kullanışlı Masa Lambası', 15, 'Odanızı ışığı gözünüzü mü yordu ? O zaman sadece bunu dene ve masanı aydıtlat.', 'masalambası.jpg', 6, 3, 'Odanızı ışığı gözünüzü mü yordu ? O zaman sadece bunu dene ve masanı aydıtlat.'),
	(14, 'Gümüş Küpe', 16, 'Kulanığınızda parlayıp , etrafınızdakileri büyüleyecek küpe modelleri', 'taki-cesitleri.jpg', 7, 4, 'Kulanığınızda parlayıp , etrafınızdakileri büyüleyecek küpe modelleri'),
	(15, 'Kelebek Kolye', 14, 'Bu güzel ürünle etrafınızdakileri büyüleyebilirsiniz.', 'takim-taki-cesidi.jpg', 8, 4, 'Bu güzel ürünle etrafınızdakileri büyüleyebilirsiniz.'),
	(16, 'Altın Yüzük', 100, 'Parmağınızda ışıl ışıl parlayacak , nadide bir eser', 'yuzuk.jpg', 9, 4, 'Parmağınızda ışıl ışıl parlayacak , nadide bir eser'),
	(17, 'Kupa Bardak', 4, 'Kahvenizi veya çayınızı bir de bu bardaktan içmelisiniz', 'kupa-bardak-cesitleri.jpg', 10, 5, 'Kahvenizi veya çayınızı bir de bu bardaktan içmelisiniz'),
	(18, 'Meşrubat Bardağı', 17, 'Misafirlerinize meşrubatlarınızı bu bardakla sunmak ayrıcaklıktır . ', 'ayakli-mesrubat-bardagi.jpeg', 10, 5, 'Misafirlerinize meşrubatlarınızı bu bardakla sunmak ayrıcaklıktır . '),
	(19, 'Gümüş Çatal Bıçak Seti', 120, 'Özel günlerinizi parlatacak mükemmel çatal bıçak setini deneyiniz.', 'catalbıcak.jpg', 11, 5, 'Özel günlerinizi parlatacak mükemmel çatal bıçak setini deneyiniz.'),
	(20, 'Geniş Hazneli Çaydanlık', 46, 'Özel rengi ve geniş haznesi ile bir karaca ürünüdür .', 'caydanlık.jpg', 12, 5, 'Özel rengi ve geniş haznesi ile bir karaca ürünüdür .'),
	(21, 'Tencere Takımı', 45, 'Granit bir ürün olup yapışmaz tabanı ile tam işini görecek bir settir.', 'tencere.jpg', 13, 5, 'Granit bir ürün olup yapışmaz tabanı ile tam işini görecek bir settir.'),
	(35, 'Karbela Balık Tutma Oyuncağı', 16, 'Çocuğunuzun el becerilerini ve görsel zekasını arttıracak bir oyuncaktır.', 'erkekoyuncak.JPG', 16, 7, 'Çocuğunuzun el becerilerini ve görsel zekasını arttıracak bir oyuncaktır.'),
	(39, 'Oyuncak Çay Seti', 14, 'Çocuğunuzun evcilik oyunlarını daha eğlenceli hale getirir . ', 'kızoyuncak.JPG', 15, 7, 'Çocuğunuzun evcilik oyunlarını daha eğlenceli hale getirir . '),
	(40, 'Gül Kokulu Islak Mendil', 5, 'İçinden 80 adet çıkıp , uzun havlu modeli ile işinizi kolaylaştırır . ', 'ıslakmendil.JPG', 17, 8, 'İçinden 80 adet çıkıp , uzun havlu modeli ile işinizi kolaylaştırır . '),
	(41, 'Baca Temizleyici', 3, 'Tıkanan bacaların korkulu rüyası Tatar Baca Temizleyici', 'baca-temizleyici.JPG', 18, 8, 'Tıkanan bacaların korkulu rüyası Tatar Baca Temizleyici'),
	(42, 'Taraftar Kumbara', 5, 'Arkadaşınızın tuttuğu takıma göre, özel kumbarasını hediye edebilirsiniz.', 'taraftar-kumbara-.JPG', 19, 9, 'Arkadaşınızın tuttuğu takıma göre, özel kumbarasını hediye edebilirsiniz.'),
	(43, 'Hediyelik Metal Kalemlik', 7, 'Güzel disaynı ile etkileyici ve kullanışlı , insan kalemlik modeli .', 'metal-adam-kalemlik.JPG', 19, 9, 'Güzel disaynı ile etkileyici ve kullanışlı , insan kalemlik modeli .');
/*!40000 ALTER TABLE `ürün` ENABLE KEYS */;

-- tablo yapısı dökülüyor milyoncu.ürün_yorumları
CREATE TABLE IF NOT EXISTS `ürün_yorumları` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ürün_id` int(11) DEFAULT NULL,
  `kullanıcı_id` int(11) DEFAULT NULL,
  `başlık` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `içerik` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekleme_zamanı` datetime DEFAULT CURRENT_TIMESTAMP,
  `puan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.ürün_yorumları: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `ürün_yorumları` DISABLE KEYS */;
INSERT IGNORE INTO `ürün_yorumları` (`id`, `ürün_id`, `kullanıcı_id`, `başlık`, `içerik`, `ekleme_zamanı`, `puan`) VALUES
	(3, 8, 1, 'rewqq', 'qwerwq', '2017-09-13 14:31:09', 4),
	(9, 1, 1, 'ayhan5', 'ayhan', '2017-09-13 17:13:06', 4),
	(10, 1, 1, 'ayhan6', 'ayhan', '2017-09-13 17:14:20', 4),
	(11, 2, 1, '', 'güzel ürün faydalı', '2017-12-30 02:31:40', 3),
	(12, 10, 6, '', 'tam istediğim gibi bir defter :)', '2017-12-31 00:18:10', 5);
/*!40000 ALTER TABLE `ürün_yorumları` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
