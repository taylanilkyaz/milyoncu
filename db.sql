-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                5.7.18-log - MySQL Community Server (GPL)
-- Sunucu İşletim Sistemi:       Win64
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

-- tablo yapısı dökülüyor b4u_dna.activation_codes
CREATE TABLE IF NOT EXISTS `activation_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activation_code` int(11) NOT NULL,
  `send_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.activation_codes: ~7 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `activation_codes` DISABLE KEYS */;
INSERT IGNORE INTO `activation_codes` (`id`, `activation_code`, `send_date_time`, `user_id`) VALUES
	(3, 290704, '2017-09-13 17:31:03', 5),
	(4, 221183, '2017-09-18 17:04:24', 6),
	(5, 397018, '2017-09-18 17:06:59', 7),
	(6, 341519, '2017-09-18 17:29:20', 8),
	(8, 484777, '2017-09-19 16:52:23', 9),
	(9, 890711, '2017-09-19 18:31:45', 6),
	(10, 172349, '2017-09-19 18:32:14', 7),
	(11, 378939, '2017-09-19 18:33:31', 8);
/*!40000 ALTER TABLE `activation_codes` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.address_user_relation
CREATE TABLE IF NOT EXISTS `address_user_relation` (
  `user_id` int(11) NOT NULL,
  `bill_address_id` int(11) DEFAULT NULL,
  `cargo_address_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.address_user_relation: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `address_user_relation` DISABLE KEYS */;
INSERT IGNORE INTO `address_user_relation` (`user_id`, `bill_address_id`, `cargo_address_id`, `is_active`, `id`) VALUES
	(1, NULL, 1, 1, 1),
	(1, 1, NULL, 1, 2);
/*!40000 ALTER TABLE `address_user_relation` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.basket
CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `process_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.basket: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `basket` DISABLE KEYS */;
INSERT IGNORE INTO `basket` (`id`, `product_id`, `user_id`, `process_date`) VALUES
	(2, 2, 1, '2017-09-19 17:12:43'),
	(3, 1, 5, '2017-09-19 19:17:43');
/*!40000 ALTER TABLE `basket` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.bill_address
CREATE TABLE IF NOT EXISTS `bill_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `county` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `billingAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `postcode` int(11) NOT NULL DEFAULT '0',
  `phoneNumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `address_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.bill_address: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `bill_address` DISABLE KEYS */;
INSERT IGNORE INTO `bill_address` (`id`, `firstname`, `lastname`, `country`, `city`, `county`, `district`, `billingAddress`, `postcode`, `phoneNumber`, `address_name`) VALUES
	(1, 'ayhan', 'yünt', 'tr', 'sivas', 'merkez', 'aydoğan', 'fatih mahallesi', 58040, '05456772303', 'ev');
/*!40000 ALTER TABLE `bill_address` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.buyed_products
CREATE TABLE IF NOT EXISTS `buyed_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `order_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.buyed_products: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `buyed_products` DISABLE KEYS */;
INSERT IGNORE INTO `buyed_products` (`id`, `user_id`, `product_id`, `order_code`) VALUES
	(1, 1, 9, 'B1000001'),
	(2, 1, 8, 'B1000001'),
	(3, 1, 1, 'B1000002'),
	(4, 1, 2, 'B1000002'),
	(5, 1, 8, 'B1000002');
/*!40000 ALTER TABLE `buyed_products` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.cargo_address
CREATE TABLE IF NOT EXISTS `cargo_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `county` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `cargoAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `postcode` int(11) NOT NULL DEFAULT '0',
  `phoneNumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `address_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.cargo_address: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `cargo_address` DISABLE KEYS */;
INSERT IGNORE INTO `cargo_address` (`id`, `firstname`, `lastname`, `country`, `city`, `county`, `district`, `cargoAddress`, `postcode`, `phoneNumber`, `address_name`) VALUES
	(1, 'ayhan', 'yünt', 'tr', 'sivas', 'merkez', 'aydoğan', 'fatih mahallesi', 58040, '05456772303', 'ev');
/*!40000 ALTER TABLE `cargo_address` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.categories: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT IGNORE INTO `categories` (`id`, `name`) VALUES
	(1, 'aile'),
	(2, 'hayvan'),
	(3, 'sağlık'),
	(4, 'köken');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.contact: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.exchange_rate
CREATE TABLE IF NOT EXISTS `exchange_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dollar_to_try` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.exchange_rate: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `exchange_rate` DISABLE KEYS */;
INSERT IGNORE INTO `exchange_rate` (`id`, `dollar_to_try`) VALUES
	(1, 3.5341);
/*!40000 ALTER TABLE `exchange_rate` ENABLE KEYS */;

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

-- tablo yapısı dökülüyor b4u_dna.order_buy_relation
CREATE TABLE IF NOT EXISTS `order_buy_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `cargo_address_id` int(11) DEFAULT NULL,
  `bill_address_id` int(11) DEFAULT NULL,
  `cargo_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.order_buy_relation: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `order_buy_relation` DISABLE KEYS */;
INSERT IGNORE INTO `order_buy_relation` (`id`, `order_code`, `add_time`, `update_time`, `order_status`, `user_id`, `cargo_address_id`, `bill_address_id`, `cargo_no`) VALUES
	(1, 'B1000001', '2017-08-17 20:22:45', '2017-08-18 11:23:37', 5, 1, 1, 1, 'S757465'),
	(2, 'B1000002', '2017-08-17 20:23:11', '2017-08-18 11:23:42', 3, 1, 1, 1, 'S457876');
/*!40000 ALTER TABLE `order_buy_relation` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `short_desc` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `expert_active` int(11) DEFAULT '0',
  `long_desc` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- b4u_dna.product: ~35 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT IGNORE INTO `product` (`id`, `name`, `price`, `short_desc`, `image_path`, `sub_category_id`, `category_id`, `expert_active`, `long_desc`) VALUES
	(1, 'Bebek Cinsiyet Testi', 218.68, 'Bebek mi bekliyorsunuz? Kız mı yoksa erkek mi?  Bu test ile gebeliğin 9.haftasından itibaren aklınızdaki tüm soru işaretlerini kaldırıyoruz.', 'bebek-cinsiyet.png', 2, 1, 0, 'Bebek mi bekliyorsunuz? Kız mı yoksa erkek mi?  Bebek cinsiyet testi ile bu soruya cevap almanızısağlıyoruz. Test, gebeliğin 9.haftasından itibaren uygulanabilir olup, son derece bilimsel tahminler sunar. Testimiz, kan örneğinizi kullanarak, akredite edilmiş laboratuvarlarımızdayapılır ve % 98 oranında doğruluk sağlar. '),
	(2, 'Hamilelikte Down Sendromu Testi', 490.42, 'Bebeğinizin Down Sendromlu olarak doğmasından endişe mi ediyorsunuz? Bu test ile gebeliğin 10. Haftasından itibaren sonucu öğrenebilirsiniz.', 'down-sendrom.png', 2, 1, 1, 'Günümüzde, Down Sendromu\'nun erken teşhisi için %100 güvenli, Non-invaziv Prenatal Test (NIPT) adı verdiğimiz bir test mevcuttur.Bu test,gebeliğin 10. haftasından itibaren,anneden alınan kan örnekleri kullanılarak yapılır. Bebeğinizin Down Sendrom\'lu genleri taşıyıp taşımadığını %99 doğrulukla öğrenmeniz mümkün.'),
	(3, 'Küresel Konum Belirleme ile Köken Testi', 231.62, 'Bu test sizi atalarınızın geldiği ülkelere, şehirlere ve hatta adalara kadar götürebilir. Kökenlerinizi keşfetmeye hazır olun.', 'kuresel-konum-belirleme-testi.png', 13, 4, 0, 'Bu test sizi atalarınızın geldiği ülkelere, şehirlere ve hatta adalara kadar götürebilir. Kökenlerinizi keşfetmeye hazır olun. '),
	(4, 'DNA\'ya göre Soy Testi', 166.93, 'Kökenlerinizi keşfetmek ve ailenizin geçmişi hakkında daha fazla şey öğrenmenin yolu bu testle başlar. ', 'dnaya-gore-soy-testi.png', 13, 4, 0, 'Bu biyo-coğrafik soy testi, gerçekleştirilmesi diğer testlere göre oldukça kolay ve yanlışsız bir testtir. Kökenlerinizi keşfetmek ve ailenizin geçmişi hakkında daha fazla şey öğrenmenin yolu bu testle başlar.'),
	(5, 'Atalara İlişkin Köken Testi', 192.8, 'Herkesin aklına bu soru mutlaka gelir: Atalarımız bu topraklara nereden geldiler? Sorunun cevabını zaten biliyorum diyorsanız o kadar emin olmayın ve soyunuzu çözmeye bu test başlayın.', 'atalara-iliskin-koken-testi.png', 13, 4, 0, 'Herkesin aklına bu soru mutlaka gelir: Atalarımız bu topraklara nereden geldiler? Sorunun cevabını zaten biliyorum diyorsanız o kadar emin olmayın deriz. Soyunuzu çözmeye bu test başlayın. Testimiz, soy bilginizi benzersiz bir bakış açısıyla resmeder ve grafiklerle gösteri. Numuneler alındıktan sonraki 2 hafta içinde sonuçlarınız hazır! '),
	(6, 'Çölyak Hastalığı Genetik Testi', 148.81, 'Bu test Çölyak hastalığına genetik yatkınlığınız olup olmadığını sizlere en doğru şekilde söylüyor. Erken teşhis için hemen testimizi sipariş edin.', 'colyak-hastaligi-testi.png', 12, 3, 0, 'Çölyak hastalığı genetik testi, çölyak hastalığına genetik yatkınlığınız olup olmadığını sizlere en doğru şekilde söylüyor. Erken teşhis için hemen testimizi sipariş edin.'),
	(7, 'Kanser Yatkınlığı İçin Yeni Nesil Kanser Panelleri', 0, 'Her kanser kalıtsal değildir fakat bazıları ise kalıtsaldır. Belirli bir kanser türüne ait gen taşıyıp taşımadığınızı öğrenmek istemez miydiniz?', 'kanser-yatkinligi-testi.png', 12, 3, 0, 'Her kanser kalıtsal değildir fakat bazıları ise kalıtsaldır. Belirli bir kanser türüne ait gen taşıyıp taşımadığınızı öğrenmek istemez miydiniz ?'),
	(8, 'Sperm Belirleme Testi', 116.46, 'Kafanızdaki soru işaretlerine bir son vermenin zamanı gelmedi mi? ', 'sperm-belirleme-testi.png', 6, 1, 0, 'Eşiniz ya da sevgilinizin sizi aldattığını mı düşünüyorsunuz? Sperm olduğundan şüphelendiğiniz lekeler mi buldunuz? Testimizi kullanın.'),
	(9, 'Sadakatsizlik DNA Testi', 386.93, 'Kafanızdaki soru işaretlerine bir son vermenin zamanı gelmedi mi? Şüphelerinizden testimiz sayesinde kurtulabilirsiniz. Şüphelerinizden testimiz sayesinde kurtulabilirsiniz.', 'sadakat-dna.png', 6, 1, 0, 'Kafanızdaki soru işaretlerine bir son vermenin zamanı gelmedi mi? Şüphelerinizden testimiz sayesinde kurtulabilirsiniz. '),
	(10, 'Afetzede Kimliği Belirleme Testi', 0, 'DNA profillemesi, afetzedenin kimliklerini tanımlamada bir numaralı araçtır. Afetzedelerin kimliklerinin tanınmasında yardımcı olan bu testi sizlere sunuyoruz.', 'afetzede-kimligi-belirleme-testi.png', 12, 3, 0, 'DNA profillemesi ,afetzedenin kimliklerini tanımlamada bir numaralıaraçtır. Afetzedelerin kimliklerinin tanınmasında yardımcı olan kadavradan doku çıkarma (ekstraksiyon) aletini sizlere sunuyoruz.'),
	(11, 'Sağlık ve Yaşam Tarzı DNA Testi', 128.11, 'Genetiğiniz sağlık ve refahınızı tamamen değiştirebilir. Yaşam tarzınızı değiştirmek ve sağlığınızı bir üst seviyeye çıkarmak istiyorsanız bu test tam size göre.', 'saglik-yasam-tarzi-dna-testi.png', 11, 3, 0, 'Genetiğiniz sağlık ve refahınızı tamamen değiştirebilir.Sağlık ve Yaşam Tarzı DNA Testi bunu sizin yapıyor. Yaşam tarzınızıdeğiştirmek,sağlığınızı bir üst seviyeye çıkarmak için  testimizi sipariş edin. '),
	(12, 'Diyet ve Beslenme DNA Testi', 153.98, 'Diyet yapmaktan ve hiçbir şekilde sonuç alamamaktan bıktınız mı? Genetik ve beslenme artık el ele! Bu test size bu konuda yardımcı olacak. ', 'diyet-ve-beslenme-dna-testi.png', 11, 3, 0, 'Diyet yapmaktan ve hiçbir şekilde sonuç alamamaktan bıktınız mı? Diyet ve Beslenme DNA Testi size bu konuda yardımcı olacak. Genetik ve beslenme el ele! Kilo vermek konusunda yaşadığınız sorunları geride bırakın.'),
	(13, 'Cilt Bakımı DNA Testi', 257.5, 'Unutmayın, herkesin cildi aynı değildir! Testimiz, benzersiz genetik yapınıza bakarak cildinizin yaşlanma sürecinin daha iyi kontrol edilmesini sağlar.', 'cilt-bakim-testi.png', 11, 3, 0, 'Unutmayın, herkesin cildi aynıdeğildir! Testimiz, cildinizin koruyucu tedavisinde ve cildinizin bakımında en mükemmel nokta olup, benzersiz genetik yapınıza bakarak yaşlanma sürecinin daha iyi kontrol edilmesini sağlar. Sizlere sunduğumuz bu test, en yeni ve yenilikçi DNA testidir ve cildinizin tedavisi ve bakımının temelini oluşturur. '),
	(14, 'DNA ile Köpek Cinsi Belirleme Testi', 63.41, 'Karma cins bir köpeğe sahipseniz bu test kesinlikle size göre. İnsanlar size köpeğinizin cinsini sorduğunda artık zorluk çekmeyeceksiniz.', 'dna-ile-kopek-cinsiyet-belirleme-testi.png', 8, 2, 0, 'Karma cins bir köpeğe sahipseniz bu test kesinlikle size göre. İnsanlar size köpeğinizin cinsini sorduğunda artık zorluk çekmeyeceksiniz '),
	(15, 'Köpek Irkı Kimlik Saptama Testi', 84.11, 'Köpeğiniz melez mi yoksa safkan mı? Sahibi olduğunuz köpeğin cinsini henüz bilmiyor ve öğrenmek istiyorsanız testimiz tam da ihtiyacınız olan şey.', 'kopek-irki-belirleme-testi.png', 8, 2, 0, 'Köpeğiniz melez mi yoksa safkan mı? Sahibi olduğunuz köpeğin cinsini henüz bilmiyor ve öğrenmek istiyorsanız testimiz tam da ihtiyacınız olan şey. '),
	(16, 'Anne Olmadan Köpek DNA Testi', 257.5, 'Annenin numunesi olmadan bile köpeğinize ebeveyn testi yapabiliyoruz. Sonuçlarınız 10 iş günü içerisinde hazır.', 'anne-olmadan-kopek-dna-testi.png', 8, 2, 0, 'Annenin numunesi olmadan bile köpeğinize ebevyn testi yapabiliyoruz. Sonuçlarınız 10 iş günü içerisinde hazır.'),
	(17, 'Köpek Ebeveyn Testi', 166.92, 'Patili dostunuzun gerçek ebeveynlerini kesin bir şekilde bulmak istemez miydiniz? Bu test sayesinde, köpeğinizin gerçek soyağacına bilimsel yollarla ulaşabilirsiniz.', 'köpek-ebevyn-testi.png', 8, 2, 0, 'Patili dostunuzun gerçek ebeveynlerini kesin bir şekilde bulmak istemez miydiniz?Bu test sayesinde, köpek yetiştiricileri ve köpek sahipleri,% 99,9 doğrulukla köpeğin gerçek soyağacına bilimsel yollarla ulaşabilecekler.'),
	(18, 'Kalıtsal Köpek Hastalıkları ve Özellikleri Testi', 63.41, 'Sevgili köpeğinizin herhangi bir kalıtsal hastalığı olduğundan endişe ediyor olabilirsiniz. Sorularınızın cevabı için testimizi sipariş edebilirsiniz.', 'kalitsal-kopek-hastaliklari-testi.png', 8, 2, 0, 'Sevgili köpeğinizin herhangi bir kalıtsal hastalığı olduğundan endişe ediyor olabilirsiniz. Daha önce bundan etkilenmemiş olabilir fakat bundan sonrasında da böyle mi olacak? Sorularınızın cevabı için testimizi sipariş edebilirsiniz.'),
	(19, 'Kuş Cinsiyet Belirleme Testi', 122.93, 'Kuşların cinsiyetlerini belirlemek oldukça zor. Testimiz sayesinde,%100 doğrulukla kuşlarınızın cinsiyetini öğrenebilmenizi sağlıyoruz.', 'kus-cinsiyet-testi.png', 9, 2, 0, 'Kuşların cinsiyetlerini belirlemek oldukça zor. Testimiz sayesinde,%100 doğrulukla kuşlarınızın cinsiyetini öğrenebilmenizi sağlıyoruz. '),
	(20, 'Kedigiller Polikistik Böbrek Hastalığı DNA Testi', 50.46, 'Kedilerinizin sağlığının sizler için ne kadar önemli olduğunu biliyoruz. Onların ömrünü uzatmayı ve daha sağlıklı bir yaşam sürmelerini amaçlıyoruz.', 'kedigiller-polistik-bobrek-hastaligi-testi.png', 7, 2, 0, 'Kedilerinizin sağlığının sizler için ne kadar önemli olduğunu biliyoruz. Onların ömrünü uzatmayı amaçlıyor,daha sağlıklı bir yaşam sürmelerini sağlıyoruz. '),
	(21, 'At DNA Testi', 0, 'Testimiz sayesinde at sahiplerinin ve at yetiştiricilerinin, atların sağlıklı yaşam seviyelerini en üst seviyeye çıkarmaları amaçlanmıştır. ', 'at-dna-testi.png', 10, 2, 0, 'Testimiz sayesinde at yetiştiricilerinin, atların sağlıklıyaşam seviyelerini en üst seviyeye çıkarmaları amaçlanmıştır. Herhangi bir sağlık sorununa yatkınları olup olmadığını testimiz sayesinde öğrenebilirsiniz. '),
	(22, 'DNA Babalık Testi', 128.11, '', 'dna-babalık-testi.png', 1, 1, 1, ' '),
	(23, 'Hamilelikte Babalık Testi', 1163.48, '', 'hamilelikte-babalik.png', 2, 1, 0, ' '),
	(24, 'Kardeşlik DNA Testi', 257.46, '', 'kardeşlik-dna-testi.png', 3, 1, 1, ' '),
	(25, 'Hala-Amca DNA Testi', 257.46, '', 'hala-amca-testi.png', 5, 1, 0, ' '),
	(26, 'Büyükanne - Büyükbaba DNA Testi', 322.25, '', 'büyükanne-büyükbaba-dna-testi.png', 4, 1, 0, ' '),
	(27, 'İkizlik DNA Testi', 179.83, '', 'ikizlik-dna-testi.png', 3, 1, 0, ' '),
	(28, 'Mitokondriyal DNA Testi', 386.93, '', 'mitokondriyal-dna-testi.png', 4, 1, 0, ' '),
	(29, 'Y Kromozom Testi', 257.46, '', 'x-kromozom-testi.png', 3, 1, 0, ' '),
	(30, 'X Kromozom Testi', 425.66, '', 'x-kromozom-testi.png', 3, 1, 0, ' '),
	(31, 'Annelik Testi', 128.11, '', 'annelik-testi.png', 2, 1, 1, ' '),
	(32, 'Genetik Yapılandırma Testi', 386.93, '', 'genetic-yapilandirma-testi.png', 13, 4, 0, ' '),
	(33, 'Anne Soy Testi', 205.71, '', 'anne-soy-testi.png', 2, 1, 0, ' '),
	(34, 'Baba Soy Testi', 179.83, '', 'baba-soy-testi.png', 1, 1, 0, ' '),
	(35, 'Köpek Dışkısıyla DNA Testi', 0, 'Sorumsuz köpek sahiplerinden bıktınız mı? Testimiz, köpeklerinin kakalarını halka açık yerlerden temizlemeyen köpek sahiplerini tespit etmenizi sağlıyor.', 'kopek-diskisi-ile-dna-testi.png', 8, 2, 0, 'Sorumsuz köpek sahiplerinden bıktınız mı? Testimiz,köpeklerinin kakalarınıhalka açık yerlerden temizlemeyen köpek sahiplerini tespit etmenizi sağlıyor. ');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.product_comments
CREATE TABLE IF NOT EXISTS `product_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `rate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.product_comments: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `product_comments` DISABLE KEYS */;
INSERT IGNORE INTO `product_comments` (`id`, `product_id`, `user_id`, `title`, `content`, `add_time`, `rate`) VALUES
	(3, 8, 1, 'rewqq', 'qwerwq', '2017-09-13 14:31:09', 4),
	(9, 1, 1, 'ayhan5', 'ayhan', '2017-09-13 17:13:06', 4),
	(10, 1, 1, 'ayhan6', 'ayhan', '2017-09-13 17:14:20', 4);
/*!40000 ALTER TABLE `product_comments` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.status_update_time
CREATE TABLE IF NOT EXISTS `status_update_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_status` int(11) NOT NULL,
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.status_update_time: ~8 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `status_update_time` DISABLE KEYS */;
INSERT IGNORE INTO `status_update_time` (`id`, `order_code`, `order_status`, `add_time`) VALUES
	(1, 'B1000001', 1, '2017-08-17 21:57:10'),
	(2, 'B1000002', 1, '2017-08-17 21:57:17'),
	(3, 'B1000001', 2, '2017-08-17 21:57:22'),
	(4, 'B1000001', 3, '2017-08-17 21:57:36'),
	(6, 'B1000002', 2, '2017-08-18 11:21:29'),
	(10, 'B1000001', 4, '2017-08-18 11:23:36'),
	(11, 'B1000001', 5, '2017-08-18 11:23:37'),
	(12, 'B1000002', 3, '2017-08-18 11:23:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.stored_card: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `stored_card` DISABLE KEYS */;
INSERT IGNORE INTO `stored_card` (`id`, `user_id`, `card_user_key`, `card_token`, `card_alias`, `bin_number`, `card_holder_name`, `add_datetime`) VALUES
	(2, 1, NULL, NULL, NULL, NULL, 'ayhan yünt', '2017-08-19 21:46:18');
/*!40000 ALTER TABLE `stored_card` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.sub_categories
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `super_category_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.sub_categories: ~13 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT IGNORE INTO `sub_categories` (`id`, `super_category_id`, `name`) VALUES
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
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.ticket
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_ticket_id` int(11) NOT NULL,
  `is_parent` tinyint(4) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `add_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `parent_ticket_id` (`parent_ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.ticket: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;

-- tablo yapısı dökülüyor b4u_dna.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `e_mail` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `tc` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `father_first` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mother_first` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `mother_maiden` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `e_mail` (`e_mail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- b4u_dna.users: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `e_mail`, `tc`, `password`, `first_name`, `last_name`, `father_first`, `mother_first`, `type`, `mother_maiden`, `add_datetime`, `phone_number`, `is_active`) VALUES
	(1, 'ayhanyunt@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ayhan', 'yünt', 'muhlis', 'nilgün', 0, '', '2017-08-06 20:42:45', '05456772303', 1),
	(2, 'ednarge@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'ali kemal', 'kırçakçı', '', '', 2, '', '2017-08-07 12:37:46', '', 1),
	(3, 'laboratuvar@gmail.com', '', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'labaratuvar', 'test', '', '', 1, '', '2017-08-07 12:39:00', '', 1),
	(5, 'test@test.com', '11111111111', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'test', 'test', 'test', '', 0, 'test', '2017-09-13 17:28:42', '55369326827', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
