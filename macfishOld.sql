/*
SQLyog Community v10.51 
MySQL - 5.6.16 : Database - macfish
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`macfish` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `macfish`;

/*Table structure for table `achat` */

DROP TABLE IF EXISTS `achat`;

CREATE TABLE `achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dateAchat` datetime DEFAULT NULL,
  `poidsTotal` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `montantTotal` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `modePaiement` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `numCheque` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `mareyeur_id` int(11) DEFAULT NULL,
  `heureReception` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_26A98456C071508A` (`mareyeur_id`),
  CONSTRAINT `FK_26A98456C071508A` FOREIGN KEY (`mareyeur_id`) REFERENCES `mareyeur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `achat` */

insert  into `achat`(`id`,`numero`,`dateAchat`,`poidsTotal`,`montantTotal`,`modePaiement`,`numCheque`,`codeUsine`,`login`,`status`,`createdDate`,`updatedDate`,`deletedDate`,`mareyeur_id`,`heureReception`) values (75,'00001','2015-11-03 20:56:33','1200','2400000','Esp','','usine_dakar','admin',0,'2015-11-03 20:56:33','2015-11-03 20:56:33',NULL,5,'08:00:00'),(76,'00076','2015-11-03 21:02:47','500','1066600','Esp','','usine_dakar','admin',0,'2015-11-03 21:02:47','2015-11-03 21:02:47',NULL,5,'08:00:00'),(77,'00077','2015-11-03 21:06:07','200','400000','Esp','','usine_dakar','admin',0,'2015-11-03 21:06:08','2015-11-03 21:06:08',NULL,5,'08:00:00'),(78,'00078','2015-11-03 21:07:59','300','600000','Esp','','usine_dakar','admin',2,'2015-11-03 21:07:59','2015-11-03 21:07:59',NULL,5,'08:00:00'),(79,'00079','2015-11-03 21:09:23','200','400000','Esp','','usine_dakar','admin',2,'2015-11-03 21:09:23','2015-11-03 21:09:23',NULL,21,'08:00:00'),(80,'00080','2015-11-03 21:11:31','399','798000','Esp','','usine_dakar','admin',2,'2015-11-03 21:11:31','2015-11-03 21:11:31',NULL,5,'08:00:00'),(81,'00081','2015-11-03 21:14:41','300','600000','Esp','','usine_dakar','admin',1,'2015-11-03 21:14:41','2015-11-03 21:14:41',NULL,5,'08:00:00'),(82,'00082','2015-11-03 23:10:06','120','240000','Esp','','usine_dakar','admin',1,'2015-11-03 23:10:06','2015-11-03 23:10:06',NULL,5,'08:00:00'),(83,'00083','2015-11-04 14:14:32','200','400000','Esp','','usine_dakar','admin',1,'2015-11-04 14:14:32','2015-11-04 14:14:32',NULL,5,'08:00:00'),(84,'00084','2015-11-04 17:58:41','300','600000','Esp','','usine_dakar','admin',1,'2015-11-04 17:58:42','2015-11-04 17:58:42',NULL,5,'08:00:00'),(85,'00085','2015-11-09 21:54:55','23','46000','Esp','','usine_dakar','admin',0,'2015-11-09 21:54:55','2015-11-09 21:54:55',NULL,5,'08:00:00'),(86,'00086','2015-11-09 21:56:15','33','66000','Esp','','usine_dakar','admin',0,'2015-11-09 21:56:15','2015-11-09 21:56:15',NULL,5,'08:00:00'),(87,'00087','2015-11-09 22:16:54','22','44000','Esp','','usine_dakar','admin',0,'2015-11-09 22:16:55','2015-11-09 22:16:55',NULL,5,'08:00:00'),(88,'00088','2015-11-09 22:54:43','44','88000','Esp','','usine_dakar','admin',0,'2015-11-09 22:54:43','2015-11-09 22:54:43',NULL,5,'08:00:00'),(89,'00089','2015-11-10 15:51:45','23','46000','Esp','','usine_dakar','admin',0,'2015-11-10 15:51:45','2015-11-10 15:51:45',NULL,5,'08:00:00'),(90,'00089','2015-11-10 15:52:08','23','46000','Esp','','usine_dakar','admin',0,'2015-11-10 15:52:08','2015-11-10 15:52:08',NULL,5,'08:00:00'),(91,'00089','2015-11-10 16:01:51','23','46000','Esp','','usine_dakar','admin',0,'2015-11-10 16:01:51','2015-11-10 16:01:51',NULL,5,'08:00:00'),(92,'00089','2015-11-10 16:02:08','23','46000','Esp','','usine_dakar','admin',0,'2015-11-10 16:02:08','2015-11-10 16:02:08',NULL,5,'08:00:00'),(93,'00089','2015-11-10 16:02:23','23','46000','Esp','','usine_dakar','admin',0,'2015-11-10 16:02:23','2015-11-10 16:02:23',NULL,5,'08:00:00'),(94,'00094','2015-11-10 17:02:11','23','46000','Esp','','usine_dakar','admin',0,'2015-11-10 17:02:11','2015-11-10 17:02:11',NULL,5,'08:00:00'),(95,'00095','2015-11-10 17:20:21','2','4000','Esp','','usine_dakar','admin',0,'2015-11-10 17:20:21','2015-11-10 17:20:21',NULL,5,'08:00:00'),(96,'00096','2015-11-10 17:23:20','50','52044','Esp','','usine_dakar','admin',0,'2015-11-10 17:23:20','2015-11-10 17:23:20',NULL,5,'08:00:00'),(97,'00097','2015-11-10 17:23:52','2','4444','Esp','','usine_dakar','admin',0,'2015-11-10 17:23:52','2015-11-10 17:23:52',NULL,5,'08:00:00'),(98,'00098','2015-11-10 17:24:53','2','4000','Esp','','usine_dakar','admin',0,'2015-11-10 17:24:53','2015-11-10 17:24:53',NULL,5,'08:00:00'),(99,'00099','2015-11-10 17:30:12','66','141990','Esp','','usine_dakar','admin',0,'2015-11-10 17:30:12','2015-11-10 17:30:12',NULL,5,'08:00:00'),(100,'00099','2015-11-10 17:31:06','66','141990','Esp','','usine_dakar','admin',0,'2015-11-10 17:31:06','2015-11-10 17:31:06',NULL,5,'08:00:00'),(101,'00101','2015-11-10 17:31:29','7','14000','Esp','','usine_dakar','admin',0,'2015-11-10 17:31:29','2015-11-10 17:31:29',NULL,5,'08:00:00'),(102,'00102','2015-11-10 17:32:11','9','18000','Esp','','usine_dakar','admin',0,'2015-11-10 17:32:11','2015-11-10 17:32:11',NULL,5,'08:00:00'),(103,'00103','2015-11-10 17:33:06','63','139986','Esp','','usine_dakar','admin',0,'2015-11-10 17:33:07','2015-11-10 17:33:07',NULL,21,'08:00:00'),(104,'00104','2015-11-10 17:33:37','67','134000','Esp','','usine_dakar','admin',0,'2015-11-10 17:33:37','2015-11-10 17:33:37',NULL,5,'08:00:00'),(105,'00105','2015-11-10 17:34:39','56','124432','Esp','','usine_dakar','admin',0,'2015-11-10 17:34:39','2015-11-10 17:34:39',NULL,21,'08:00:00'),(106,'00106','2015-11-10 17:41:44','44','88000','Esp','','usine_dakar','admin',0,'2015-11-10 17:41:44','2015-11-10 17:41:44',NULL,21,'08:00:00'),(107,'00106','2015-11-10 17:45:48','44','88000','Esp','','usine_dakar','admin',0,'2015-11-10 17:45:49','2015-11-10 17:45:49',NULL,21,'08:00:00'),(108,'00108','2015-11-10 17:47:11','32','71104','Esp','','usine_dakar','admin',0,'2015-11-10 17:47:11','2015-11-10 17:47:11',NULL,5,'08:00:00'),(109,'00109','2015-11-10 17:51:28','22','44000','Esp','','usine_dakar','admin',0,'2015-11-10 17:51:28','2015-11-10 17:51:28',NULL,5,'08:00:00'),(110,'00110','2015-11-10 17:52:59','5','10000','Esp','','usine_dakar','admin',0,'2015-11-10 17:53:00','2015-11-10 17:53:00',NULL,5,'08:00:00'),(111,'00110','2015-11-10 17:53:09','5','10000','Esp','','usine_dakar','admin',0,'2015-11-10 17:53:09','2015-11-10 17:53:09',NULL,5,'08:00:00'),(112,'00112','2015-11-10 18:04:06','43','95546','Esp','','usine_dakar','admin',0,'2015-11-10 18:04:06','2015-11-10 18:04:06',NULL,5,'08:00:00');

/*Table structure for table `achat_paiement` */

DROP TABLE IF EXISTS `achat_paiement`;

CREATE TABLE `achat_paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mareyeur_id` int(11) DEFAULT NULL,
  `achat_id` int(11) DEFAULT NULL,
  `datePaiement` datetime DEFAULT NULL,
  `montant` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4AE3FC34C071508A` (`mareyeur_id`),
  KEY `IDX_4AE3FC34FE95D117` (`achat_id`),
  CONSTRAINT `FK_4AE3FC34C071508A` FOREIGN KEY (`mareyeur_id`) REFERENCES `mareyeur` (`id`),
  CONSTRAINT `FK_4AE3FC34FE95D117` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `achat_paiement` */

/*Table structure for table `bon_sortie` */

DROP TABLE IF EXISTS `bon_sortie`;

CREATE TABLE `bon_sortie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `numeroBonSortie` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dateBonSortie` datetime DEFAULT NULL,
  `numeroContainer` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroPlomb` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroCamion` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomChauffeur` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `origine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `destination` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `poidsTotal` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2843ABC819EB6921` (`client_id`),
  CONSTRAINT `FK_2843ABC819EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `bon_sortie` */

insert  into `bon_sortie`(`id`,`client_id`,`numeroBonSortie`,`dateBonSortie`,`numeroContainer`,`numeroPlomb`,`numeroCamion`,`nomChauffeur`,`origine`,`destination`,`codeUsine`,`login`,`status`,`createdDate`,`updatedDate`,`deletedDate`,`poidsTotal`) values (1,1,'00001','2015-11-07 17:56:42','2344','5443','33','Matgere','1','1','usine_dakar','admin',0,NULL,NULL,NULL,''),(2,1,'00002','2015-11-07 17:58:23','533','5445','54','milk','\r\n							UsineDakarRufisque\r\n						','\r\n							UsineDakarRufisque\r\n						','usine_dakar','admin',0,NULL,NULL,NULL,''),(3,2,'00003','2015-11-07 18:15:50','re54','644','44','hhhh','\r\n							UsineDakarRufisque\r\n						','\r\n							UsineDakarRufisque\r\n						','usine_dakar','admin',0,NULL,NULL,NULL,''),(4,1,'00004','2015-11-07 18:17:09','23344','5433','444','nat','\r\n							UsineDakarRufisque\r\n						','\r\n							UsineDakarRufisque\r\n						','usine_dakar','admin',0,NULL,NULL,NULL,''),(5,1,'00004','2015-11-07 18:17:22','23344','5433','444','nat','\r\n							UsineDakarRufisque\r\n						','\r\n							UsineDakarRufisque\r\n						','usine_dakar','admin',0,NULL,NULL,NULL,''),(6,1,'00004','2015-11-07 18:18:43','23344','5433','444','nat','\r\n							UsineDakarRufisque\r\n						','\r\n							UsineDakarRufisque\r\n						','usine_dakar','admin',0,NULL,NULL,NULL,''),(7,1,'00004','2015-11-07 18:18:54','23344','5433','444','nat','\r\n							UsineDakarRufisque\r\n						','\r\n							UsineDakarRufisque\r\n						','usine_dakar','admin',0,NULL,NULL,NULL,''),(8,1,'00004','2015-11-07 18:19:59','23344','5433','444','nat','\r\n							UsineDakarRufisque\r\n						','\r\n							UsineDakarRufisque\r\n						','usine_dakar','admin',0,NULL,NULL,NULL,''),(9,1,'00009','2015-11-07 18:21:08','45454','55454','4545','pouu','\r\n							UsineDakarRufisque\r\n						','\r\n							UsineDakarRufisque\r\n						','usine_dakar','admin',0,NULL,NULL,NULL,''),(10,1,'00010','2015-11-07 18:39:33','543','543','5432','nht','[object Object]','[object Object]','usine_dakar','admin',0,NULL,NULL,NULL,'500'),(11,2,'00011','2015-11-07 18:44:26','45','546','5656','gdd','Dakar','Rufisque','usine_dakar','admin',0,NULL,NULL,NULL,'500'),(12,1,'00012','2015-11-09 21:49:32','4444','44','444','gfg','Dakar','Dakar','usine_dakar','admin',0,NULL,NULL,NULL,'400');

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `client` */

insert  into `client`(`id`,`nom`,`adresse`,`telephone`,`reference`) values (1,'Demba BA','DAKAR','7777777',''),(2,'Alpha NDOYE','RUFISQUE','777777','');

/*Table structure for table `famille_produit` */

DROP TABLE IF EXISTS `famille_produit`;

CREATE TABLE `famille_produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `famille_produit` */

insert  into `famille_produit`(`id`,`libelle`,`createdDate`,`updatedDate`,`deleteDate`) values (1,'test','2015-09-19 13:59:28','2015-09-19 13:59:28',NULL),(2,'Viande','2015-09-19 14:00:55','2015-09-19 18:50:18',NULL),(3,'msd555','2015-09-19 14:01:13','2015-09-19 18:50:00',NULL),(6,'ddfd','2015-09-19 18:37:22','2015-09-19 18:37:22',NULL),(7,'fdfd','2015-09-19 18:40:16','2015-09-19 18:40:16',NULL),(8,'fl','2015-09-20 13:28:40','2015-09-20 13:28:40',NULL),(9,'nest','2015-09-28 10:55:15','2015-09-28 10:55:15',NULL),(10,'montest','2015-10-17 16:44:08','2015-10-17 16:44:08',NULL);

/*Table structure for table `fournisseur` */

DROP TABLE IF EXISTS `fournisseur`;

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `fournisseur` */

/*Table structure for table `ligne_achat` */

DROP TABLE IF EXISTS `ligne_achat`;

CREATE TABLE `ligne_achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `achat_id` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_25056E66F347EFB` (`produit_id`),
  KEY `IDX_25056E66FE95D117` (`achat_id`),
  CONSTRAINT `FK_25056E66F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_25056E66FE95D117` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_achat` */

insert  into `ligne_achat`(`id`,`produit_id`,`achat_id`,`createdDate`,`updatedDate`,`deletedDate`,`quantite`,`montant`,`poids`) values (1,10,81,'2015-11-03 21:14:41','2015-11-03 21:14:41',NULL,300,600000,0),(2,10,82,'2015-11-03 23:10:06','2015-11-03 23:10:06',NULL,120,240000,0),(3,10,83,'2015-11-04 14:14:33','2015-11-04 14:14:33',NULL,200,400000,0),(4,10,84,'2015-11-04 17:58:42','2015-11-04 17:58:42',NULL,300,600000,0),(5,10,85,'2015-11-09 21:54:56','2015-11-09 21:54:56',NULL,23,46000,0),(6,10,86,'2015-11-09 21:56:16','2015-11-09 21:56:16',NULL,33,66000,0),(7,10,87,'2015-11-09 22:16:55','2015-11-09 22:16:55',NULL,22,44000,0),(8,10,88,'2015-11-09 22:54:44','2015-11-09 22:54:44',NULL,44,88000,0),(9,10,89,'2015-11-10 15:51:46','2015-11-10 15:51:46',NULL,23,46000,0),(10,10,90,'2015-11-10 15:52:08','2015-11-10 15:52:08',NULL,23,46000,0),(11,10,91,'2015-11-10 16:01:51','2015-11-10 16:01:51',NULL,23,46000,0),(12,10,92,'2015-11-10 16:02:09','2015-11-10 16:02:09',NULL,23,46000,0),(13,10,93,'2015-11-10 16:02:23','2015-11-10 16:02:23',NULL,23,46000,0),(14,10,94,'2015-11-10 17:02:11','2015-11-10 17:02:11',NULL,23,46000,0),(15,10,95,'2015-11-10 17:20:21','2015-11-10 17:20:21',NULL,2,4000,0),(16,10,96,'2015-11-10 17:23:20','2015-11-10 17:23:20',NULL,26,52000,0),(17,NULL,96,'2015-11-10 17:23:20','2015-11-10 17:23:20',NULL,24,44,0),(18,9,97,'2015-11-10 17:23:52','2015-11-10 17:23:52',NULL,2,4444,0),(19,10,98,'2015-11-10 17:24:53','2015-11-10 17:24:53',NULL,2,4000,0),(20,10,99,'2015-11-10 17:30:12','2015-11-10 17:30:12',NULL,12,24000,0),(21,10,99,'2015-11-10 17:30:13','2015-11-10 17:30:13',NULL,9,18000,0),(22,9,99,'2015-11-10 17:30:13','2015-11-10 17:30:13',NULL,45,99990,0),(23,10,100,'2015-11-10 17:31:06','2015-11-10 17:31:06',NULL,12,24000,0),(24,10,100,'2015-11-10 17:31:07','2015-11-10 17:31:07',NULL,9,18000,0),(25,9,100,'2015-11-10 17:31:07','2015-11-10 17:31:07',NULL,45,99990,0),(26,10,101,'2015-11-10 17:31:30','2015-11-10 17:31:30',NULL,7,14000,0),(27,10,102,'2015-11-10 17:32:11','2015-11-10 17:32:11',NULL,9,18000,0),(28,9,103,'2015-11-10 17:33:07','2015-11-10 17:33:07',NULL,63,139986,0),(29,10,104,'2015-11-10 17:33:37','2015-11-10 17:33:37',NULL,67,134000,0),(30,9,105,'2015-11-10 17:34:40','2015-11-10 17:34:40',NULL,56,124432,0),(31,10,106,'2015-11-10 17:41:44','2015-11-10 17:41:44',NULL,44,88000,0),(32,10,107,'2015-11-10 17:45:49','2015-11-10 17:45:49',NULL,44,88000,0),(33,9,108,'2015-11-10 17:47:11','2015-11-10 17:47:11',NULL,32,71104,0),(34,10,109,'2015-11-10 17:51:28','2015-11-10 17:51:28',NULL,22,44000,0),(35,10,110,'2015-11-10 17:53:00','2015-11-10 17:53:00',NULL,5,10000,0),(36,10,111,'2015-11-10 17:53:10','2015-11-10 17:53:10',NULL,5,10000,0),(37,9,112,'2015-11-10 18:04:06','2015-11-10 18:04:06',NULL,43,95546,0);

/*Table structure for table `ligne_bonsorie` */

DROP TABLE IF EXISTS `ligne_bonsorie`;

CREATE TABLE `ligne_bonsorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `bonSortie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E4D3BFF2F347EFB` (`produit_id`),
  KEY `IDX_E4D3BFF21B342D9B` (`bonSortie_id`),
  CONSTRAINT `FK_E4D3BFF21B342D9B` FOREIGN KEY (`bonSortie_id`) REFERENCES `bon_sortie` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_E4D3BFF2F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_bonsorie` */

insert  into `ligne_bonsorie`(`id`,`produit_id`,`quantite`,`createdDate`,`updatedDate`,`deletedDate`,`bonSortie_id`) values (1,10,318,'2015-11-07 18:18:54','2015-11-07 18:18:54',NULL,7),(2,10,318,'2015-11-07 18:19:59','2015-11-07 18:19:59',NULL,8),(3,10,500,'2015-11-07 18:21:09','2015-11-07 18:21:09',NULL,9),(4,9,160,'2015-11-07 18:21:09','2015-11-07 18:21:09',NULL,9),(5,10,500,'2015-11-07 18:39:33','2015-11-07 18:39:33',NULL,10),(6,10,500,'2015-11-07 18:44:26','2015-11-07 18:44:26',NULL,11),(7,10,400,'2015-11-09 21:49:33','2015-11-09 21:49:33',NULL,12);

/*Table structure for table `mareyeur` */

DROP TABLE IF EXISTS `mareyeur`;

CREATE TABLE `mareyeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `montantFinancement` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `mareyeur` */

insert  into `mareyeur`(`id`,`nom`,`adresse`,`telephone`,`montantFinancement`,`reference`) values (5,'Pape CISSE','Dakar','5459454','4384783','MR5'),(21,'Abdoulaye','Dakar','777777','','MR6');

/*Table structure for table `produit` */

DROP TABLE IF EXISTS `produit`;

CREATE TABLE `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `prixUnitaire` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `familleProduit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC272DDD2720` (`familleProduit_id`),
  CONSTRAINT `FK_29A5EC272DDD2720` FOREIGN KEY (`familleProduit_id`) REFERENCES `famille_produit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `produit` */

insert  into `produit`(`id`,`libelle`,`prixUnitaire`,`createdDate`,`updatedDate`,`deleteDate`,`familleProduit_id`) values (1,'prodtest','1299','2015-09-19 21:21:50','2015-09-19 21:21:50',NULL,1),(2,'Viande','2000',NULL,NULL,NULL,2),(3,'Poissons frais','3000',NULL,NULL,NULL,1),(4,'Dorade','2000','2015-10-09 18:34:45','2015-10-09 18:34:45',NULL,1),(5,'Poisson braise','3000','2015-10-09 18:36:29','2015-10-09 18:36:29',NULL,1),(6,'testppp','1600','2015-10-17 16:11:33','2015-10-17 16:11:33',NULL,1),(7,'vvr','1500','2015-10-17 16:59:40','2015-10-17 16:59:40',NULL,1),(8,'teee','1222','2015-10-17 20:52:57','2015-10-17 20:52:57',NULL,1),(9,'trtrt','2222','2015-10-17 20:54:52','2015-10-17 20:54:52',NULL,7),(10,'breww','2000','2015-10-17 21:15:55','2015-10-17 21:15:55',NULL,3);

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `profil` */

insert  into `profil`(`id`,`libelle`,`description`,`createdDate`,`updatedDate`,`deleteDate`) values (1,'admin','Administrateur','2015-09-20 00:00:00',NULL,NULL),(2,'magasinier','Magasinier',NULL,NULL,NULL),(3,'comptable','Comptable',NULL,NULL,NULL);

/*Table structure for table `stock` */

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `seuil` int(11) DEFAULT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B365660F347EFB` (`produit_id`),
  CONSTRAINT `FK_4B365660F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stock` */

insert  into `stock`(`id`,`produit_id`,`stock`,`seuil`,`codeUsine`,`login`,`createdDate`,`updatedDate`,`deleteDate`) values (1,9,2286,0,'usine_dakar','admin','2015-10-17 20:54:53','2015-10-17 20:54:53',NULL),(2,10,13635,0,'usine_dakar','admin','2015-10-17 21:15:56','2015-10-17 21:15:56',NULL);

/*Table structure for table `usine` */

DROP TABLE IF EXISTS `usine`;

CREATE TABLE `usine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nomUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `emplacement` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `typeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codePostal` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `couleur` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3AB48177153098` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usine` */

insert  into `usine`(`id`,`code`,`nomUsine`,`emplacement`,`typeUsine`,`telephone`,`fax`,`codePostal`,`createdDate`,`updatedDate`,`deleteDate`,`couleur`) values (1,'usine_dakar','Dakar','Dakar','usine',NULL,NULL,NULL,'2015-09-20 00:00:00',NULL,NULL,'#68BC31'),(2,'usine_rufisque','Rufisque','Rufisque','usine',NULL,NULL,NULL,NULL,NULL,NULL,'#2091CF');

/*Table structure for table `utilisateur` */

DROP TABLE IF EXISTS `utilisateur`;

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usine_id` int(11) DEFAULT NULL,
  `profil_id` int(11) DEFAULT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nomUtilisateur` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `etatCompte` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1D1C63B3C0130686` (`usine_id`),
  KEY `IDX_1D1C63B3275ED078` (`profil_id`),
  CONSTRAINT `FK_1D1C63B3275ED078` FOREIGN KEY (`profil_id`) REFERENCES `profil` (`id`),
  CONSTRAINT `FK_1D1C63B3C0130686` FOREIGN KEY (`usine_id`) REFERENCES `usine` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `utilisateur` */

insert  into `utilisateur`(`id`,`usine_id`,`profil_id`,`login`,`password`,`nomUtilisateur`,`status`,`etatCompte`,`createdDate`,`updatedDate`,`deleteDate`) values (1,1,1,'admin','passer','admin','1','1',NULL,NULL,NULL),(2,2,2,'matar','matar','Matar','1','1',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
