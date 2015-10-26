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
  PRIMARY KEY (`id`),
  KEY `IDX_26A98456C071508A` (`mareyeur_id`),
  CONSTRAINT `FK_26A98456C071508A` FOREIGN KEY (`mareyeur_id`) REFERENCES `mareyeur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `achat` */

insert  into `achat`(`id`,`numero`,`dateAchat`,`poidsTotal`,`montantTotal`,`modePaiement`,`numCheque`,`codeUsine`,`login`,`status`,`createdDate`,`updatedDate`,`deletedDate`,`mareyeur_id`) values (1,'','2015-10-17 15:15:59','270','6000','Esp','','usine_dakar','admin',1,NULL,NULL,NULL,NULL),(2,'4','2015-10-24 23:17:47','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(3,'6','2015-10-24 23:39:06','96','10000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(4,'7','2015-10-24 23:43:33','190','444000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(5,'5','2015-10-24 23:46:09','214.08','4444000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(6,'fgfgf','2015-10-24 23:55:12','2022.02','6666000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(7,'55','2015-10-24 23:57:17','2820','1200000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(8,'','2015-10-25 00:02:34','412.92','1110000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(9,'','2015-10-25 00:12:59','323.36','688000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(10,'fjdlfdjf','2015-10-25 00:20:37','2520','8686000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(11,'200','2015-10-25 00:23:30','285','600000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(12,'540','2015-10-25 00:25:51','288','60000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(13,'344','2015-10-25 13:05:01','323.19','200000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(14,'444','2015-10-25 13:07:03','1680','600000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(15,'895954','2015-10-25 13:10:23','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(16,'6000','2015-10-25 13:12:49','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(17,'50000','2015-10-25 13:15:26','1800','8000000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(18,'9854958','2015-10-25 13:16:21','270','40000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(19,'19333','2015-10-25 13:45:31','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(20,'19333','2015-10-25 13:46:19','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(21,'19333','2015-10-25 13:50:15','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(22,'19333','2015-10-25 13:50:52','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(23,'19333','2015-10-25 13:51:36','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(24,'19333','2015-10-25 13:53:45','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(25,'19333','2015-10-25 13:54:49','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(26,'19333','2015-10-25 13:56:04','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(27,'19333','2015-10-25 13:57:27','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(28,'19333','2015-10-25 13:57:53','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(29,'19333','2015-10-25 13:58:42','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(30,'19333','2015-10-25 14:00:43','282','488000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(31,'4545','2015-10-25 14:01:24','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(32,'4545','2015-10-25 14:08:14','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(33,'4545','2015-10-25 14:15:14','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(34,'4545','2015-10-25 14:16:03','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(35,'4545','2015-10-25 14:16:23','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(36,'4545','2015-10-25 14:17:31','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(37,'4545','2015-10-25 14:17:50','','','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(38,'6494','2015-10-25 14:26:36','180','240000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(39,'6494','2015-10-25 14:32:20','180','240000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(40,'6494','2015-10-25 14:37:00','180','240000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(41,'6494','2015-10-25 14:37:36','180','240000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(42,'6494','2015-10-25 14:38:40','180','240000','Esp','','usine_dakar','admin',0,NULL,NULL,NULL,NULL),(43,'6777','2015-10-25 14:48:46','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:48:46','2015-10-25 14:48:46',NULL,NULL),(44,'6777','2015-10-25 14:49:17','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:49:17','2015-10-25 14:49:17',NULL,NULL),(45,'6777','2015-10-25 14:50:49','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:50:49','2015-10-25 14:50:49',NULL,NULL),(46,'6777','2015-10-25 14:52:02','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:52:02','2015-10-25 14:52:02',NULL,NULL),(47,'6777','2015-10-25 14:54:13','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:54:13','2015-10-25 14:54:13',NULL,NULL),(48,'6777','2015-10-25 14:54:52','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:54:52','2015-10-25 14:54:52',NULL,NULL),(49,'6777','2015-10-25 14:54:56','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:54:56','2015-10-25 14:54:56',NULL,NULL),(50,'6777','2015-10-25 14:55:47','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:55:47','2015-10-25 14:55:47',NULL,NULL),(51,'6777','2015-10-25 14:56:26','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:56:26','2015-10-25 14:56:26',NULL,NULL),(52,'6777','2015-10-25 14:56:53','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:56:53','2015-10-25 14:56:53',NULL,NULL),(53,'6777','2015-10-25 14:57:26','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:57:26','2015-10-25 14:57:26',NULL,NULL),(54,'6777','2015-10-25 14:59:58','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 14:59:58','2015-10-25 14:59:58',NULL,NULL),(55,'6777','2015-10-25 15:03:15','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 15:03:15','2015-10-25 15:03:15',NULL,NULL),(56,'6777','2015-10-25 15:04:04','1600','3200000','Esp','','usine_dakar','admin',0,'2015-10-25 15:04:04','2015-10-25 15:04:04',NULL,NULL),(57,'908','2015-10-25 15:24:56','2700','5400000','Esp','','usine_dakar','admin',0,'2015-10-25 15:24:56','2015-10-25 15:24:56',NULL,NULL),(58,'908','2015-10-25 15:26:06','2700','5400000','Esp','','usine_dakar','admin',0,'2015-10-25 15:26:06','2015-10-25 15:26:06',NULL,NULL),(59,'4555','2015-10-25 15:28:36','1800','6000000','Esp','','usine_dakar','admin',0,'2015-10-25 15:28:36','2015-10-25 15:28:36',NULL,NULL),(60,'4555','2015-10-25 15:31:27','1800','6000000','Esp','','usine_dakar','admin',0,'2015-10-25 15:31:27','2015-10-25 15:31:27',NULL,NULL),(61,'4545','2015-10-25 16:53:12','5099.4','1000000','Esp','','usine_dakar','admin',0,'2015-10-25 16:53:12','2015-10-25 16:53:12',NULL,NULL),(62,'4545','2015-10-25 16:54:38','5099.4','1000000','Esp','','usine_dakar','admin',0,'2015-10-25 16:54:38','2015-10-25 16:54:38',NULL,5),(63,'1233','2015-10-25 17:56:51','1080','4444000','Esp','','usine_dakar','admin',0,'2015-10-25 17:56:52','2015-10-25 17:56:52',NULL,5);

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

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `client` */

insert  into `client`(`id`,`nom`,`adresse`,`telephone`) values (1,'test','ssss','');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_achat` */

insert  into `ligne_achat`(`id`,`produit_id`,`achat_id`,`createdDate`,`updatedDate`,`deletedDate`,`quantite`,`montant`,`poids`) values (9,10,56,'2015-10-25 15:04:05','2015-10-25 15:04:05',NULL,1600,3200000,1600),(10,10,57,'2015-10-25 15:24:56','2015-10-25 15:24:56',NULL,2700,5400000,2700),(11,10,58,'2015-10-25 15:26:06','2015-10-25 15:26:06',NULL,2700,5400000,2700),(12,10,59,'2015-10-25 15:28:37','2015-10-25 15:28:37',NULL,3000,6000000,1800),(13,10,60,'2015-10-25 15:31:27','2015-10-25 15:31:27',NULL,3000,6000000,1800),(14,10,61,'2015-10-25 16:53:12','2015-10-25 16:53:12',NULL,500,1000000,5099),(15,10,62,'2015-10-25 16:54:39','2015-10-25 16:54:39',NULL,500,1000000,5099),(16,9,63,'2015-10-25 17:56:52','2015-10-25 17:56:52',NULL,2000,4444000,1080);

/*Table structure for table `mareyeur` */

DROP TABLE IF EXISTS `mareyeur`;

CREATE TABLE `mareyeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `montantFinancement` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `mareyeur` */

insert  into `mareyeur`(`id`,`nom`,`adresse`,`telephone`,`montantFinancement`) values (5,'jojotest','jojo','5459454','4384783'),(9,'kjgk','jfkdjfdk','r9895','2222'),(18,'kfk','kk','fkdf','4343'),(19,'fdjk','kdfjdk','043430','3000'),(20,'kfj','dfjd','fdj','033');

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

insert  into `stock`(`id`,`produit_id`,`stock`,`seuil`,`codeUsine`,`login`,`createdDate`,`updatedDate`,`deleteDate`) values (1,9,1080,0,'usine_dakar','admin','2015-10-17 20:54:53','2015-10-17 20:54:53',NULL),(2,10,13798,0,'usine_dakar','admin','2015-10-17 21:15:56','2015-10-17 21:15:56',NULL);

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

insert  into `utilisateur`(`id`,`usine_id`,`profil_id`,`login`,`password`,`nomUtilisateur`,`status`,`etatCompte`,`createdDate`,`updatedDate`,`deleteDate`) values (1,1,1,'admin','admin','admin','1','1',NULL,NULL,NULL),(2,2,2,'matar','matar','Matar','1','1',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
