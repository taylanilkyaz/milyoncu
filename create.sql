
-- milyoncu için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `milyoncu`;
USE `milyoncu`;

-- tablo yapısı dökülüyor milyoncu.adres_kullanıcı_relation
CREATE TABLE IF NOT EXISTS `adres_kullanıcı_relation` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `kullanıcı_id` int(11) NOT NULL,
  `fatura_adresi_id` int(11) DEFAULT NULL,
  `kargo_adresi_id` int(11) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
	IN `isim` VARCHAR(50) CHARSET utf8
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
	IN `name` VARCHAR(50) CHARSET utf8
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
	IN `ad` VARCHAR(255) CHARSET utf8,
	IN `soyad` VARCHAR(255) CHARSET utf8,
	IN `ülke` VARCHAR(255) CHARSET utf8,
	IN `il` VARCHAR(255) CHARSET utf8,
	IN `ilçe` VARCHAR(255) CHARSET utf8,
	IN `mahalle` VARCHAR(255) CHARSET utf8,
	IN `açık_adres` VARCHAR(255) CHARSET utf8,
	IN `postakodu` INT,
	IN `telefon_numaras` VARCHAR(50) CHARSET utf8,
	IN `adres_tipi` VARCHAR(50) CHARSET utf8
)
BEGIN
 INSERT INTO fatura_adresi (ad, soyad, ülke, il, ilçe, mahalle, açık_adres, postakodu, telefon_numarası, adres_tipi )
   VALUES (ad, soyad, ülke, il, ilçe, mahalle, açık_adres, postakodu, telefon_numarası, adres_tipi);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.fatura_adresi_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fatura_adresi_update`(
	IN `a_ad` VARCHAR(255) CHARSET utf8,
	IN `a_soyad` VARCHAR(255) CHARSET utf8,
	IN `a_ülke` VARCHAR(255) CHARSET utf8,
	IN `a_il` VARCHAR(255) CHARSET utf8,
	IN `a_ilçe` VARCHAR(255) CHARSET utf8,
	IN `a_mah` VARCHAR(255) CHARSET utf8,
	IN `a_adr` VARCHAR(255) CHARSET utf8,
	IN `a_kod` INT,
	IN `a_num` VARCHAR(50) CHARSET utf8,
	IN `a_tip` VARCHAR(50) CHARSET utf8,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
	IN `ad` VARCHAR(255) CHARSET utf8,
	IN `soyad` VARCHAR(255) CHARSET utf8,
	IN `ülke` VARCHAR(255) CHARSET utf8,
	IN `il` VARCHAR(255) CHARSET utf8,
	IN `ilçe` VARCHAR(255) CHARSET utf8,
	IN `mahalle` VARCHAR(255) CHARSET utf8,
	IN `açık_adres` VARCHAR(255) CHARSET utf8,
	IN `postakodu` INT,
	IN `telefon_numarası` VARCHAR(50) CHARSET utf8,
	IN `adres_tipi` VARCHAR(50) CHARSET utf8

)
BEGIN
 INSERT INTO kargo_adresi (ad, soyad, ülke, il, ilçe, mahalle, açık_adres, postakodu, telefon_numarası, adres_tipi )
   VALUES (ad, soyad, ülke, il, ilçe, mahalle, açık_adres, postakodu, telefon_numarası, adres_tipi);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kargo_adresi_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kargo_adresi_update`(
	IN `a_ad` VARCHAR(255) CHARSET utf8,
	IN `a_soyad` VARCHAR(255) CHARSET utf8,
	IN `a_ülke` VARCHAR(255) CHARSET utf8,
	IN `a_il` VARCHAR(255) CHARSET utf8,
	IN `a_ilçe` VARCHAR(255) CHARSET utf8,
	IN `a_mah` VARCHAR(255) CHARSET utf8,
	IN `a_adr` VARCHAR(255) CHARSET utf8,
	IN `a_kod` INT,
	IN `a_num` VARCHAR(50) CHARSET utf8,
	IN `a_tip` VARCHAR(50) CHARSET utf8,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `süre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fiyat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `isim` (`isim`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
	IN `isim` VARCHAR(50) CHARSET utf8,
	IN `süre` VARCHAR(50) CHARSET utf8,
	IN `fiyat` VARCHAR(50) CHARSET utf8
)
BEGIN
 INSERT INTO kargo_şirketleri (isim ,süre , fiyat )
   VALUES (isim ,süre , fiyat);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kargo_şirketleri_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kargo_şirketleri_update`(
	IN `name` VARCHAR(50) CHARSET utf8,
	IN `k_time` VARCHAR(50) CHARSET utf8,
	IN `price` VARCHAR(50) CHARSET utf8,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
	IN `isim` VARCHAR(50) CHARSET utf8
)
BEGIN
 INSERT INTO kategori (isim )
   VALUES (isim);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kategori_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kategori_update`(
	IN `name` VARCHAR(50) CHARSET utf8,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
	IN `kart_numarası` VARCHAR(255) CHARSET utf8,
	IN `ad_soyad` VARCHAR(255) CHARSET utf8,
	IN `cvc` VARCHAR(255) CHARSET utf8,
	IN `ay` VARCHAR(255) CHARSET utf8,
	IN `yıl` VARCHAR(255) CHARSET utf8
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
	IN `c_num` VARCHAR(255) CHARSET utf8,
	IN `name` VARCHAR(255) CHARSET utf8,
	IN `c_cvc` VARCHAR(255) CHARSET utf8,
	IN `c_month` VARCHAR(255) CHARSET utf8,
	IN `c_yaer` VARCHAR(255) CHARSET utf8,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
	IN `e_mail` VARCHAR(254) CHARSET utf8,
	IN `şifre` VARCHAR(255) CHARSET utf8,
	IN `ad`  VARCHAR(100) CHARSET utf8,
	IN `soyad` VARCHAR(60) CHARSET utf8,
	IN `tc` VARCHAR(30) CHARSET utf8,
	IN `telefon_numarası` VARCHAR(50) CHARSET utf8
,
	IN `admin` INT,
	IN `aktif` INT
)
BEGIN
 INSERT INTO kullanıcılar ( e_mail ,şifre , ad, soyad, tc, telefon_numarası, aktif, admin)
   VALUES ( e_mail ,şifre , ad, soyad, tc, telefon_numarası,  aktif, admin);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.kullanıcılar_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `kullanıcılar_update`(
	IN `k_mail` VARCHAR(254) CHARSET utf8,
	IN `k_pass` VARCHAR(255) CHARSET utf8,
	IN `k_name` VARCHAR(100) CHARSET utf8,
	IN `k_surname` VARCHAR(60) CHARSET utf8,
	IN `k_tc` VARCHAR(30) CHARSET utf8,
	IN `k_tel` VARCHAR(50) CHARSET utf8,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
	IN `sipariş_kodu` VARCHAR(50) CHARSET utf8
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
	IN `o_code` VARCHAR(50) CHARSET utf8,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
	IN `sipariş_kodu` VARCHAR(50) CHARSET utf8,
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
	IN `c_num` VARCHAR(50) CHARSET utf8,
	IN `o_code` VARCHAR(50) CHARSET utf8
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- yöntem yapısı dökülüyor milyoncu.sipariş_durumu_delete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sipariş_durumu_delete`(
	IN `o_code` VARCHAR(50) CHARSET utf8
)
BEGIN
	DELETE FROM sipariş_durumu WHERE sipariş_kodu=o_code;
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.sipariş_durumu_insert
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sipariş_durumu_insert`(
	IN `sipariş_kodu` VARCHAR(50) CHARSET utf8,
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
	IN `o_code` VARCHAR(50) CHARSET utf8
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
	IN `başlık` TINYTEXT CHARSET utf8,
	IN `açıklama` TEXT CHARSET utf8,
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
	IN `header` TINYTEXT CHARSET utf8,
	IN `contain` TEXT CHARSET utf8,
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
	IN `isim` VARCHAR(255) CHARSET utf8,
	IN `fiyat` FLOAT,
	IN `kısa_açıklama` VARCHAR(255) CHARSET utf8,
	IN `resim_yeri` VARCHAR(255) CHARSET utf8,
	IN `alt_kategori_id` INT,
	IN `kategori_id` INT,
	IN `uzun_açıklama` TEXT CHARSET utf8
)
BEGIN
 INSERT INTO ürün ( isim ,fiyat , kısa_açıklama,resim_yeri, alt_kategori_id, kategori_id, uzun_açıklama)
   VALUES (isim ,fiyat , kısa_açıklama,resim_yeri, alt_kategori_id, kategori_id, uzun_açıklama);
END//
DELIMITER ;

-- yöntem yapısı dökülüyor milyoncu.urun_update
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `urun_update`(
	IN `name` VARCHAR(255) CHARSET utf8,
	IN `price` FLOAT,
	IN `short` VARCHAR(255) CHARSET utf8,
	IN `path` VARCHAR(255) CHARSET utf8,
	IN `long_d` TEXT CHARSET utf8,
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
	IN `başlık` VARCHAR(255) CHARSET utf8,
	IN `içerik` VARCHAR(255) CHARSET utf8,
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
	IN `header` VARCHAR(255) CHARSET utf8,
	IN `contain` VARCHAR(255) CHARSET utf8,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;