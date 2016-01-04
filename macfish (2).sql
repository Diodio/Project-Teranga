/*
SQLyog Community v10.51 
MySQL - 5.1.26-rc-community : Database - macfish
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

CREATE TABLE `achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dateAchat` datetime DEFAULT NULL,
  `poidsTotal` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `montantTotal` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `modePaiement` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `numCheque` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `mareyeur_id` int(11) DEFAULT NULL,
  `heureReception` time DEFAULT NULL,
  `regle` int(11) NOT NULL DEFAULT '0',
  `reliquat` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_26A98456C071508A` (`mareyeur_id`),
  CONSTRAINT `FK_26A98456C071508A` FOREIGN KEY (`mareyeur_id`) REFERENCES `mareyeur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `achat` */

LOCK TABLES `achat` WRITE;

insert  into `achat`(`id`,`numero`,`dateAchat`,`poidsTotal`,`montantTotal`,`modePaiement`,`numCheque`,`codeUsine`,`login`,`status`,`createdDate`,`updatedDate`,`deletedDate`,`mareyeur_id`,`heureReception`,`regle`,`reliquat`) values (193,'00001','2015-12-28 20:12:35','200','40000','ch','290333844','usine_dakar','admin',0,'2015-12-28 20:12:35','2015-12-28 20:12:35',NULL,NULL,'08:00:00',1,'10000'),(194,'00194','2015-12-28 21:42:51','200','200000','ch','289900000','usine_dakar','admin',1,'2015-12-28 21:42:51','2015-12-28 21:42:51',NULL,32,'08:00:00',1,'150000'),(195,'00195','2015-12-28 23:02:14','500','150000','Esp','','usine_dakar','admin',1,'2015-12-28 23:02:14','2015-12-28 23:02:14',NULL,32,'08:00:00',0,NULL);

UNLOCK TABLES;

/*Table structure for table `bon_sortie` */

CREATE TABLE `bon_sortie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `bon_sortie` */

LOCK TABLES `bon_sortie` WRITE;

UNLOCK TABLES;

/*Table structure for table `carton` */

CREATE TABLE `carton` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demoulage_id` int(11) DEFAULT NULL,
  `nombreCarton` int(11) NOT NULL,
  `quantiteParCarton` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `produitId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_41511106325BF03` (`demoulage_id`),
  CONSTRAINT `FK_41511106325BF03` FOREIGN KEY (`demoulage_id`) REFERENCES `demoulage` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `carton` */

LOCK TABLES `carton` WRITE;

insert  into `carton`(`id`,`demoulage_id`,`nombreCarton`,`quantiteParCarton`,`total`,`status`,`createdDate`,`updatedDate`,`deletedDate`,`produitId`) values (1,1,3,10,100,0,'2015-12-28 22:00:49','2015-12-28 22:00:49',NULL,49),(2,1,1,20,60,0,'2015-12-28 22:00:49','2015-12-28 22:00:49',NULL,49),(3,1,3,4,40,0,'2015-12-28 22:00:49','2015-12-28 22:00:49',NULL,49),(4,2,5,60,600,0,'2015-12-28 23:32:04','2015-12-28 23:32:04',NULL,50),(5,2,5,9,90,0,'2015-12-28 23:32:04','2015-12-28 23:32:04',NULL,50);

UNLOCK TABLES;

/*Table structure for table `client` */

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `client` */

LOCK TABLES `client` WRITE;

insert  into `client`(`id`,`nom`,`adresse`,`telephone`,`reference`,`pays`) values (1,'Sea Bluie','Paris','+3356788899','CLI1','France');

UNLOCK TABLES;

/*Table structure for table `conteneur` */

CREATE TABLE `conteneur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facture_id` int(11) DEFAULT NULL,
  `numConteneur` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numPlomb` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E9628FD27F2DEE08` (`facture_id`),
  CONSTRAINT `FK_E9628FD27F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `conteneur` */

LOCK TABLES `conteneur` WRITE;

insert  into `conteneur`(`id`,`facture_id`,`numConteneur`,`numPlomb`) values (1,1,'54','98'),(2,2,'76','09'),(3,3,'76','9'),(4,4,'76','9');

UNLOCK TABLES;

/*Table structure for table `conteneur_temp` */

CREATE TABLE `conteneur_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facture` int(11) DEFAULT NULL,
  `numConteneur` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numPlomb` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `conteneur_temp` */

LOCK TABLES `conteneur_temp` WRITE;

insert  into `conteneur_temp`(`id`,`facture`,`numConteneur`,`numPlomb`) values (1,1,'28','80'),(2,3,'75','98'),(3,4,'5689','I86');

UNLOCK TABLES;

/*Table structure for table `demoulage` */

CREATE TABLE `demoulage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_72FD14D7F347EFB` (`produit_id`),
  CONSTRAINT `FK_72FD14D7F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `demoulage` */

LOCK TABLES `demoulage` WRITE;

insert  into `demoulage`(`id`,`produit_id`,`createdDate`,`updatedDate`,`deletedDate`,`codeUsine`,`login`) values (1,49,'2015-12-28 22:00:49','2015-12-28 22:00:49',NULL,'usine_dakar','admin'),(2,50,'2015-12-28 23:32:04','2015-12-28 23:32:04',NULL,'usine_dakar','admin');

UNLOCK TABLES;

/*Table structure for table `facture` */

CREATE TABLE `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `numero` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dateFacture` datetime DEFAULT NULL,
  `heureFacture` time DEFAULT NULL,
  `devise` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `portDechargement` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbTotalColis` int(11) DEFAULT NULL,
  `nbTotalPoids` int(11) DEFAULT NULL,
  `montantHt` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `montantTtc` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `modePaiement` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numCheque` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avance` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reliquat` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `regle` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE86641019EB6921` (`client_id`),
  CONSTRAINT `FK_FE86641019EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `facture` */

LOCK TABLES `facture` WRITE;

insert  into `facture`(`id`,`client_id`,`numero`,`dateFacture`,`heureFacture`,`devise`,`portDechargement`,`nbTotalColis`,`nbTotalPoids`,`montantHt`,`montantTtc`,`modePaiement`,`numCheque`,`avance`,`reliquat`,`codeUsine`,`login`,`status`,`regle`,`createdDate`,`updatedDate`,`deletedDate`) values (1,1,'00001','2015-12-28 22:52:11','22:16:00','€','24565',11,90,'18000','18000','Esp','','10000','8000','usine_dakar','admin',1,1,NULL,NULL,NULL),(2,1,'00002','2015-12-28 23:34:57','23:32:00','€','56',15,93,'81000','81000','Esp','','70000','11000','usine_dakar','admin',1,1,NULL,NULL,NULL),(3,1,'00003','2015-12-29 13:58:58','13:54:00','€','69',6,32,'21200','21200','Esp','','10000','11200','usine_dakar','admin',1,1,NULL,NULL,NULL),(4,1,'00003','2015-12-29 13:59:04','13:54:00','€','69',6,32,'21200','21200','Esp','','10000','11200','usine_dakar','admin',1,1,NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `facture_temp` */

CREATE TABLE `facture_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dateFacture` datetime DEFAULT NULL,
  `heureFacture` time DEFAULT NULL,
  `devise` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `portDechargement` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbTotalColis` int(11) DEFAULT NULL,
  `nbTotalPoids` int(11) DEFAULT NULL,
  `montantHt` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `montantTtc` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `modePaiement` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numCheque` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avance` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reliquat` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `regle` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `conteneur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `facture_temp` */

LOCK TABLES `facture_temp` WRITE;

insert  into `facture_temp`(`id`,`numero`,`dateFacture`,`heureFacture`,`devise`,`portDechargement`,`nbTotalColis`,`nbTotalPoids`,`montantHt`,`montantTtc`,`modePaiement`,`numCheque`,`avance`,`reliquat`,`codeUsine`,`login`,`status`,`regle`,`createdDate`,`updatedDate`,`deletedDate`,`client`,`conteneur`) values (1,'00005','2015-12-29 14:01:02','13:59:00','€','29',5,32,'50000','50000','Esp','','30000','20000','usine_dakar','admin',1,0,NULL,NULL,NULL,1,NULL),(2,'00005','2015-12-29 14:08:50','14:07:00','€','98',3,12,'1308','1308','Esp','','876','432','usine_dakar','admin',1,0,NULL,NULL,NULL,1,NULL),(3,'00005','2015-12-29 14:33:51','14:32:00','€','89',1,4,'8000','8000','Esp','','','860','usine_dakar','admin',1,0,NULL,NULL,NULL,1,NULL),(4,'00005','2015-12-29 14:38:08','14:36:00','€','677',1,4,'93736','93736','Esp','','458','93278','usine_dakar','admin',1,0,NULL,NULL,NULL,1,NULL);

UNLOCK TABLES;

/*Table structure for table `ligne_achat` */

CREATE TABLE `ligne_achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `achat_id` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `prixUnitaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_25056E66F347EFB` (`produit_id`),
  KEY `IDX_25056E66FE95D117` (`achat_id`),
  CONSTRAINT `FK_25056E66F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_25056E66FE95D117` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_achat` */

LOCK TABLES `ligne_achat` WRITE;

insert  into `ligne_achat`(`id`,`produit_id`,`achat_id`,`createdDate`,`updatedDate`,`deletedDate`,`quantite`,`montant`,`prixUnitaire`) values (1,49,194,'2015-12-28 21:42:52','2015-12-28 21:42:52',NULL,200,200000,1000),(2,50,195,'2015-12-28 23:02:14','2015-12-28 23:02:14',NULL,500,150000,300);

UNLOCK TABLES;

/*Table structure for table `ligne_bonsortie` */

CREATE TABLE `ligne_bonsortie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `bonSortie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C645FAF347EFB` (`produit_id`),
  KEY `IDX_4C645FA1B342D9B` (`bonSortie_id`),
  CONSTRAINT `FK_4C645FA1B342D9B` FOREIGN KEY (`bonSortie_id`) REFERENCES `bon_sortie` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4C645FAF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_bonsortie` */

LOCK TABLES `ligne_bonsortie` WRITE;

UNLOCK TABLES;

/*Table structure for table `ligne_colis` */

CREATE TABLE `ligne_colis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCarton` int(11) NOT NULL,
  `quantiteParCarton` int(11) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `produitId` int(11) NOT NULL,
  `factureId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_colis` */

LOCK TABLES `ligne_colis` WRITE;

insert  into `ligne_colis`(`id`,`nombreCarton`,`quantiteParCarton`,`createdDate`,`updatedDate`,`deletedDate`,`produitId`,`factureId`) values (1,5,4,'2015-12-28 22:52:11','2015-12-28 22:52:11',NULL,49,1),(2,5,10,'2015-12-28 22:52:11','2015-12-28 22:52:11',NULL,49,1),(3,1,20,'2015-12-28 22:52:11','2015-12-28 22:52:11',NULL,49,1),(4,1,20,'2015-12-28 23:34:58','2015-12-28 23:34:58',NULL,49,2),(5,2,4,'2015-12-28 23:34:58','2015-12-28 23:34:58',NULL,49,2),(6,2,10,'2015-12-28 23:34:58','2015-12-28 23:34:58',NULL,49,2),(7,5,9,'2015-12-28 23:34:58','2015-12-28 23:34:58',NULL,50,2),(8,5,60,'2015-12-28 23:34:58','2015-12-28 23:34:58',NULL,50,2);

UNLOCK TABLES;

/*Table structure for table `ligne_colis_temp` */

CREATE TABLE `ligne_colis_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCarton` int(11) NOT NULL,
  `quantiteParCarton` int(11) NOT NULL,
  `produitId` int(11) NOT NULL,
  `factureId` int(11) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_colis_temp` */

LOCK TABLES `ligne_colis_temp` WRITE;

insert  into `ligne_colis_temp`(`id`,`nombreCarton`,`quantiteParCarton`,`produitId`,`factureId`,`createdDate`,`updatedDate`,`deletedDate`) values (1,1,4,49,1,'2015-12-29 14:01:03','2015-12-29 14:01:03',NULL),(2,1,10,49,1,'2015-12-29 14:01:03','2015-12-29 14:01:03',NULL),(3,2,9,50,1,'2015-12-29 14:01:03','2015-12-29 14:01:03',NULL),(4,1,60,50,1,'2015-12-29 14:01:03','2015-12-29 14:01:03',NULL),(5,3,4,49,2,'2015-12-29 14:08:51','2015-12-29 14:08:51',NULL),(6,1,4,49,3,'2015-12-29 14:33:51','2015-12-29 14:33:51',NULL),(7,1,4,49,4,'2015-12-29 14:38:08','2015-12-29 14:38:08',NULL);

UNLOCK TABLES;

/*Table structure for table `ligne_facture` */

CREATE TABLE `ligne_facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facture_id` int(11) DEFAULT NULL,
  `nbColis` int(11) DEFAULT NULL,
  `prixUnitaire` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `produit` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_611F5A297F2DEE08` (`facture_id`),
  CONSTRAINT `FK_611F5A297F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_facture` */

LOCK TABLES `ligne_facture` WRITE;

insert  into `ligne_facture`(`id`,`facture_id`,`nbColis`,`prixUnitaire`,`quantite`,`montant`,`produit`,`createdDate`,`updatedDate`,`deletedDate`) values (1,1,11,200,90,18000,49,'2015-12-28 22:52:11','2015-12-28 22:52:11',NULL),(2,2,5,750,48,36000,49,'2015-12-28 23:34:57','2015-12-28 23:34:57',NULL),(3,2,10,1000,45,45000,50,'2015-12-28 23:34:57','2015-12-28 23:34:57',NULL),(4,3,2,1000,14,14000,49,'2015-12-29 13:58:58','2015-12-29 13:58:58',NULL),(5,3,4,400,18,7200,50,'2015-12-29 13:58:59','2015-12-29 13:58:59',NULL),(6,4,2,1000,14,14000,49,'2015-12-29 13:59:04','2015-12-29 13:59:04',NULL),(7,4,4,400,18,7200,50,'2015-12-29 13:59:04','2015-12-29 13:59:04',NULL);

UNLOCK TABLES;

/*Table structure for table `ligne_facture_temp` */

CREATE TABLE `ligne_facture_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nbColis` int(11) DEFAULT NULL,
  `prixUnitaire` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `produit` int(11) DEFAULT NULL,
  `facture` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_facture_temp` */

LOCK TABLES `ligne_facture_temp` WRITE;

insert  into `ligne_facture_temp`(`id`,`nbColis`,`prixUnitaire`,`quantite`,`montant`,`produit`,`facture`,`createdDate`,`updatedDate`,`deletedDate`) values (1,2,1000,14,14000,49,1,'2015-12-29 14:01:02','2015-12-29 14:01:02',NULL),(2,3,2000,18,36000,50,1,'2015-12-29 14:01:02','2015-12-29 14:01:02',NULL),(3,3,109,12,1308,49,2,'2015-12-29 14:08:51','2015-12-29 14:08:51',NULL),(4,1,2000,4,8000,49,3,'2015-12-29 14:33:51','2015-12-29 14:33:51',NULL),(5,1,23434,4,93736,49,4,'2015-12-29 14:38:08','2015-12-29 14:38:08',NULL);

UNLOCK TABLES;

/*Table structure for table `mareyeur` */

CREATE TABLE `mareyeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `montantFinancement` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `mareyeur` */

LOCK TABLES `mareyeur` WRITE;

insert  into `mareyeur`(`id`,`nom`,`adresse`,`telephone`,`montantFinancement`,`reference`) values (32,'Fatou Diop','Kayar','775242729','','MR1');

UNLOCK TABLES;

/*Table structure for table `produit` */

CREATE TABLE `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_29A5EC27A4D60759` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `produit` */

LOCK TABLES `produit` WRITE;

insert  into `produit`(`id`,`libelle`,`createdDate`,`updatedDate`,`deleteDate`) values (49,'Ombrine GM','2015-12-28 21:41:27','2015-12-28 21:41:27',NULL),(50,'Rouget GM','2015-12-28 23:01:16','2015-12-28 23:01:16',NULL);

UNLOCK TABLES;

/*Table structure for table `profil` */

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

LOCK TABLES `profil` WRITE;

insert  into `profil`(`id`,`libelle`,`description`,`createdDate`,`updatedDate`,`deleteDate`) values (1,'admin','Administrateur','2015-09-20 00:00:00',NULL,NULL),(2,'magasinier','Magasinier',NULL,NULL,NULL),(3,'comptable','Comptable',NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `reglement_achat` */

CREATE TABLE `reglement_achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `achat_id` int(11) DEFAULT NULL,
  `datePaiement` datetime DEFAULT NULL,
  `avance` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FCD48A98FE95D117` (`achat_id`),
  CONSTRAINT `FK_FCD48A98FE95D117` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `reglement_achat` */

LOCK TABLES `reglement_achat` WRITE;

insert  into `reglement_achat`(`id`,`achat_id`,`datePaiement`,`avance`,`createdDate`,`updatedDate`,`deletedDate`) values (9,193,'2015-12-28 20:12:35','30000','2015-12-28 20:12:35','2015-12-28 20:12:35',NULL),(10,194,'2015-12-28 21:42:51','50000','2015-12-28 21:42:51','2015-12-28 21:42:51',NULL);

UNLOCK TABLES;

/*Table structure for table `reglement_facture` */

CREATE TABLE `reglement_facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facture_id` int(11) DEFAULT NULL,
  `datePaiement` datetime DEFAULT NULL,
  `avance` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C4769AA7F2DEE08` (`facture_id`),
  CONSTRAINT `FK_4C4769AA7F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `reglement_facture` */

LOCK TABLES `reglement_facture` WRITE;

insert  into `reglement_facture`(`id`,`facture_id`,`datePaiement`,`avance`,`createdDate`,`updatedDate`,`deletedDate`) values (1,1,'2015-12-28 22:52:11','10000','2015-12-28 22:52:11','2015-12-28 22:52:11',NULL),(2,2,'2015-12-28 23:34:57','70000','2015-12-28 23:34:57','2015-12-28 23:34:57',NULL),(3,3,'2015-12-29 13:58:58','10000','2015-12-29 13:58:58','2015-12-29 13:58:58',NULL),(4,4,'2015-12-29 13:59:04','10000','2015-12-29 13:59:04','2015-12-29 13:59:04',NULL);

UNLOCK TABLES;

/*Table structure for table `stock_provisoire` */

CREATE TABLE `stock_provisoire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_76B7FBC3F347EFB` (`produit_id`),
  CONSTRAINT `FK_76B7FBC3F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stock_provisoire` */

LOCK TABLES `stock_provisoire` WRITE;

insert  into `stock_provisoire`(`id`,`produit_id`,`stock`,`codeUsine`,`login`,`createdDate`,`updatedDate`,`deleteDate`) values (1,49,0,'usine_dakar','admin','2015-12-28 21:41:27','2015-12-28 21:41:27',NULL),(2,50,0,'usine_dakar','admin','2015-12-28 23:01:16','2015-12-28 23:01:16',NULL);

UNLOCK TABLES;

/*Table structure for table `stock_reel` */

CREATE TABLE `stock_reel` (
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
  KEY `IDX_EBFA5495F347EFB` (`produit_id`),
  CONSTRAINT `FK_EBFA5495F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stock_reel` */

LOCK TABLES `stock_reel` WRITE;

insert  into `stock_reel`(`id`,`produit_id`,`stock`,`seuil`,`codeUsine`,`login`,`createdDate`,`updatedDate`,`deleteDate`) values (20,49,234,0,'usine_dakar','admin','2015-12-28 21:41:27','2015-12-28 21:41:27',NULL),(21,50,659,0,'usine_dakar','admin','2015-12-28 23:01:16','2015-12-28 23:01:16',NULL);

UNLOCK TABLES;

/*Table structure for table `usine` */

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usine` */

LOCK TABLES `usine` WRITE;

insert  into `usine`(`id`,`code`,`nomUsine`,`emplacement`,`typeUsine`,`telephone`,`fax`,`codePostal`,`createdDate`,`updatedDate`,`deleteDate`,`couleur`) values (1,'usine_dakar','Dakar','Dakar','usine',NULL,NULL,NULL,'2015-09-20 00:00:00',NULL,NULL,'#68BC31'),(2,'usine_rufisque','Rufisque','Rufisque','usine',NULL,NULL,NULL,NULL,NULL,NULL,'#2091CF'),(3,'usine_stlouis','St Louis','St Louis','usine',NULL,NULL,NULL,'2015-12-10 15:17:01',NULL,NULL,'#FFFF00');

UNLOCK TABLES;

/*Table structure for table `utilisateur` */

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `utilisateur` */

LOCK TABLES `utilisateur` WRITE;

insert  into `utilisateur`(`id`,`usine_id`,`profil_id`,`login`,`password`,`nomUtilisateur`,`status`,`etatCompte`,`createdDate`,`updatedDate`,`deleteDate`) values (1,1,1,'admin','admin','admin','1','1',NULL,NULL,NULL),(2,2,2,'rufisque','rufisque','Diodio','1','1',NULL,NULL,NULL),(3,3,1,'stlouis','stlouis','Abdou','1','1',NULL,NULL,NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
