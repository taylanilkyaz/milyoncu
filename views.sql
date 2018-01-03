
-- milyoncu için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `milyoncu` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `milyoncu`;

-- görünüm yapısı dökülüyor milyoncu.avg_price
-- VIEW bağımlılık sorunlarını çözmek için geçici tablolar oluşturuluyor
CREATE TABLE `avg_price` (
	`AVG(fiyat)` DOUBLE NULL
) ENGINE=MyISAM;

-- görünüm yapısı dökülüyor milyoncu.count_product
-- VIEW bağımlılık sorunlarını çözmek için geçici tablolar oluşturuluyor
CREATE TABLE `count_product` (
	`COUNT(*)` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- görünüm yapısı dökülüyor milyoncu.max_three
-- VIEW bağımlılık sorunlarını çözmek için geçici tablolar oluşturuluyor
CREATE TABLE `max_three` (
	`id` INT(11) NOT NULL,
	`isim` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`fiyat` FLOAT NOT NULL,
	`kısa_açıklama` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`resim_yeri` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`alt_kategori_id` INT(11) NULL,
	`kategori_id` INT(11) NULL,
	`uzun_açıklama` MEDIUMTEXT NULL COLLATE 'utf16_general_ci'
) ENGINE=MyISAM;

-- görünüm yapısı dökülüyor milyoncu.min_three
-- VIEW bağımlılık sorunlarını çözmek için geçici tablolar oluşturuluyor
CREATE TABLE `min_three` (
	`id` INT(11) NOT NULL,
	`isim` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`fiyat` FLOAT NOT NULL,
	`kısa_açıklama` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`resim_yeri` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`alt_kategori_id` INT(11) NULL,
	`kategori_id` INT(11) NULL,
	`uzun_açıklama` MEDIUMTEXT NULL COLLATE 'utf16_general_ci'
) ENGINE=MyISAM;

-- görünüm yapısı dökülüyor milyoncu.most_cargo
-- VIEW bağımlılık sorunlarını çözmek için geçici tablolar oluşturuluyor
CREATE TABLE `most_cargo` (
	`isim` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`value` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- görünüm yapısı dökülüyor milyoncu.most_product
-- VIEW bağımlılık sorunlarını çözmek için geçici tablolar oluşturuluyor
CREATE TABLE `most_product` (
	`id` INT(11) NOT NULL,
	`isim` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`fiyat` FLOAT NOT NULL,
	`kısa_açıklama` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`resim_yeri` VARCHAR(255) NOT NULL COLLATE 'utf16_general_ci',
	`alt_kategori_id` INT(11) NULL,
	`kategori_id` INT(11) NULL,
	`uzun_açıklama` MEDIUMTEXT NULL COLLATE 'utf16_general_ci',
	`value` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- görünüm yapısı dökülüyor milyoncu.avg_price
-- Geçici tablolar temizlenerek final VIEW oluşturuluyor
DROP TABLE IF EXISTS `avg_price`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `avg_price` AS SELECT AVG(fiyat)
FROM ürün ;

-- görünüm yapısı dökülüyor milyoncu.count_product
-- Geçici tablolar temizlenerek final VIEW oluşturuluyor
DROP TABLE IF EXISTS `count_product`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `count_product` AS SELECT COUNT(*)
FROM ürün ;

-- görünüm yapısı dökülüyor milyoncu.max_three
-- Geçici tablolar temizlenerek final VIEW oluşturuluyor
DROP TABLE IF EXISTS `max_three`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `max_three` AS SELECT *
     FROM ürün
     ORDER BY fiyat DESC, isim ASC
    LIMIT 0,3 ;

-- görünüm yapısı dökülüyor milyoncu.min_three
-- Geçici tablolar temizlenerek final VIEW oluşturuluyor
DROP TABLE IF EXISTS `min_three`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `min_three` AS SELECT *
     FROM ürün
     ORDER BY fiyat ASC, isim ASC
    LIMIT 0,3 ;

-- görünüm yapısı dökülüyor milyoncu.most_cargo
-- Geçici tablolar temizlenerek final VIEW oluşturuluyor
DROP TABLE IF EXISTS `most_cargo`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `most_cargo` AS SELECT kargo_şirketleri.isim,  COUNT(kargo_şirketleri.isim) AS value
    FROM    sipariş_ilişkileri INNER JOIN kargo_şirketleri ON sipariş_ilişkileri.kargo_sirketi=kargo_şirketleri.id
    GROUP BY kargo_şirketleri.isim
    ORDER BY value DESC
    LIMIT    1 ;

-- görünüm yapısı dökülüyor milyoncu.most_product
-- Geçici tablolar temizlenerek final VIEW oluşturuluyor
DROP TABLE IF EXISTS `most_product`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `most_product` AS SELECT  ürün.*,  COUNT(ürün.isim)  AS value
    FROM    satın_alınanlar INNER JOIN ürün ON satın_alınanlar.ürün_id= ürün.id
    GROUP BY ürün.isim
     ORDER BY value DESC
    LIMIT    1 ;

