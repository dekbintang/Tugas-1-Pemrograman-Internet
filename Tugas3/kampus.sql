/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - kampus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kampus` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `kampus`;

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`id`,`nim`,`nama`,`prodi`) values 
(3,'2405551003','Kayla Emily','Teknologi Informasi'),
(4,'2405551004','Kadek Egy Putra Sena','Teknologi Informasi'),
(5,'2405551005','Komang Satria Bagas Bramantara','Teknologi Informasi'),
(6,'2405551006','Putu Ayu Dinda Pramiswari','Teknologi Informasi'),
(7,'2405551007','I Gusti Bagus Narendratanaya Wiweka','Teknologi Informasi'),
(8,'2405551008','Putu Deva Rangga Arinegara','Teknologi Informasi'),
(9,'2405551009','Ni Made Rita Mutiara Dewi','Teknologi Informasi'),
(10,'2405551010','Ni Made Adelia Wirasanti','Teknologi Informasi'),
(11,'2405551011','Ni Ketut Putri Ratna Marlangen Sudarta','Teknologi Informasi'),
(12,'2405551012','Axel Clement Sison Lusikooy','Teknologi Informasi'),
(13,'2405551013','Kadek Satya Adi Wiryatama','Teknologi Informasi'),
(14,'2405551014','Gusti Ayu Komang Anggun Berlianti','Teknologi Informasi'),
(15,'2405551015','I Made Ivan Ari Mahayana','Teknologi Informasi'),
(16,'2405551016','Anak Agung Istri Mas Gayatri Dewi','Teknologi Informasi'),
(17,'2405551017','Ni Putu Sri Rahmasari','Teknologi Informasi'),
(18,'2405551018','Anak Agung Ngurah Bramanda Maha Saputra','Teknologi Informasi'),
(19,'2405551019','Richard Christian Mozart Diazoni','Teknologi Informasi'),
(20,'2405551020','I Komang Anugrah Kusuma Sena Andika','Teknologi Informasi'),
(21,'2405551021','I Gusti Ayu Nairiswari Bhava','Teknologi Informasi'),
(22,'2405551022','Nadhira Salsabila Trianitasari','Teknologi Informasi'),
(23,'2405551023','Ida Ayu Mas Dwi Danakitri','Teknologi Informasi'),
(24,'2405551024','M. Gozali','Teknologi Informasi'),
(25,'2405551025','I Gde Made Fajar Harry Putra Utama','Teknologi Informasi'),
(26,'2405551026','I Putu Raditya Dharma Yoga','Teknologi Informasi'),
(27,'2405551027','Muhammad Farrel Fahrezhy','Teknologi Informasi'),
(28,'2405551028','I Made Dwipa Raditya Dinatha','Teknologi Informasi'),
(29,'2405551029','I Gede Wastu Namsa Raditya','Teknologi Informasi'),
(30,'2405551030','Awan Qieuro Ganter','Teknologi Informasi'),
(31,'2405551031','I Made Gede Arya Wedha','Teknologi Informasi'),
(32,'2405551032','M.Rizki Ibnu Effendi','Teknologi Informasi'),
(33,'2405551033','Enda sri ulina br ginting','Teknologi Informasi'),
(34,'2405551034','I Komang Cahya Kertha Yasa','Teknologi Informasi'),
(35,'2405551035','Ni Putu Candradevi Davantari','Teknologi Informasi'),
(36,'2405551036','Steven Satyam Wijanarko','Teknologi Informasi'),
(37,'2405551037','Made Sheva Adi Pramana','Teknologi Informasi'),
(38,'2405551038','Anak Agung Narendera Sancaya','Teknologi Informasi'),
(39,'2405551039','Najwa Tahir','Teknologi Informasi'),
(40,'2405551040','Ida Bagus Agung Adhi Dharmasutha','Teknologi Informasi'),
(41,'2405551041','I Made Rudita','Teknologi Informasi'),
(42,'2405551042','Ni Made Mita Dwi Ulandari','Teknologi Informasi'),
(43,'2405551043','I Made Nanda Prasetya Dwipayana','Teknologi Informasi'),
(44,'2405551044','Harun Yahya','Teknologi Informasi'),
(45,'2405551045','Made Rama Devananda','Teknologi Informasi'),
(46,'2405551046','Dewa Gede Cahya Putra','Teknologi Informasi'),
(47,'2405551047','I Komang Pasek Adiantara','Teknologi Informasi'),
(48,'2405551048','Margaret Nuarimabel Siburian','Teknologi Informasi'),
(50,'2405551050','Nyoman Pramita Windari','Teknologi Informasi'),
(55,'2405551049','I Kadek Bintang Adi Bimantara','Teknologi Informasi');

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11) NOT NULL,
  `mata_kuliah` varchar(50) NOT NULL,
  `sks` tinyint(4) NOT NULL,
  `nilai_huruf` enum('A','B','C','D','E') NOT NULL,
  `nilai_angka` decimal(3,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `nilai` */

insert  into `nilai`(`id`,`mahasiswa_id`,`mata_kuliah`,`sks`,`nilai_huruf`,`nilai_angka`) values 
(4,3,'qqq',3,'A',4.00);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
