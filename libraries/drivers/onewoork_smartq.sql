# ************************************************************
# Sequel Pro SQL dump
# Version 5224
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17-log)
# Database: onewoork_smartq
# Generation Time: 2019-04-04 07:09:43 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table advertiser
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advertiser`;

CREATE TABLE `advertiser` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table advertiser_campaign
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advertiser_campaign`;

CREATE TABLE `advertiser_campaign` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `advert_id` int(11) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `target_group` json DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `advertiser_campaign` WRITE;
/*!40000 ALTER TABLE `advertiser_campaign` DISABLE KEYS */;

INSERT INTO `advertiser_campaign` (`id`, `advert_id`, `date_start`, `date_end`, `target_group`, `status`)
VALUES
	(1,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `advertiser_campaign` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `identification_no` varchar(250) DEFAULT NULL,
  `address` text,
  `contact_no` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`id`, `name`, `identification_no`, `address`, `contact_no`)
VALUES
	(1,'irwan ibrahim','821021065515','2-10-2 Menara Rajawali\r\nJalan 6/56 Au3 Ampang Ulu Klang\r\n54200 Kuala Lumpur','0196693481'),
	(2,'muhammad zayn fatih irwan','150615112315','No 79 Jalan Pegaga U12/11\r\nDesa Alam\r\n40170 Shah Alam Selangor','0123123131'),
	(3,'baru masuk','8210210655159','subang jaya','01231314443'),
	(4,'baru masuk','821021065511','subang jaya','01231314443'),
	(5,'ali mustar','720901221234','tiada','01922231222'),
	(6,'muhammad ali','72122112312','sementara','01923123112'),
	(7,'najmi nawar','871233123121','puchong\r\n','1123133131'),
	(8,'Ben1o','921231011221','jalan pegaga\r\n','0196693481'),
	(9,'','','',''),
	(10,'abu bakar','21212121','johor','0143212121'),
	(11,'irwan ibrahim mobile ios','821021065518','',''),
	(12,'irwan ibrahim mobile ios k','821021065514','',''),
	(13,'Abu Bakar	','881212219921','','0196693481'),
	(14,'Harun','872123211232','','01822122'),
	(15,'Nani Nawar','7298011121','','01722122833'),
	(16,'Slim ','876568776','undefined','998766678'),
	(17,'Johan	','98990212','undefined','87656544'),
	(18,'Fikri','87765456899','Tiada alamat','0187222'),
	(19,'Najib','82102111222','undefined','01223392121'),
	(20,'Buffy adds','9999987777','undefined','766987666'),
	(21,'undefined','undefined','undefined','undefined'),
	(22,'AJAJAJA','11233','undefined','undefined'),
	(23,'Ali','872314091231','','9124123123131'),
	(24,'Murad','78123131','','01212312312'),
	(25,'register web','912313141413','no alamat','012313212'),
	(26,'web register 2','912312312412312','2-10-2 Menara Rajawali','019212141232132'),
	(27,'register web 3','876122123134123','No 8-2, Rampai Niaga1\r\nRampai Business Park','1029121231231'),
	(28,'Akram','8212212212221','','92123123'),
	(29,'onewoorks','9121313','','012132'),
	(30,'irwan ibrahim','821121212','123123','91212312'),
	(31,'ali mukhris','8210210121212','ni aada','81231231'),
	(32,'Kamal','8722012221312','undefined','0196693481');

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table imi_organisation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `imi_organisation`;

CREATE TABLE `imi_organisation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ref_code` int(11) DEFAULT NULL,
  `name` varchar(300) CHARACTER SET utf8mb4 DEFAULT NULL,
  `address_1` varchar(250) CHARACTER SET utf8mb4 DEFAULT '',
  `address_2` varchar(250) CHARACTER SET utf8mb4 DEFAULT '',
  `postcode` varchar(10) CHARACTER SET utf8mb4 DEFAULT NULL,
  `town` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `longitude` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `latitude` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `que_no` int(11) DEFAULT '0',
  `current_no` int(11) DEFAULT '0',
  `max_out` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `imi_organisation` WRITE;
/*!40000 ALTER TABLE `imi_organisation` DISABLE KEYS */;

INSERT INTO `imi_organisation` (`id`, `ref_code`, `name`, `address_1`, `address_2`, `postcode`, `town`, `state`, `longitude`, `latitude`, `que_no`, `current_no`, `max_out`)
VALUES
	(1,100101,'PEJABAT PENGARAH IMIGRESEN NEGERI JOHOR','ARAS 1, BLOK 2G4 (PODIUM) PERSINT 2','PUSAT PENTADBIRAN KERAJAAN PERSEKUTUAN','6255','PUTRAJAYA','WILAYAH PERSEKUTUAN','101.70743','2.94309',56,11,168),
	(3,100102,'KETUA PEJABAT IMIGRESEN','POS IMIGRESEN TAMBAK JOHOR ','','8000','JOHOR BAHRU','JOHOR','103.75828','1.46078',26,22,112),
	(4,100106,'JABATAN IMIGRESEN MALAYSIA NEGERI JOHOR','CAWANGAN MERSING','JALAN ISMAIL','8680','MERSING','JOHOR','103.84010','2.43005',13,11,38),
	(5,100118,'JABATAN IMIGRESEN MALAYSIA NEGERI JOHOR','CAWANGAN KLUANG','ARAS BAWAH BANGUNAN GUNASAMA PERSEKUTUAN','8600','KLUANG','JOHOR','103.28926','2.01605',37,14,192),
	(6,100122,'JABATAN IMIGRESEN MALAYSIA NEGERI JOHOR','CAW. JOHOR BAHRU (BAHAGIAN PASPORT)','ARAS 3, KOMPLEKS PEKAN BARU','8120','JOHOR BAHRU','JOHOR','103.59681','1.66370',32,11,107),
	(7,100129,'JABATAN IMIGRESEN MALAYSIA NEGERI JOHOR DARUL TA\'ZIM','TINGKAT 1, BLOK 1, KOMPLEKS KDN','TAMAN SETIA TROPIKA, KEMPAS','8120','JOHOR BAHRU','JOHOR','103.71832','1.54607',44,16,118),
	(8,100201,'JABATAN IMIGRESEN NEGERI KEDAH','TGKT 1&2, BANGUNAN KDN,','PUSAT PENTADBIRAN KERAJAAN PERSEKUTUAN,','655','ALOR SETAR','KEDAH','99.81175','6.32415',12,9,70),
	(9,100211,'PEJABAT IMIGRESEN KULIM','200-200A, 201-201A','TAMAN SELUANG','900','KULIM','KEDAH','100.55905','5.39731',26,4,157),
	(10,100301,'JABATAN IMIGRESEN NEGERI KELANTAN','ARAS 2, WISMA PERSEKUTUAN','JALAN BAYAM','1555','KOTA BHARU','KELANTAN','102.24645','6.12253',40,28,193),
	(11,100401,'JABATAN IMIGRESEN NEGERI MELAKA','ARAS 1-3, BLOK PENTADBIRAN','KOMP. KHEDN, JLN SERI NEGERI AYER KEROH','7545','MELAKA','MELAKA','102.29715','2.26620',7,4,117),
	(12,100501,'JABATAN IMIGRESEN NEGERI SEMBILAN','TINGKAT 2 & 4, WISMA PERSEKUTUAN','JALAN DATUK ABDUL KADIR','7000','SEREMBAN','SEREMBAN','101.94224','2.72532',15,10,163),
	(13,100601,'JABATAN IMIGRESEN NEGERI PAHANG','KOMPLEKS IMIGRSEN','BANDAR INDERA MAHKOTA','2520','KUANTAN','PAHANG','103.29505','3.83487',46,15,86),
	(14,100704,'JABATAN IMIGRESEN NEGERI PULAU PINANG','JALAN KELESAH','BANDAR SEBERANG JAYA','1370','PULAU PINANG','PULAU PINANG','100.40763','5.39864',18,9,101),
	(15,100801,'PEJABAT IMIGRESEN NEGERI PERAK','ARAS 2-4, KOMPLEKS PEJABAT KDN,','PERSIARAN MERU UTAMA, BANDAR MERU RAYA,','3002','JELAPANG, IPOH','PERAK','101.07171','4.67224',5,4,47),
	(16,100901,'JABATAN IMIGERSEN NEGERI PERLIS','TINGKAT 1, BANGUNAN PERSEKUTUAN','PERSIARAN JUBLI EMAS','100','KANGAR','PERLIS','100.19052','6.41160',20,15,92),
	(17,101001,'JABATAN IMIGRESEN NEGERI SELANGOR','TINGKAT 2 KOMPLEKS PKNS','','4055','SHAH ALAM','SELANGOR','101.51723','3.07045',27,21,119),
	(18,101002,'PEJABAT IMIGRESEN SUBANG','TINGKAT BAWAH KOMPLEKS AIRTEL','LTSAAS                                 ','4720','SUBANG','SELANGOR','101.55263','3.13273',18,11,118),
	(19,101003,'PEJABAT IMIGRESEN KAJANG','LOT 3-60, TINGKAT 3,','KOMPLEKS PERHENTIAN KAJANG, JALAN REKO','4300','KAJANG','KAJANG','101.79136','2.95745',53,27,36),
	(20,101004,'PEJABAT IMIGRESEN KLIA','TINGKAT BAWAH AIRPORT MANAGEMENT CENTRE','','6400','SEPANG','SELANGOR','101.70948','2.75837',42,31,163),
	(21,101005,'PEJABAT IMIGRESEN KLIA','TINGKAT BAWAH AIRPORT MANAGEMENT CENTRE','','4390','SEPANG','SELANGOR','101.70497','2.73473',49,10,148),
	(22,101005,'KLIA','BANGUNAN AMC KLIA','SEPANG','6400','SEPANG','SELANGOR','101.70497','2.73473',59,37,52),
	(23,101006,'PEJABAT IMIGRESEN PELABUHAN KELANG','LOT 6, JLN. DEPOH SEKSYEN 15','BANDAR PELABUHAN KELANG','4200','PELABUHAN KELANG','SELANGOR','101.39576','2.99872',32,20,154),
	(24,101101,'JABATAN IMIGRESEN NEGERI TERENGGANU','TINGKAT 1, WISMA PERSEKUTUAN','JALAN SULTAN ISMAIL','2020','KUALA TERENGGANU','TERENGGANU','103.14244','5.32840',38,35,56),
	(25,101201,'JABATAN IMIGRESEN NEGERI SABAH','ARAS 1-4, BLOK B,','KOMPLEK PENTADBIRAN KERAJAAN PERSEKUTUAN','8840','KOTA KINABALU','SABAH','116.11889','6.02866',23,8,157),
	(26,101301,'JABATAN IMIGRESEN NEGERI SARAWAK','TINGKAT 1 & 2, BANGUNAN SULTAN ISKANDAR','JALAN SIMPANG TIGA,','9355','KUCHING','SARAWAK','110.35919','1.53279',56,17,59),
	(27,101401,'BAHAGIAN KESELAMATAN DAN PASPORT                           ','IBU PEJABAT IMIGRESEN','TINGKAT 1 PODIUM 2G4','6255','PUTRAJAYA','WILAYAH PERSEKUTUAN','101.66778','3.16755',43,25,162),
	(28,101401,'BAHAGIAN VISA, PAS DAN PERMIT, IBU PEJABAT JABATAN IMIGRESEN','TINGKAT 3 (PODIUM), PERSIARAN PERDANA','PRESINT 2','6255','PUTRAJAYA','WILAYAH PERSEKUTUAN','101.66778','3.16755',42,40,75),
	(29,101401,'BAHAGIAN KEWANGAN, IBU PEJABAT IMIGRESEN','TINGKAT 1-7 (PODIUM) BLOK 2G4, PRECINT 2','PUSAT PENTADBIRAN KERAJAAN PERSEKUTUAN','6255','PUTRAJAYA','WILAYAH PERSEKUTUAN','101.66778','3.16755',20,6,48),
	(30,101401,'STOR PUSAT, JABATAN IMIGRESEN MALAYSIA','KOMPLEKS KEMAJUAN','JALAN 19/1B','4630','PETALING JAYA','SELANGOR','101.66778','3.16755',26,20,175),
	(31,101401,'JABATAN IMIGRESEN MALAYSIA (KHEDN), BAH. VISA PAS DAN PERMIT','KOMPLEKS KDN, NO 69, JLN SRI HARTAMAS','JALAN DUTA','5048','KUALA LUMPUR','WILAYAH PERSEKUTUAN','101.66778','3.16755',11,6,171),
	(32,101402,'JABATAN IMIGRESEN WILAYAH PERSEKUTUAN KUALA LUMPUR','ARAS LG, 1,2 & 5, KOMPLEKS KDN','NO 69,JLN SRI HARTAMAS 1, OFF JALAN DUTA','5055','KUALA LUMPUR','WILAYAH PERSEKUTUAN','101.66779','3.16749',28,13,130),
	(33,101402,'JABATAN IMIGRESEN WILAYAH PERSEKUTUAN KUALA LUMPUR','ARAS 2, KOMPLEKS KDN','NO 69,JLN SRI HARTAMAS 1, OFF JALAN DUTA','5055','KUALA LUMPUR','WILAYAH PERSEKUTUAN','101.66779','3.16749',49,45,115),
	(34,101406,'PEJ IMIGRESEN WANGSA MAJU','ARAS 1, WISMA RAMPAI','JLN 34/26, TAMAN SRI RAMPAI, SETAPAK','5330','KUALA LUMPUR','WILAYAH PERSEKUTUAN','101.73084','3.19471',43,20,168),
	(35,101409,'PUTRAJAYA\\','BANGUNAN CHENCERY PLACE','2 JALAN DIPLOMATIK 2, PRESINT 15','6205','BANDAR : PUTRAJAYA','WILAYAH PERSEKUTUAN','101.72505','2.94425',8,6,112),
	(36,101501,'JABATAN IMIGRESEN WILAYAH PERSEKUTUAN LABUAN','UNIT E 002, TINGKAT 1 ARAS PODIUM','KOMPLEKS UJANA KEWANGAN, JLN MERDEKA','8700','WP LABUAN','LABUAN','115.24933','5.27648',19,14,37);

/*!40000 ALTER TABLE `imi_organisation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table imi_queue
# ------------------------------------------------------------

DROP TABLE IF EXISTS `imi_queue`;

CREATE TABLE `imi_queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table machine
# ------------------------------------------------------------

DROP TABLE IF EXISTS `machine`;

CREATE TABLE `machine` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table organisation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `organisation`;

CREATE TABLE `organisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `alamat` text,
  `daerah` varchar(20) DEFAULT NULL,
  `negeri` varchar(20) DEFAULT NULL,
  `no_telefon` varbinary(20) DEFAULT NULL,
  `geolocation` varchar(250) DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  `que_no` int(11) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `organisation` WRITE;
/*!40000 ALTER TABLE `organisation` DISABLE KEYS */;

INSERT INTO `organisation` (`id`, `name`, `alamat`, `daerah`, `negeri`, `no_telefon`, `geolocation`, `jarak`, `que_no`, `current_no`, `latitude`, `longitude`)
VALUES
	(1,'Klinik Kesihatan Kota Sentosa','42490 Pulau Ketam','Klang','Selangor',NULL,NULL,56,90,26,NULL,NULL),
	(2,'Klinik Desa Asam Jawa','45700 Bukit Rotan','Kuala Selangor','Selangor',NULL,NULL,72,84,22,NULL,NULL),
	(3,'Klinik Desa Bagan Pasir','Jalan Bagan Pasir 45500 Tanjung Karang','Kuala Selangor','Selangor',NULL,NULL,91,105,31,NULL,NULL),
	(4,'Klinik Desa Bagan Teochew','42490 Pulau Ketam','Klang','Selangor',NULL,NULL,37,91,27,NULL,NULL),
	(5,'Klinik Desa Balakong','43300 Balakong','Hulu Langat','Selangor',NULL,NULL,11,38,11,NULL,NULL),
	(6,'Klinik Desa Bangi Lama','43000 Kajang','Bangi','Selangor',NULL,NULL,46,14,3,NULL,NULL),
	(7,'Klinik Desa Batang Kali','44300 Hulu Selangor','Batang Kali','Selangor',NULL,NULL,94,37,11,NULL,NULL),
	(8,'Klinik Desa Batu 13 1/2,','Puchong','Petaling','Selangor',NULL,NULL,30,47,14,NULL,NULL),
	(9,'Klinik Desa Batu 18','43100 Hulu Langat','Hulu Langat','Selangor',NULL,NULL,70,18,5,NULL,NULL),
	(10,'Klinik Desa Batu 4 Sepintas','Jalan Sekolah','Sabak Bernam','Selangor',NULL,NULL,58,47,13,NULL,NULL),
	(11,'Klinik Desa Batu Belah Klang','Jalan Istimewa','Klang','Selangor',NULL,NULL,79,69,20,NULL,NULL),
	(12,'Klinik Desa Batu Laut','42800 Kuala Langat','Kuala Langat','Selangor',NULL,NULL,18,101,30,NULL,NULL),
	(13,'Klinik Desa Berjuntai Bistari','Kampung Berjuntai Bistari, Bestari Jaya','Kuala Selangor','Selangor',NULL,NULL,53,92,27,NULL,NULL),
	(14,'Klinik Desa Broga','43500 Semenyih','Semenyih','Selangor',NULL,NULL,8,52,15,NULL,NULL),
	(15,'Klinik Desa Bukit Badong','Jalan Dato\' Karjan','Kuala Selangor','Selangor',NULL,NULL,84,81,24,NULL,NULL),
	(16,'Klinik Desa Bukit Bangkong','43950 Sungai Pelek','Sepang','Selangor',NULL,NULL,93,40,12,NULL,NULL),
	(17,'Klinik Desa Bukit Belimbing','45000 Kuala Selangor','Kuala Selangor','Selangor',NULL,NULL,12,57,17,NULL,NULL),
	(18,'Klinik Desa Bukit Cerakah','45800 Jeram','Kuala Selangor','Selangor',NULL,NULL,80,57,17,NULL,NULL),
	(19,'Klinik Desa Bukit Kapar','Jalan Iskandar','Meru','Selangor',NULL,NULL,63,10,2,NULL,NULL),
	(20,'Klinik Desa Bukit Kerayong','45800 Jeram','Kuala Selangor','Selangor',NULL,NULL,72,65,19,NULL,NULL),
	(21,'Klinik Desa Bukit Kuching','45800 Jeram','Kuala Selangor','Selangor',NULL,NULL,72,93,27,NULL,NULL),
	(22,'Klinik Desa Bukit Naga','Batu 6, Jalan Klinik','Klang','Selangor',NULL,NULL,43,65,19,NULL,NULL),
	(23,'Klinik Desa Dato Abu Bakar Baginda','','Kajang','Selangor',NULL,NULL,98,43,12,NULL,NULL),
	(24,'Klinik Desa Dusun Tua','Batu 16, Hulu Langat','Hulu Langat','Selangor',NULL,NULL,59,15,4,NULL,NULL),
	(25,'Klinik Desa Geching','Jalan Desa Harapan','Salak Tinggi','Selangor',NULL,NULL,1,38,11,NULL,NULL),
	(26,'Klinik Desa Gedangsa','44020 Hulu Selangor','Hulu Selangor','Selangor',NULL,NULL,30,40,12,NULL,NULL),
	(27,'Klinik Desa Genting Malek','44300 Hulu Selangor','Hulu Selangor','Selangor',NULL,NULL,46,83,24,NULL,NULL),
	(28,'Klinik Desa Gombak Utara (Bt. 8)','Batu 8,53000 Gombak','Gombak','Selangor',NULL,NULL,39,90,27,NULL,NULL),
	(29,'Klinik Desa Hulu Kelang','Jalan Datok Abu Samah Kampong Pasir','Ulu Klang','Selangor',NULL,NULL,54,95,28,NULL,NULL),
	(30,'Klinik Desa Hulu Rening','44300 Hulu Selangor','Kuala Kubu Baru','Selangor',NULL,NULL,52,97,29,NULL,NULL),
	(31,'Klinik Desa Jalan Kebun','Batu 7 Jalan Kebun','Klang','Selangor',NULL,NULL,98,97,29,NULL,NULL),
	(32,'Klinik Desa Jenderam','Kg Jenderam Hulu, 43800 Dengkil','Dengkil','Selangor',NULL,NULL,31,88,26,NULL,NULL),
	(33,'Klinik Desa Kampong Padang','Batu 10, Hulu Langat','Hulu Langat','Selangor',NULL,NULL,63,46,13,NULL,NULL),
	(34,'Klinik Desa Kampung Banting','Jalan Kg. Banting','Sabak Bernam','Selangor',NULL,NULL,18,58,17,NULL,NULL),
	(35,'Klinik Desa Kampung Baru','Jalan Kg. Baru','Sabak Bernam','Selangor',NULL,NULL,2,49,14,NULL,NULL),
	(36,'Klinik Desa Kampung Batu 38','Jalan Sekendi Batu 38','Sabak Bernam','Selangor',NULL,NULL,57,64,19,NULL,NULL),
	(37,'Klinik Desa Kampung Budiman','Jalan Paip, Meru','Klang','Selangor',NULL,NULL,75,71,21,NULL,NULL),
	(38,'Klinik Desa Kampung Damansara','Jln.17A/9 Seksyen 17','Petaling Jaya','Selangor',NULL,NULL,2,55,16,NULL,NULL),
	(39,'Klinik Desa Kampung Endah','42700 Banting','Kuala Langat','Selangor',NULL,NULL,87,56,16,NULL,NULL),
	(40,'Klinik Desa Kampung Gesir Tengah','44020 Hulu Selangor','Hulu Selangor','Selangor',NULL,NULL,23,14,3,NULL,NULL),
	(41,'Klinik Desa Kampung Jawa','Batu 2, Jalan Syahbandaraya','Klang','Selangor',NULL,NULL,58,90,27,NULL,NULL),
	(42,'Klinik Desa Kampung Jaya Setia','45600 Bestari Jaya','Bestari Jaya','Selangor',NULL,NULL,17,9,1,NULL,NULL),
	(43,'Klinik Desa Kampung Jenjarom','42600 Jenjarom','Kuala Langat','Selangor',NULL,NULL,13,52,15,NULL,NULL),
	(44,'Klinik Desa Kampung Kenanga','48050 Rawang','Rawang','Selangor',NULL,NULL,11,38,11,NULL,NULL),
	(45,'Klinik Desa Kampung Kuantan','45600 Kuala Selangor','Kuala Selangor','Selangor',NULL,NULL,19,30,8,NULL,NULL),
	(46,'Klinik Desa Kampung Medan','Kuala Langat','Kuala Langat','Selangor',NULL,NULL,59,26,7,NULL,NULL),
	(47,'Klinik Desa Kampung Melayu Subang','Jln Merbau Kg. Melayu, Subang','Shah Alam','Selangor',NULL,NULL,38,38,11,NULL,NULL),
	(48,'Klinik Desa Kampung Nenas','Jalan Kopi','Kapar','Selangor',NULL,NULL,12,9,2,NULL,NULL),
	(49,'Klinik Desa Kampung Pendamar','JKR 1229A Kampung Pendamar','Klang','Selangor',NULL,NULL,44,23,6,NULL,NULL),
	(50,'Klinik Desa Kampung Sekendi','Jalan Batu 36','Sabak Bernam','Selangor',NULL,NULL,84,87,26,NULL,NULL);

/*!40000 ALTER TABLE `organisation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table organisation_directory
# ------------------------------------------------------------

DROP TABLE IF EXISTS `organisation_directory`;

CREATE TABLE `organisation_directory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) DEFAULT NULL,
  `sector` varchar(50) DEFAULT NULL,
  `group` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `organisation_directory` WRITE;
/*!40000 ALTER TABLE `organisation_directory` DISABLE KEYS */;

INSERT INTO `organisation_directory` (`id`, `department_name`, `sector`, `group`)
VALUES
	(1,'MOH','goverment',NULL);

/*!40000 ALTER TABLE `organisation_directory` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table organisation_machine
# ------------------------------------------------------------

DROP TABLE IF EXISTS `organisation_machine`;

CREATE TABLE `organisation_machine` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `org_id` int(11) DEFAULT NULL,
  `machine_name` varchar(50) DEFAULT NULL,
  `serial_number` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table people
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people`;

CREATE TABLE `people` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `no_telefon` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address` text,
  `identification_no` varchar(20) DEFAULT NULL,
  `register_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table people_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people_admin`;

CREATE TABLE `people_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table people_authentication
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people_authentication`;

CREATE TABLE `people_authentication` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table people_profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people_profile`;

CREATE TABLE `people_profile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table people_public
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people_public`;

CREATE TABLE `people_public` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table people_staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people_staff`;

CREATE TABLE `people_staff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table queue
# ------------------------------------------------------------

DROP TABLE IF EXISTS `queue`;

CREATE TABLE `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `queue_no` int(11) DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `register_type` varchar(20) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `show_status` tinyint(1) DEFAULT NULL,
  `code_authorize` text,
  `authorize_timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `queue` WRITE;
/*!40000 ALTER TABLE `queue` DISABLE KEYS */;

INSERT INTO `queue` (`id`, `org_id`, `timestamp`, `queue_no`, `status`, `customer_id`, `register_type`, `ip`, `show_status`, `code_authorize`, `authorize_timestamp`)
VALUES
	(1,1,'2016-09-20 11:45:55',1,'failed-to-arrive',1,'mobile','::1',NULL,NULL,NULL),
	(2,1,'2016-09-20 11:45:55',2,'failed-to-arrive',1,'mobile','::1',NULL,'123',NULL),
	(3,1,'2016-09-20 11:45:55',3,'failed-to-arrive',1,'mobile','::1',NULL,'123',NULL),
	(4,1,'2016-09-20 11:45:55',4,'failed-to-arrive',5,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(5,1,'2016-09-20 11:45:55',5,'failed-to-arrive',5,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(6,1,'2016-09-20 11:45:55',6,'failed-to-arrive',5,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(7,1,'2016-09-20 11:45:55',7,'failed-to-arrive',5,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(8,1,'2016-09-20 11:45:55',8,'failed-to-arrive',5,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(9,1,'2016-09-20 11:45:55',9,'failed-to-arrive',5,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(10,1,'2016-09-20 11:45:55',10,'failed-to-arrive',6,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(11,1,'2016-09-20 11:45:55',11,'failed-to-arrive',6,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(12,1,'2016-09-20 11:45:55',12,'failed-to-arrive',6,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(13,1,'2016-09-20 11:45:55',13,'failed-to-arrive',6,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(14,1,'2016-09-20 11:45:55',14,'failed-to-arrive',6,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(15,1,'2016-09-20 11:45:55',15,'failed-to-arrive',6,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(16,1,'2016-09-20 11:45:55',16,'failed-to-arrive',6,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(17,2,'2016-09-20 11:45:55',1,'failed-to-arrive',7,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(18,1,'2016-09-20 11:45:55',1,'failed-to-arrive',8,'mobile','127.0.0.1',0,'barcode-qrcode',NULL),
	(19,1,'2016-09-22 10:50:27',2,'failed-to-arrive',8,'mobile','127.0.0.1',0,'01EYK4','2016-09-20 11:51:24'),
	(20,1,'2016-09-22 10:50:27',3,'failed-to-arrive',9,'mobile','127.0.0.1',0,'C9A4N4',NULL),
	(21,1,'2016-09-22 10:50:27',3,'failed-to-arrive',10,'mobile','127.0.0.1',0,'Z3Y60G','2016-09-20 12:23:59'),
	(22,0,'2016-09-23 11:29:14',1,'failed-to-arrive',9,'mobile','175.143.110.92',0,'MH8ZW1',NULL),
	(23,0,'2016-09-23 11:29:14',2,'failed-to-arrive',9,'mobile','175.143.110.92',0,'758553',NULL),
	(24,0,'2016-09-23 11:29:14',3,'failed-to-arrive',9,'mobile','175.143.110.92',0,'9GIITV',NULL),
	(25,0,'2016-09-23 11:29:14',4,'failed-to-arrive',9,'mobile','175.143.110.92',0,'CHFMEL',NULL),
	(26,0,'2016-09-23 11:29:14',5,'failed-to-arrive',9,'mobile','175.143.110.92',0,'ADLGFM',NULL),
	(27,0,'2016-09-23 11:29:14',6,'failed-to-arrive',9,'mobile','175.143.110.92',0,'TXHBJQ',NULL),
	(28,0,'2016-09-23 11:29:14',7,'failed-to-arrive',9,'mobile','175.143.110.92',0,'4VGOTZ',NULL),
	(29,0,'2016-09-23 11:29:14',8,'failed-to-arrive',9,'mobile','175.143.110.92',0,'GN21HB',NULL),
	(30,0,'2016-09-23 11:29:14',9,'failed-to-arrive',9,'mobile','175.143.110.92',0,'UHNC5X',NULL),
	(31,0,'2016-09-23 11:29:14',10,'failed-to-arrive',9,'mobile','175.143.110.92',0,'5466Z7',NULL),
	(32,0,'2016-09-23 11:29:14',11,'failed-to-arrive',9,'mobile','175.143.110.92',0,'OZP5LD',NULL),
	(33,0,'2016-09-23 11:29:14',12,'failed-to-arrive',9,'mobile','175.143.110.92',0,'88VXGQ',NULL),
	(34,0,'2016-09-23 11:29:14',13,'failed-to-arrive',9,'mobile','175.143.110.92',0,'EYZUA9',NULL),
	(35,0,'2016-09-23 11:29:14',14,'failed-to-arrive',9,'mobile','175.143.110.92',0,'K4GZTX',NULL),
	(36,0,'2016-09-23 11:29:14',15,'failed-to-arrive',9,'mobile','175.143.110.92',0,'0BKV8I',NULL),
	(37,0,'2016-09-23 11:29:14',16,'failed-to-arrive',9,'mobile','175.143.110.92',0,'KBU6MA',NULL),
	(38,0,'2016-09-23 11:29:14',17,'failed-to-arrive',9,'mobile','175.143.110.92',0,'VWCO6P',NULL),
	(39,0,'2016-09-23 11:29:14',18,'failed-to-arrive',9,'mobile','175.143.110.92',0,'Q85GZW',NULL),
	(40,0,'2016-09-23 11:29:14',19,'failed-to-arrive',11,'mobile','175.143.110.92',0,'ZK2MPQ',NULL),
	(41,0,'2016-09-23 11:29:14',20,'failed-to-arrive',11,'mobile','219.92.76.2',0,'OX65TX',NULL),
	(42,0,'2016-09-23 11:29:14',21,'failed-to-arrive',11,'mobile','219.92.76.2',0,'G3HZBQ',NULL),
	(43,0,'2016-09-23 11:29:14',22,'failed-to-arrive',11,'mobile','219.92.76.2',0,'TEFH7W',NULL),
	(44,0,'2016-09-23 11:29:14',23,'failed-to-arrive',12,'mobile','219.92.76.2',0,'XL17BG',NULL),
	(45,0,'2016-09-23 11:29:14',24,'failed-to-arrive',13,'mobile','219.92.76.2',0,'WGL7F0',NULL),
	(46,0,'2016-09-23 11:29:14',25,'failed-to-arrive',14,'mobile','219.92.76.2',0,'Y0P0UZ',NULL),
	(47,0,'2016-09-23 11:29:14',26,'failed-to-arrive',15,'mobile','219.92.76.2',0,'JLYGJL',NULL),
	(48,0,'2016-09-23 11:29:14',27,'failed-to-arrive',16,'mobile','219.92.76.2',0,'WG63TZ',NULL),
	(49,9,'2016-09-23 11:29:14',1,'failed-to-arrive',17,'mobile','219.92.76.2',0,'OO9NI9',NULL),
	(50,1,'2016-09-23 11:29:14',4,'failed-to-arrive',18,'mobile','219.92.76.2',0,'J0TYM3',NULL),
	(51,1,'2016-09-23 11:29:14',5,'failed-to-arrive',19,'mobile','219.92.76.2',0,'E0K5OQ',NULL),
	(52,0,'2016-09-23 11:29:14',28,'failed-to-arrive',9,'mobile','219.92.76.2',0,'87XQSZ',NULL),
	(53,1,'2016-09-23 11:29:14',6,'failed-to-arrive',20,'mobile','219.92.76.2',0,'BST3QB',NULL),
	(54,1,'2016-09-23 11:29:14',7,'failed-to-arrive',20,'mobile','219.92.76.2',0,'WIWD6A',NULL),
	(55,1,'2016-09-23 11:29:14',8,'failed-to-arrive',20,'mobile','219.92.76.2',0,'E1SBVW',NULL),
	(56,5,'2016-09-23 11:29:14',1,'failed-to-arrive',21,'mobile','219.92.76.2',0,'3ZF9TG',NULL),
	(57,1,'2016-09-23 11:29:14',9,'failed-to-arrive',21,'mobile','219.92.76.2',0,'GJUPSC',NULL),
	(58,3,'2016-09-23 11:29:14',1,'failed-to-arrive',22,'mobile','219.92.76.2',0,'MUETFI',NULL),
	(59,5,'2016-09-23 11:29:14',2,'failed-to-arrive',21,'mobile','219.92.76.2',0,'ZLMYZ7',NULL),
	(60,1,'2016-09-23 11:29:14',10,'failed-to-arrive',20,'mobile','219.92.76.2',0,'27QRDR',NULL),
	(61,1,'2016-09-23 11:29:14',11,'failed-to-arrive',20,'mobile','219.92.76.2',0,'TUD1LP',NULL),
	(62,1,'2016-09-23 11:29:14',12,'failed-to-arrive',21,'mobile','219.92.76.2',0,'DW3CEM',NULL),
	(63,2,'2016-09-23 11:29:14',1,'failed-to-arrive',21,'mobile','219.92.76.2',0,'7AFCAH',NULL),
	(64,2,'2016-09-23 11:29:14',2,'failed-to-arrive',21,'mobile','219.92.76.2',0,'FWPGQZ',NULL),
	(65,1,'2016-09-23 11:29:14',13,'failed-to-arrive',21,'mobile','219.92.76.2',0,'ZJGF96',NULL),
	(66,1,'2016-09-23 11:29:14',14,'failed-to-arrive',20,'mobile','219.92.76.2',0,'BYK07D',NULL),
	(67,9,'2016-09-23 11:29:14',2,'failed-to-arrive',21,'mobile','219.92.76.2',0,'5ENCKY',NULL),
	(68,1,'2016-09-23 11:29:14',15,'failed-to-arrive',21,'mobile','219.92.76.2',0,'R0VVUJ',NULL),
	(69,6,'2016-09-23 11:29:14',1,'failed-to-arrive',21,'mobile','219.92.76.2',0,'B6TJ8R',NULL),
	(70,1,'2016-09-23 11:29:14',16,'failed-to-arrive',21,'mobile','219.92.76.2',0,'FMUI9P',NULL),
	(71,1,'2016-09-23 11:29:14',17,'failed-to-arrive',20,'mobile','219.92.76.2',0,'MAPCVZ',NULL),
	(72,1,'2016-09-23 11:29:14',18,'failed-to-arrive',20,'mobile','219.92.76.2',0,'VD1AIB',NULL),
	(73,7,'2016-09-23 11:29:14',1,'failed-to-arrive',21,'mobile','219.92.76.2',0,'9IEG8S',NULL),
	(74,4,'2016-09-23 11:29:14',1,'failed-to-arrive',21,'mobile','219.92.76.2',0,'FUXLN9',NULL),
	(75,4,'2016-09-23 11:29:14',2,'failed-to-arrive',21,'mobile','219.92.76.2',0,'STXHML',NULL),
	(76,6,'2016-09-23 11:29:14',2,'failed-to-arrive',21,'mobile','219.92.76.2',0,'4PD9SK',NULL),
	(77,7,'2016-09-23 11:29:14',2,'failed-to-arrive',21,'mobile','219.92.76.2',0,'L9F5BG',NULL),
	(78,1,'2016-09-23 11:29:14',19,'failed-to-arrive',21,'mobile','219.92.76.2',0,'UOPKJD',NULL),
	(79,5,'2016-09-23 11:29:14',3,'failed-to-arrive',21,'mobile','219.92.76.2',0,'0IDC8N',NULL),
	(80,9,'2016-09-23 11:29:14',3,'failed-to-arrive',21,'mobile','219.92.76.2',0,'D03GOT',NULL),
	(81,9,'2016-09-23 11:29:14',4,'failed-to-arrive',21,'mobile','219.92.76.2',0,'4G52PU',NULL),
	(82,9,'2016-09-23 11:29:14',5,'failed-to-arrive',21,'mobile','219.92.76.2',0,'Q8JBS6',NULL),
	(83,1,'2016-09-23 11:29:14',20,'failed-to-arrive',21,'mobile','219.92.76.2',0,'PD1TDQ',NULL),
	(84,9,'2016-09-23 11:29:14',6,'failed-to-arrive',21,'mobile','219.92.76.2',0,'J6PJT2',NULL),
	(85,1,'2016-09-23 11:29:14',21,'failed-to-arrive',21,'mobile','219.92.76.2',0,'XFC2NT',NULL),
	(86,1,'2016-09-23 11:29:14',22,'failed-to-arrive',21,'mobile','219.92.76.2',0,'YOGR09',NULL),
	(87,11,'2016-09-23 11:29:14',1,'failed-to-arrive',21,'mobile','219.92.76.2',0,'XVOJMM',NULL),
	(88,10,'2016-09-23 11:29:14',1,'failed-to-arrive',21,'mobile','219.92.76.2',0,'B3G6OB',NULL),
	(89,1,'2016-09-26 14:57:57',23,'failed-to-arrive',9,'mobile','219.92.76.2',0,'U7DMRI',NULL),
	(90,1,'2016-09-26 14:57:57',24,'failed-to-arrive',9,'mobile','219.92.76.2',0,'BJVGOJ',NULL),
	(91,1,'2016-09-26 14:57:57',25,'failed-to-arrive',23,'mobile','219.92.76.2',0,'GSP24T',NULL),
	(92,1,'2016-09-26 14:57:57',26,'failed-to-arrive',24,'mobile','219.92.76.2',0,'DG4LEG',NULL),
	(93,1,'2016-09-26 14:57:57',27,'failed-to-arrive',9,'mobile','219.92.76.2',0,'8BCCJ5',NULL),
	(94,1,'2016-09-26 14:57:57',28,'failed-to-arrive',9,'mobile','219.92.76.2',0,'DJRX4Z',NULL),
	(95,1,'2016-09-26 14:57:57',29,'failed-to-arrive',25,'mobile','219.92.76.2',0,'H4AVOU',NULL),
	(96,1,'2016-09-26 14:57:57',30,'failed-to-arrive',26,'','219.92.76.2',0,'8DIFF9',NULL),
	(97,1,'2016-09-26 14:57:57',31,'failed-to-arrive',27,'web','219.92.76.2',0,'TNUJ0Q',NULL),
	(98,1,'2016-09-26 14:57:57',32,'failed-to-arrive',9,'web','219.92.76.2',0,'JYV0GE',NULL),
	(99,1,'2016-09-26 14:57:57',33,'failed-to-arrive',9,'web','219.92.76.2',0,'VMXHBS',NULL),
	(100,1,'2016-09-26 14:57:57',34,'failed-to-arrive',9,'web','219.92.76.2',0,'EZIW03',NULL),
	(101,1,'2016-09-26 14:57:57',35,'failed-to-arrive',9,'web','219.92.76.2',0,'JTSE8Y',NULL),
	(102,1,'2016-09-26 14:57:57',36,'failed-to-arrive',28,'web','219.92.76.2',0,'2TZBEZ',NULL),
	(103,1,'2016-09-26 14:57:57',37,'failed-to-arrive',9,'web','219.92.76.2',0,'6QBW0F',NULL),
	(104,1,'2016-09-26 14:57:57',38,'failed-to-arrive',9,'web','219.92.76.2',0,'EWN1AC',NULL),
	(105,1,'2016-09-26 14:57:57',39,'failed-to-arrive',29,'web','219.92.76.2',0,'C3W3Z1',NULL),
	(106,1,'2016-09-26 14:57:57',40,'failed-to-arrive',9,'web','219.92.76.2',0,'H690KD',NULL),
	(107,1,'2016-09-26 14:57:57',41,'failed-to-arrive',9,'web','219.92.76.2',0,'Y4IG2X',NULL),
	(108,1,'2016-09-26 14:57:57',42,'failed-to-arrive',9,'web','219.92.76.2',0,'QLUN8D',NULL),
	(109,1,'2016-09-26 14:57:57',43,'failed-to-arrive',9,'web','219.92.76.2',0,'GLHYY6',NULL),
	(110,1,'2016-09-26 14:57:57',44,'failed-to-arrive',9,'web','219.92.76.2',0,'MTWY9Y',NULL),
	(111,1,'2016-09-26 14:57:57',45,'failed-to-arrive',9,'web','219.92.76.2',0,'KFELIE',NULL),
	(112,1,'2016-09-26 14:57:57',46,'failed-to-arrive',9,'web','219.92.76.2',0,'4KB0DY',NULL),
	(113,1,'2016-09-26 14:57:57',46,'failed-to-arrive',9,'web','219.92.76.2',0,'XCT2UE',NULL),
	(114,1,'2016-09-26 14:57:57',47,'failed-to-arrive',30,'web','219.92.76.2',0,'4J1W1H',NULL),
	(115,1,'2016-09-26 14:57:57',48,'failed-to-arrive',31,'web','219.92.76.2',0,'8BW5QJ',NULL),
	(116,1,'2016-09-30 15:33:12',49,'failed-to-arrive',21,'','219.92.76.2',0,'U53IOA',NULL),
	(117,1,'2016-09-30 15:33:12',50,'failed-to-arrive',21,'','219.92.76.2',0,'9NAG7E',NULL),
	(118,1,'2016-09-30 15:33:12',51,'failed-to-arrive',21,'','219.92.76.2',0,'EARFXP',NULL),
	(119,1,'2016-09-30 15:33:12',52,'failed-to-arrive',21,'','219.92.76.2',0,'4OK949',NULL),
	(120,1,'2016-09-30 15:33:12',53,'failed-to-arrive',21,'','219.92.76.2',0,'RTAWCZ',NULL),
	(121,1,'2016-09-30 15:33:12',54,'failed-to-arrive',21,'','219.92.76.2',0,'3Y3UCA',NULL),
	(122,0,'2016-10-05 10:38:06',1,'failed-to-arrive',32,'','219.92.76.2',0,'T62PVC',NULL),
	(123,0,'2016-10-13 15:53:29',2,'failed-to-arrive',21,'','219.92.76.2',0,'WLUSEU',NULL),
	(124,0,'2016-10-13 15:53:29',2,'failed-to-arrive',21,'','219.92.76.2',0,'IMOAH6',NULL),
	(125,0,'2016-10-13 15:53:29',3,'failed-to-arrive',21,'','113.210.178.244',0,'OSS1AD',NULL),
	(126,0,'2016-10-13 15:53:29',4,'failed-to-arrive',21,'','113.210.178.244',0,'BZTZK8',NULL),
	(127,0,'2016-10-13 15:53:29',5,'failed-to-arrive',21,'','175.141.138.232',0,'RDZOW0',NULL),
	(128,0,'2016-10-20 15:01:02',6,'failed-to-arrive',21,'','175.143.110.142',0,'YBO3K2',NULL),
	(129,0,'2016-10-21 12:11:12',7,'failed-to-arrive',21,'','113.210.79.223',0,'6V7P4S',NULL),
	(130,0,'2016-10-21 12:11:12',7,'failed-to-arrive',21,'','113.210.79.223',0,'ZFZRP8',NULL),
	(131,0,'2016-10-21 12:11:12',8,'failed-to-arrive',21,'','113.210.79.223',0,'JJ1PJ0',NULL),
	(132,0,'2016-10-21 12:11:12',9,'failed-to-arrive',21,'','113.210.79.223',0,'6ETNU8',NULL),
	(133,0,'2016-10-21 12:11:12',10,'failed-to-arrive',21,'','113.210.79.223',0,'AE779N',NULL),
	(134,0,'2018-08-14 11:49:37',11,'failed-to-arrive',21,'','113.210.114.53',0,'Q5JCSG',NULL),
	(135,0,'2018-08-14 11:49:37',12,'failed-to-arrive',21,'','113.210.114.53',0,'LPOF95',NULL),
	(136,1,'2018-08-14 11:51:28',13,'failed-to-arrive',21,'','113.210.114.53',0,'RC0P4U',NULL);

/*!40000 ALTER TABLE `queue` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table queue_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `queue_status`;

CREATE TABLE `queue_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(30) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `queue_status` WRITE;
/*!40000 ALTER TABLE `queue_status` DISABLE KEYS */;

INSERT INTO `queue_status` (`id`, `status_name`, `description`)
VALUES
	(1,'reserved number',NULL),
	(2,'around compound area',NULL),
	(3,'cancel queue',NULL),
	(4,'completed',NULL),
	(5,'no show',NULL);

/*!40000 ALTER TABLE `queue_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table transaction_advertising
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transaction_advertising`;

CREATE TABLE `transaction_advertising` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table transaction_people
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transaction_people`;

CREATE TABLE `transaction_people` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table transaction_queue
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transaction_queue`;

CREATE TABLE `transaction_queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
