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
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `kullanıcı_id` int(11) NOT NULL,
  `fatura_adresi_id` int(11) DEFAULT NULL,
  `kargo_adresi_id` int(11) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.adres_kullanıcı_relation: ~10 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `adres_kullanıcı_relation` DISABLE KEYS */;
INSERT IGNORE INTO `adres_kullanıcı_relation` (`id`, `kullanıcı_id`, `fatura_adresi_id`, `kargo_adresi_id`, `aktif`) VALUES
	(1, 1, NULL, 1, 1),
	(2, 1, 1, NULL, 1),
	(3, 6, NULL, 2, 1),
	(4, 6, 2, NULL, 0),
	(5, 1, 3, NULL, 0),
	(6, 1, NULL, 3, 0),
	(7, 6, 4, NULL, 1),
	(8, 6, NULL, 4, 0),
	(9, 7, NULL, 5, 1),
	(10, 7, 5, NULL, 1);
/*!40000 ALTER TABLE `adres_kullanıcı_relation` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.adres_kullanıcı_relation_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `adres_kullanıcı_relation_delete`(
	IN `a_id` TINYINT
)
BEGIN
	DELETE FROM adres_kullanıcı_relation WHERE id=a_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.adres_kullanıcı_relation_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `adres_kullanıcı_relation_insert`(
	IN `kullanıcı_id` INT,
	IN `fatura_adresi_id` INT,
	IN `kargo_adresi_id` INT,
	IN `aktif` INT
)
BEGIN
 INSERT INTO adres_kullanıcı_relation (kullanıcı_id, fatura_adresi_id , kargo_adresi_id , aktif )
   VALUES (kullanıcı_id, fatura_adresi_id , kargo_adresi_id , aktif );
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.adres_kullanıcı_relation_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `adres_kullanıcı_relation_update`(
	IN `k_id` INT,
	IN `f_id` INT,
	IN `c_id` INT,
	IN `act` INT,
	IN `r_id` INT
)
BEGIN
	UPDATE adres_kullanıcı_relation 
	SET kullanıcı_id=k_id, fatura_adresi_id=f_id, kargo_adresi_id=c_id, aktif=act WHERE id=r_id;
END//
DELIMITER ;

-- tablo yapısı dökülüyor milyoncu.aktivasyon_kodu
CREATE TABLE IF NOT EXISTS `aktivasyon_kodu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aktivasyon_kodu` int(11) NOT NULL,
  `gönderim_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kullanıcı_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- yöntem yapısı dökülüyor milyoncu.aktivasyon_kodu_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `aktivasyon_kodu_delete`(
	IN `a_id` INT
)
BEGIN
	DELETE FROM aktivasyon_kodu WHERE id=a_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.aktivasyon_kodu_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `aktivasyon_kodu_insert`(
	IN `aktivasyon_kodu` INT,
	IN `kullanıcı_id` INT
)
BEGIN
 INSERT INTO aktivasyon_kodu (aktivasyon_kodu , kullanıcı_id )
   VALUES (aktivasyon_kodu , kullanıcı_id );
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.aktivasyon_kodu_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `aktivasyon_kodu_update`(
	IN `code` INT,
	IN `k_id` INT,
	IN `a_id` INT
)
BEGIN
	UPDATE aktivasyon_kodu SET aktivasyon_kodu=code , kullanıcı_id=k_id  WHERE id=a_id;
END//
DELIMITER ;

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

-- yöntem yapısı dökülüyor milyoncu.alt_kategori_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `alt_kategori_delete`(
	IN `k_id` INT
)
BEGIN
	DELETE FROM alt_kategori WHERE id=k_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.alt_kategori_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `alt_kategori_insert`(
	IN `üst_id` INT,
	IN `isim` VARCHAR(50)
)
BEGIN
 INSERT INTO alt_kategori (üst_id , isim )
   VALUES (üst_id , isim);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.alt_kategori_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `alt_kategori_update`(
	IN `ust_id` INT,
	IN `name` VARCHAR(50)
)
BEGIN
	UPDATE alt_kategori SET üst_id=ust_id , isim=name WHERE id=k_id;
END//
DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.fatura_adresi: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `fatura_adresi` DISABLE KEYS */;
INSERT IGNORE INTO `fatura_adresi` (`id`, `ad`, `soyad`, `ülke`, `il`, `ilçe`, `mahalle`, `açık_adres`, `postakodu`, `telefon_numarası`, `adres_tipi`) VALUES
	(1, 'ayhan', 'yünt', 'tr', 'sivas', 'merkez', 'aydoğan', 'fatih mahallesi', 58040, '05456772303', 'ev'),
	(2, 'ayşe', 'akcan', 'tr', 'ankara', 'çankaya', 'beytepe', 'hacettepe üniversitesi', 6800, '05386151818', 'beytepe'),
	(3, 'ayhan', 'yünt', 'Türkiye', 'ankara', 'çankaya', 'beytepe', 'Hacettepe Teknokent', 6800, '05325698745', 'iş'),
	(4, 'ayşe', 'akcan', 'Türkiye', 'Ankara', 'etimesgut', 'elvankent', 'Ayyılız 10', 6000, '05386151818', 'ev'),
	(5, 'taylan', 'ilkyaz', 'tr', 'ankara', 'etimesgut', 'elvankent', 'ayyıldız', 6000, '05061208062', 'ev');
/*!40000 ALTER TABLE `fatura_adresi` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.fatura_adresi_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fatura_adresi_delete`(
	IN `a_id` INT
)
BEGIN
	DELETE FROM fatura_adresi WHERE id=a_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.fatura_adresi_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fatura_adresi_insert`(
	IN `ad` VARCHAR(255),
	IN `soyad` VARCHAR(255),
	IN `ülke` VARCHAR(255),
	IN `il` VARCHAR(255),
	IN `ilçe` VARCHAR(255),
	IN `mahalle` VARCHAR(255),
	IN `açık_adres` VARCHAR(255),
	IN `postakodu` INT,
	IN `telefon_numaras` VARCHAR(50),
	IN `adres_tipi` VARCHAR(50)
)
BEGIN
 INSERT INTO fatura_adresi (ad, soyad, ülke, il, ilçe, mahalle, açık_adres, postakodu, telefon_numarası, adres_tipi )
   VALUES (ad, soyad, ülke, il, ilçe, mahalle, açık_adres, postakodu, telefon_numarası, adres_tipi);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.fatura_adresi_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fatura_adresi_update`(
	IN `a_ad` VARCHAR(255),
	IN `a_soyad` VARCHAR(255),
	IN `a_ülke` VARCHAR(255),
	IN `a_il` VARCHAR(255),
	IN `a_ilçe` VARCHAR(255),
	IN `a_mah` VARCHAR(255),
	IN `a_adr` VARCHAR(255),
	IN `a_kod` INT,
	IN `a_num` VARCHAR(50),
	IN `a_tip` VARCHAR(50),
	IN `a_id` INT
)
BEGIN
	UPDATE fatura_adresi SET 
	ad=a_ad, soyad=a_soyad, ülke=a_ülke, il=a_il, ilçe=a_ilçe, mahalle=a_mah, açık_adres=a_adr,
	 postakodu=a_kod, telefon_numarası=a_num, adres_tipi=a_tip 
	WHERE id=a_id;
END//
DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.kargo_adresi: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kargo_adresi` DISABLE KEYS */;
INSERT IGNORE INTO `kargo_adresi` (`id`, `ad`, `soyad`, `ülke`, `il`, `ilçe`, `mahalle`, `açık_adres`, `postakodu`, `telefon_numarası`, `adres_tipi`) VALUES
	(1, 'ayhan', 'yünt', 'tr', 'sivas', 'merkez', 'aydoğan', 'fatih mahallesi', 58040, '05456772303', 'ev'),
	(2, 'ayşe', 'akcan', 'tr', 'ankara', 'çankaya', 'beytepe', 'hacettepe üniversitesi', 6800, '05386151818', 'beytepe'),
	(3, 'ayhan', 'yünt', 'Türkiye', 'ankara', 'çankaya', 'beytepe', 'Hacettepe Teknokent', 6800, '05325698745', 'iş'),
	(4, 'ayşe', 'akcan', 'Türkiye', 'Ankara', 'etimesgut', 'elvankent', 'Ayyılız 10', 6000, '05386151818', 'ev');
/*!40000 ALTER TABLE `kargo_adresi` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.kargo_adresi_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kargo_adresi_delete`(
	IN `a_id` INT
)
BEGIN
	DELETE FROM kargo_adresi WHERE id=a_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kargo_adresi_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kargo_adresi_insert`(
	IN `ad` VARCHAR(255),
	IN `soyad` VARCHAR(255),
	IN `ülke` VARCHAR(255),
	IN `il` VARCHAR(255),
	IN `ilçe` VARCHAR(255),
	IN `mahalle` VARCHAR(255),
	IN `açık_adres` VARCHAR(255),
	IN `postakodu` INT,
	IN `telefon_numarası` VARCHAR(50),
	IN `adres_tipi` VARCHAR(50)

)
BEGIN
 INSERT INTO kargo_adresi (ad, soyad, ülke, il, ilçe, mahalle, açık_adres, postakodu, telefon_numarası, adres_tipi )
   VALUES (ad, soyad, ülke, il, ilçe, mahalle, açık_adres, postakodu, telefon_numarası, adres_tipi);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kargo_adresi_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kargo_adresi_update`(
	IN `a_ad` VARCHAR(255),
	IN `a_soyad` VARCHAR(255),
	IN `a_ülke` VARCHAR(255),
	IN `a_il` VARCHAR(255),
	IN `a_ilçe` VARCHAR(255),
	IN `a_mah` VARCHAR(255),
	IN `a_adr` VARCHAR(255),
	IN `a_kod` INT,
	IN `a_num` VARCHAR(50),
	IN `a_tip` VARCHAR(50),
	IN `a_id` INT
)
BEGIN
	UPDATE kargo_adresi SET 
	ad=a_ad, soyad=a_soyad, ülke=a_ülke, il=a_il, ilçe=a_ilçe, mahalle=a_mah, açık_adres=a_adr,
	 postakodu=a_kod, telefon_numarası=a_num, adres_tipi=a_tip 
	WHERE id=a_id;
END//
DELIMITER ;

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

-- yöntem yapısı dökülüyor milyoncu.kargo_şirketleri_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kargo_şirketleri_delete`(
	IN `k_id` INT
)
BEGIN
	DELETE FROM kargo_şirketleri WHERE id=k_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kargo_şirketleri_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kargo_şirketleri_insert`(
	IN `isim` VARCHAR(50),
	IN `süre` VARCHAR(50),
	IN `fiyat` VARCHAR(50)
)
BEGIN
 INSERT INTO kargo_şirketleri (isim ,süre , fiyat )
   VALUES (isim ,süre , fiyat);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kargo_şirketleri_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kargo_şirketleri_update`(
	IN `name` VARCHAR(50),
	IN `k_time` VARCHAR(50),
	IN `price` VARCHAR(50),
	IN `k_id` INT
)
BEGIN
	UPDATE kargo_şirketleri SET isim=name, süre=k_time, fiyat=price WHERE id=k_id;
END//
DELIMITER ;

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

-- yöntem yapısı dökülüyor milyoncu.kategori_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kategori_delete`(
	IN `k_id` INT
)
BEGIN
	DELETE FROM kategori WHERE id=k_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kategori_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kategori_insert`(
	IN `isim` VARCHAR(50)
)
BEGIN
 INSERT INTO kategori (isim )
   VALUES (isim);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kategori_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kategori_update`(
	IN `name` VARCHAR(50),
	IN `k_id` INT
)
BEGIN
	UPDATE kategori SET isim=name WHERE id=k_id;
END//
DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.kaydedilen_kartlar: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kaydedilen_kartlar` DISABLE KEYS */;
INSERT IGNORE INTO `kaydedilen_kartlar` (`id`, `kullanıcı_id`, `kart_numarası`, `ad_soyad`, `cvc`, `ay`, `yıl`, `ekleme_zamanı`) VALUES
	(10, 6, '1111111111111111', 'ayse akcan', '555', '10', '20', '2017-12-31 01:30:44'),
	(11, 1, '2222222222222222', 'ayhan yunt', '4444', '10', '20', '2017-12-31 04:00:29'),
	(12, 6, '3333333333333333', 'taylan ilkyaz', '999', '12', '30', '2017-12-31 21:50:15');
/*!40000 ALTER TABLE `kaydedilen_kartlar` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.kaydedilen_kartlar_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kaydedilen_kartlar_delete`(
	IN `k_id` INT
)
BEGIN
	DELETE FROM kaydedilen_kartlar WHERE id=k_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kaydedilen_kartlar_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kaydedilen_kartlar_insert`(
	IN `kullanıcı_id` INT,
	IN `kart_numarası` VARCHAR(255),
	IN `ad_soyad` VARCHAR(255),
	IN `cvc` VARCHAR(255),
	IN `ay` VARCHAR(255),
	IN `yıl` VARCHAR(255)
)
BEGIN
 INSERT INTO kaydedilen_kartlar (kullanıcı_id, kart_numarası,ad_soyad,cvc ,ay, yıl)
   VALUES (kullanıcı_id, kart_numarası,ad_soyad,cvc ,ay, yıl);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kaydedilen_kartlar_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kaydedilen_kartlar_update`(
	IN `k_id` INT,
	IN `c_num` VARCHAR(255),
	IN `name` VARCHAR(255),
	IN `c_cvc` VARCHAR(255),
	IN `c_month` VARCHAR(255),
	IN `c_yaer` VARCHAR(255),
	IN `c_id` INT

)
BEGIN
	UPDATE kaydedilen_kartlar SET kullanıcı_id=k_id, kart_numarası=c_num ,ad_soyad=name ,cvc=c_cvc ,ay=c_month , yıl=c_yaer
	WHERE id=c_id;
END//
DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.kullanıcılar: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `kullanıcılar` DISABLE KEYS */;
INSERT IGNORE INTO `kullanıcılar` (`id`, `e_mail`, `tc`, `şifre`, `ad`, `soyad`, `ekleme_zamanı`, `telefon_numarası`, `aktif`, `admin`) VALUES
	(1, 'ayhanyunt@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ayhan', 'yünt', '2017-08-06 20:42:45', '05456772303', 1, 0),
	(2, 'milyoncu@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'Milyoner', 'Milyoncu', '2017-08-07 12:37:46', '', 1, 1),
	(6, 'ayseakcan1907@gmail.com', '12565605338', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ayşe', 'akcan', '2017-12-29 03:20:58', '05386151818', 1, 0),
	(7, 'taylanozgurilkyaz@gmail.com', '37678123816', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'taylan', 'ilkyaz', '2017-12-31 21:56:38', '05061208062', 1, 0);
/*!40000 ALTER TABLE `kullanıcılar` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.kullanıcılar_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kullanıcılar_delete`(
	IN `k_id` INT
)
BEGIN
	DELETE FROM kullanıcılar WHERE id=k_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kullanıcılar_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kullanıcılar_insert`(
	IN `e_mail` VARCHAR(254),
	IN `şifre` VARCHAR(255),
	IN ` ad` VARCHAR(100),
	IN `soyad` VARCHAR(60),
	IN `tc` VARCHAR(30),
	IN `telefon_numarası` VARCHAR(50)
)
BEGIN
 INSERT INTO kullanıcılar ( e_mail ,şifre , ad, soyad, tc, telefon_numarası)
   VALUES ( e_mail ,şifre , ad, soyad, tc, telefon_numarası);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kullanıcılar_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kullanıcılar_update`(
	IN `k_mail` VARCHAR(254),
	IN `k_pass` VARCHAR(255),
	IN `k_name` VARCHAR(100),
	IN `k_surname` VARCHAR(60),
	IN `k_tc` VARCHAR(30),
	IN `k_tel` VARCHAR(50),
	IN `k_id` INT
)
BEGIN
	UPDATE kullanıcılar SET 
	e_mail=k_mail ,şifre=k_pass , ad=k_name, soyad=k_surname, tc=k_tc, telefon_numarası=k_tel
	 WHERE id=k_id;
END//
DELIMITER ;

-- tablo yapısı dökülüyor milyoncu.satın_alınanlar
CREATE TABLE IF NOT EXISTS `satın_alınanlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanıcı_id` int(11) NOT NULL DEFAULT '0',
  `ürün_id` int(11) NOT NULL,
  `sipariş_kodu` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.satın_alınanlar: ~13 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `satın_alınanlar` DISABLE KEYS */;
INSERT IGNORE INTO `satın_alınanlar` (`id`, `kullanıcı_id`, `ürün_id`, `sipariş_kodu`) VALUES
	(29, 7, 10, 'B1000001'),
	(30, 7, 10, 'B1000001'),
	(31, 7, 10, 'B1000001'),
	(32, 7, 10, 'B1000001'),
	(33, 7, 10, 'B1000001'),
	(34, 7, 10, 'B1000001'),
	(35, 7, 10, 'B1000001'),
	(36, 7, 10, 'B1000001'),
	(37, 7, 10, 'B1000001'),
	(38, 7, 10, 'B1000001'),
	(39, 6, 16, 'B1000002'),
	(40, 6, 15, 'B1000002'),
	(41, 6, 14, 'B1000002');
/*!40000 ALTER TABLE `satın_alınanlar` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.satın_alınanlar_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `satın_alınanlar_delete`(
	IN `s_id` INT
)
BEGIN
	DELETE FROM satın_alınanlar WHERE id=s_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.satın_alınanlar_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `satın_alınanlar_insert`(
	IN `ürün_id` INT,
	IN `kullanıcı_id` INT,
	IN `sipariş_kodu` VARCHAR(50)
)
BEGIN
 INSERT INTO satın_alınanlar (ürün_id, kullanıcı_id, sipariş_kodu )
   VALUES (ürün_id, kullanıcı_id , sipariş_kodu);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.satın_alınanlar_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `satın_alınanlar_update`(
	IN `u_id` INT,
	IN `k_id` INT,
	IN `o_code` VARCHAR(50),
	IN `s_id` INT
)
BEGIN
	UPDATE satın_alınanlar SET ürün_id=u_id ,kullanıcı_id=k_id , sipariş_kodu=o_code WHERE id=s_id;
END//
DELIMITER ;

-- tablo yapısı dökülüyor milyoncu.sepet
CREATE TABLE IF NOT EXISTS `sepet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ürün_id` int(11) NOT NULL,
  `kullanıcı_id` int(11) NOT NULL,
  `işlem_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`kullanıcı_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.sepet: ~29 rows (yaklaşık) tablosu için veriler indiriliyor
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
	(40, 7, 3, '2017-12-30 19:43:27');
/*!40000 ALTER TABLE `sepet` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.sepet_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sepet_delete`(
	IN `s_id` INT
)
BEGIN
	DELETE FROM sepet WHERE id=s_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.sepet_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sepet_insert`(
	IN `kullanıcı_id` INT,
	IN `ürün_id` INT

)
BEGIN
 INSERT INTO sepet (ürün_id, kullanıcı_id )
   VALUES (ürün_id, kullanıcı_id );
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.sepet_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sepet_update`(
	IN `u_id` INT,
	IN `k_id` INT,
	IN `s_id` INT
)
BEGIN
	UPDATE sepet SET ürün_id=u_id ,kullanıcı_id=k_id WHERE id=s_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.siparis_iliski_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `siparis_iliski_delete`(
	IN `o_code` VARCHAR(50)
)
BEGIN
	DELETE FROM sipariş_ilişkileri WHERE sipariş_kodu=o_code;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.siparis_iliski_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `siparis_iliski_insert`(
	IN `sipariş_kodu` VARCHAR(50),
	IN `kullanıcı_id` INT,
	IN `fatura_adres_id` INT,
	IN `kargo_adres_id` INT,
	IN `kargo_sirketi` INT
)
BEGIN
 INSERT INTO sipariş_ilişkileri ( sipariş_kodu ,kullanıcı_id , fatura_adres_id, kargo_adres_id, kargo_sirketi)
   VALUES (sipariş_kodu ,kullanıcı_id , fatura_adres_id, kargo_adres_id, kargo_sirketi);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.siparis_iliski_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `siparis_iliski_update`(
	IN `o_status` INT,
	IN `c_num` VARCHAR(50),
	IN `o_code` VARCHAR(50)
)
BEGIN
	UPDATE sipariş_ilişkileri SET sipariş_durumu=o_status ,kargo_numarası=c_num WHERE sipariş_kodu=o_code;
END//
DELIMITER ;

-- tablo yapısı dökülüyor milyoncu.sipariş_durumu
CREATE TABLE IF NOT EXISTS `sipariş_durumu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sipariş_kodu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `durum` int(11) NOT NULL,
  `ekleme_zamanı` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.sipariş_durumu: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sipariş_durumu` DISABLE KEYS */;
INSERT IGNORE INTO `sipariş_durumu` (`id`, `sipariş_kodu`, `durum`, `ekleme_zamanı`) VALUES
	(49, 'B1000001', 1, '2017-12-31 22:00:36'),
	(50, 'B1000002', 1, '2018-01-01 03:18:31'),
	(51, 'B1000001', 2, '2018-01-01 03:18:34');
/*!40000 ALTER TABLE `sipariş_durumu` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.sipariş_durumu_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sipariş_durumu_delete`(
	IN `o_code` VARCHAR(50)
)
BEGIN
	DELETE FROM sipariş_durumu WHERE sipariş_kodu=o_code;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.sipariş_durumu_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sipariş_durumu_insert`(
	IN `sipariş_kodu` VARCHAR(50),
	IN `durum` INT
)
BEGIN
 INSERT INTO sipariş_durumu ( sipariş_kodu ,durum)
   VALUES ( sipariş_kodu ,durum);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.sipariş_durumu_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sipariş_durumu_update`(
	IN `o_status` INT,
	IN `o_code` VARCHAR(50)
)
BEGIN
	UPDATE sipariş_durumu SET durum=o_status WHERE sipariş_kodu=o_code;
END//
DELIMITER ;

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
  `kargo_sirketi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.sipariş_ilişkileri: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sipariş_ilişkileri` DISABLE KEYS */;
INSERT IGNORE INTO `sipariş_ilişkileri` (`id`, `sipariş_kodu`, `ekleme_zamanı`, `güncelleme_zamanı`, `sipariş_durumu`, `kullanıcı_id`, `kargo_adres_id`, `fatura_adres_id`, `kargo_numarası`, `kargo_sirketi`) VALUES
	(17, 'B1000001', '2017-12-31 21:59:52', '2018-01-01 03:18:40', 2, 7, 5, 5, 'S8596526341', 1),
	(18, 'B1000002', '2017-12-31 22:09:58', '2018-01-01 03:18:31', 1, 6, 2, 4, NULL, 4);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.sorular: ~11 rows (yaklaşık) tablosu için veriler indiriliyor
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
	(12, 6, 'Kart kaydetmek ', 'Kart kaydetmek güvenli midir?', -1, 1, 1, '2017-12-31 00:19:19'),
	(13, 2, '', 'evet', 12, 0, 1, '2017-12-31 01:53:12'),
	(14, 1, 'Deneme ', 'Prosedür çalışacak mı?', -1, 1, 1, '2018-01-02 16:07:15');
/*!40000 ALTER TABLE `sorular` ENABLE KEYS */;

-- yöntem yapısı dökülüyor milyoncu.sorular_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sorular_delete`(
	IN `s_id` INT
)
BEGIN
	DELETE FROM sorular WHERE id=s_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.sorular_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sorular_insert`(
	IN `kullanıcı_id` INT,
	IN `başlık` TINYTEXT,
	IN `açıklama` TEXT,
	IN `ana_soru_id` INT,
	IN `ana_soru` TINYINT,
	IN `aktif` TINYINT
)
BEGIN
 INSERT INTO sorular ( kullanıcı_id ,başlık , açıklama,ana_soru_id, ana_soru, aktif)
   VALUES (kullanıcı_id ,başlık , açıklama,ana_soru_id, ana_soru, aktif);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.sorular_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sorular_update`(
	IN `header` TINYTEXT,
	IN `contain` TEXT,
	IN `active` INT,
	IN `s_id` INT
)
BEGIN
	UPDATE sorular SET başlık=header ,açıklama=contain ,aktif=active  WHERE id=s_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.urun_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `urun_delete`(
	IN `u_id` INT
)
BEGIN
	DELETE FROM ürün WHERE id=u_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.urun_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `urun_insert`(
	IN `isim` VARCHAR(255),
	IN `fiyat` FLOAT,
	IN `kısa_açıklama` VARCHAR(255),
	IN `resim_yeri` VARCHAR(255),
	IN `alt_kategori_id` INT,
	IN `kategori_id` INT,
	IN `uzun_açıklama` TEXT
)
BEGIN
 INSERT INTO ürün ( isim ,fiyat , kısa_açıklama,resim_yeri, alt_kategori_id, kategori_id, uzun_açıklama)
   VALUES (isim ,fiyat , kısa_açıklama,resim_yeri, alt_kategori_id, kategori_id, uzun_açıklama);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.urun_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `urun_update`(
	IN `name` VARCHAR(255),
	IN `price` FLOAT,
	IN `short` VARCHAR(255),
	IN `path` VARCHAR(255),
	IN `long_d` TEXT,
	IN `u_id` INT
)
BEGIN
	UPDATE ürün SET isim=name ,fiyat=price , kısa_açıklama=short ,resim_yeri=path ,uzun_açıklama=long_d WHERE id=u_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.yorumlar_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `yorumlar_delete`(
	IN `u_id` INT
)
BEGIN
	DELETE FROM ürün_yorumları WHERE id=u_id;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.yorumlar_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `yorumlar_insert`(
	IN `ürün_id` INT,
	IN `kullanıcı_id` INT,
	IN `başlık` VARCHAR(255),
	IN `içerik` VARCHAR(255),
	IN `puan` INT
)
BEGIN
 INSERT INTO ürün_yorumları ( ürün_id ,kullanıcı_id , başlık,içerik, puan)
   VALUES (ürün_id ,kullanıcı_id , başlık, içerik, puan);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.yorumlar_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `yorumlar_update`(
	IN `header` VARCHAR(255),
	IN `contain` VARCHAR(255),
	IN `star` INT,
	IN `y_id` INT
)
BEGIN
	UPDATE ürün_yorumları SET başlık=header ,içerik=contain ,puan=star  WHERE id=y_id;
END//
DELIMITER ;

-- tablo yapısı dökülüyor milyoncu.ürün
CREATE TABLE IF NOT EXISTS `ürün` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(255) NOT NULL,
  `fiyat` float NOT NULL,
  `kısa_açıklama` varchar(255) NOT NULL,
  `resim_yeri` varchar(255) NOT NULL,
  `alt_kategori_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `uzun_açıklama` mediumtext,
  PRIMARY KEY (`id`),
  KEY `name` (`isim`(191))
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf16;

-- milyoncu.ürün: ~32 rows (yaklaşık) tablosu için veriler indiriliyor
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
	(43, 'Hediyelik Metal Kalemlik', 9, 'Güzel disaynı ile etkileyici ve kullanışlı , insan kalemlik modeli .', 'metal-adam-kalemlik.JPG', 19, 9, 'Güzel disaynı ile etkileyici ve kullanışlı , insan kalemlik modeli .'),
	(45, 'Dilek Balonu', 5, 'Her renk ürün olup, tüm dileklerinizin iletilmesi için hep sizinleyiz.', 'dilek-balonu2.jpg', 19, 9, 'Her renk ürün olup, tüm dileklerinizin iletilmesi için hep sizinleyiz.'),
	(46, 'Çelik Çamaşır İpi', 2, 'Her türlü bağlama işinizde hep yanınızda arayacağınız bir üründür. 100 farklı sağlık testinden geçmiştir.', 'celik-camasir-ipi-10-metre2.JPG', 20, 6, 'Her türlü bağlama işinizde hep yanınızda arayacağınız bir üründür. 100 farklı sağlık testinden geçmiştir.'),
	(47, 'Bor Cam', 9, '300 dereceye kadar dayanıklı olan bu cam tabak, her türlü fırında sizi zorda bırakmayacaktır.', 'borcam-cesitleri2.jpg', 1, 1, '300 dereceye kadar dayanıklı olan bu cam tabak, her türlü fırında sizi zorda bırakmayacaktır.'),
	(48, 'Oyuncak Kova', 7, 'Çocuğunuza sorumluluk mu kazandırmak istiyorsunuz, tam ona uygun boylarda bu temizlik kovası ile ona yeni beceriler kazandırın.', 'temizlik-kovasi-maya2.JPG', 15, 7, 'Çocuğunuza sorumluluk mu kazandırmak istiyorsunuz, tam ona uygun boylarda bu temizlik kovası ile ona yeni beceriler kazandırın.'),
	(49, 'Faber Castel Kursun Kalem', 1, 'Sınavınızda başarının tek adresi bu kalemdir. kırılmayan ucu ile sizi strese sokmayacaktır.', 'kursunkalem.jpg', 4, 2, 'Sınavınızda başarının tek adresi bu kalemdir. kırılmayan ucu ile sizi strese sokmayacaktır.');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- milyoncu.ürün_yorumları: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `ürün_yorumları` DISABLE KEYS */;
INSERT IGNORE INTO `ürün_yorumları` (`id`, `ürün_id`, `kullanıcı_id`, `başlık`, `içerik`, `ekleme_zamanı`, `puan`) VALUES
	(9, 1, 1, 'ayhan5', 'ayhan', '2017-09-13 17:13:06', 4),
	(10, 1, 1, 'ayhan6', 'ayhan', '2017-09-13 17:14:20', 4),
	(11, 2, 1, '', 'güzel ürün faydalı', '2017-12-30 02:31:40', 3),
	(12, 10, 6, '', 'tam istediğim gibi bir defter :)', '2017-12-31 00:18:10', 5),
	(13, 8, 1, '', 'Ben çok kullanışlı buldum. teşekkürler', '2018-01-02 15:55:17', 4);
/*!40000 ALTER TABLE `ürün_yorumları` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
