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
  `mareyeur_id` int(11) DEFAULT NULL,
  `numero` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dateAchat` datetime DEFAULT NULL,
  `heureReception` time DEFAULT NULL,
  `poidsTotal` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `montantTotal` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `modePaiement` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `numCheque` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `regle` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_26A98456C071508A` (`mareyeur_id`),
  CONSTRAINT `FK_26A98456C071508A` FOREIGN KEY (`mareyeur_id`) REFERENCES `mareyeur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `achat` */

LOCK TABLES `achat` WRITE;

insert  into `achat`(`id`,`mareyeur_id`,`numero`,`dateAchat`,`heureReception`,`poidsTotal`,`montantTotal`,`modePaiement`,`numCheque`,`codeUsine`,`login`,`status`,`regle`,`createdDate`,`updatedDate`,`deletedDate`) values (1,21,'00001','2015-11-23 23:15:49','08:00:00','46','26664','Esp','','usine_dakar','admin',0,0,'2015-11-23 23:15:49','2015-11-23 23:15:49',NULL),(2,5,'00002','2015-11-23 23:49:56','08:00:00','50','104440','Esp','','usine_dakar','admin',0,0,'2015-11-23 23:49:56','2015-11-23 23:49:56',NULL);

UNLOCK TABLES;

/*Table structure for table `achat_paiement` */

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

LOCK TABLES `achat_paiement` WRITE;

UNLOCK TABLES;

/*Table structure for table `bon_sortie` */

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `bon_sortie` */

LOCK TABLES `bon_sortie` WRITE;

insert  into `bon_sortie`(`id`,`client_id`,`numeroBonSortie`,`dateBonSortie`,`numeroContainer`,`numeroPlomb`,`numeroCamion`,`nomChauffeur`,`origine`,`destination`,`codeUsine`,`login`,`status`,`createdDate`,`updatedDate`,`deletedDate`,`poidsTotal`) values (21,1,'00001','2015-11-23 15:29:20','','','','','Usine','Dakar','usine_dakar','admin',1,NULL,NULL,NULL,'20'),(22,2,'00022','2015-11-23 15:29:49','','','','','Dakar','Dakar','usine_dakar','admin',1,NULL,NULL,NULL,'100'),(23,1,'00023','2015-11-23 22:57:02','23','1','2','PAPE','Rufisque','Dakar','usine_dakar','admin',1,NULL,NULL,NULL,'54'),(24,1,'00024','2015-11-23 22:58:29','87','7','9','6','Usine','Dakar','usine_dakar','admin',1,NULL,NULL,NULL,'100'),(25,1,'00024','2015-11-23 22:58:30','87','7','9','6','Usine','Dakar','usine_dakar','admin',1,NULL,NULL,NULL,'100');

UNLOCK TABLES;

/*Table structure for table `client` */

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `client` */

LOCK TABLES `client` WRITE;

insert  into `client`(`id`,`nom`,`adresse`,`telephone`,`reference`) values (1,'Demba BA','DAKAR','7777777',''),(2,'Alpha NDOYE','RUFISQUE','777777','');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `conteneur` */

LOCK TABLES `conteneur` WRITE;

UNLOCK TABLES;

/*Table structure for table `facture` */

CREATE TABLE `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bonsortie_id` int(11) DEFAULT NULL,
  `numero` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dateFacture` datetime DEFAULT NULL,
  `heureFacture` time DEFAULT NULL,
  `devise` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `portDechargement` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `montantHt` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `montantTtc` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `modePaiement` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numCheque` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avance` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reliquat` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE86641099C5AF38` (`bonsortie_id`),
  CONSTRAINT `FK_FE86641099C5AF38` FOREIGN KEY (`bonsortie_id`) REFERENCES `bon_sortie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `facture` */

LOCK TABLES `facture` WRITE;

UNLOCK TABLES;

/*Table structure for table `famille_produit` */

CREATE TABLE `famille_produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `famille_produit` */

LOCK TABLES `famille_produit` WRITE;

insert  into `famille_produit`(`id`,`libelle`,`createdDate`,`updatedDate`,`deleteDate`) values (1,'test','2015-09-19 13:59:28','2015-09-19 13:59:28',NULL),(2,'Viande','2015-09-19 14:00:55','2015-09-19 18:50:18',NULL),(3,'msd555','2015-09-19 14:01:13','2015-09-19 18:50:00',NULL),(6,'ddfd','2015-09-19 18:37:22','2015-09-19 18:37:22',NULL),(7,'fdfd','2015-09-19 18:40:16','2015-09-19 18:40:16',NULL),(8,'fl','2015-09-20 13:28:40','2015-09-20 13:28:40',NULL),(9,'nest','2015-09-28 10:55:15','2015-09-28 10:55:15',NULL),(10,'montest','2015-10-17 16:44:08','2015-10-17 16:44:08',NULL);

UNLOCK TABLES;

/*Table structure for table `fournisseur` */

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `fournisseur` */

LOCK TABLES `fournisseur` WRITE;

UNLOCK TABLES;

/*Table structure for table `ligne_achat` */

CREATE TABLE `ligne_achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `achat_id` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `poids` int(11) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_25056E66F347EFB` (`produit_id`),
  KEY `IDX_25056E66FE95D117` (`achat_id`),
  CONSTRAINT `FK_25056E66F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_25056E66FE95D117` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_achat` */

LOCK TABLES `ligne_achat` WRITE;

insert  into `ligne_achat`(`id`,`produit_id`,`achat_id`,`quantite`,`poids`,`montant`,`createdDate`,`updatedDate`,`deletedDate`) values (1,9,1,8,NULL,26664,'2015-11-23 23:15:50','2015-11-23 23:15:50',NULL),(2,NULL,1,34,NULL,40,'2015-11-23 23:15:50','2015-11-23 23:15:50',NULL),(3,9,2,20,NULL,44440,'2015-11-23 23:49:56','2015-11-23 23:49:56',NULL),(4,10,2,30,NULL,60000,'2015-11-23 23:49:56','2015-11-23 23:49:56',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_bonsortie` */

LOCK TABLES `ligne_bonsortie` WRITE;

insert  into `ligne_bonsortie`(`id`,`produit_id`,`quantite`,`createdDate`,`updatedDate`,`deletedDate`,`bonSortie_id`) values (4,9,20,'2015-11-23 15:29:21','2015-11-23 15:29:21',NULL,21),(5,10,1000,'2015-11-23 15:29:49','2015-11-23 15:29:49',NULL,22),(6,NULL,54,'2015-11-23 22:57:02','2015-11-23 22:57:02',NULL,23),(7,9,50,'2015-11-23 22:58:29','2015-11-23 22:58:29',NULL,24),(8,10,20,'2015-11-23 22:58:29','2015-11-23 22:58:29',NULL,24),(9,10,30,'2015-11-23 22:58:30','2015-11-23 22:58:30',NULL,24),(10,9,50,'2015-11-23 22:58:30','2015-11-23 22:58:30',NULL,25),(11,10,20,'2015-11-23 22:58:30','2015-11-23 22:58:30',NULL,25),(12,10,30,'2015-11-23 22:58:30','2015-11-23 22:58:30',NULL,25);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `mareyeur` */

LOCK TABLES `mareyeur` WRITE;

insert  into `mareyeur`(`id`,`nom`,`adresse`,`telephone`,`montantFinancement`,`reference`) values (5,'Pape CISSE','Dakar','5459454','4384783','MR5'),(21,'Abdoulaye','Dakar','777777','','MR6'),(22,'','','','','MR22');

UNLOCK TABLES;

/*Table structure for table `produit` */

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

LOCK TABLES `produit` WRITE;

insert  into `produit`(`id`,`libelle`,`prixUnitaire`,`createdDate`,`updatedDate`,`deleteDate`,`familleProduit_id`) values (9,'Sole','2222','2015-10-17 20:54:52','2015-11-20 23:02:30',NULL,7),(10,'Sompate','2000','2015-10-17 21:15:55','2015-11-20 23:02:28',NULL,3);

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

/*Table structure for table `stock` */

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

LOCK TABLES `stock` WRITE;

insert  into `stock`(`id`,`produit_id`,`stock`,`seuil`,`codeUsine`,`login`,`createdDate`,`updatedDate`,`deleteDate`) values (1,9,1860,0,'usine_dakar','admin','2015-10-17 20:54:53','2015-10-17 20:54:53',NULL),(2,10,12309,0,'usine_dakar','admin','2015-10-17 21:15:56','2015-10-17 21:15:56',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usine` */

LOCK TABLES `usine` WRITE;

insert  into `usine`(`id`,`code`,`nomUsine`,`emplacement`,`typeUsine`,`telephone`,`fax`,`codePostal`,`createdDate`,`updatedDate`,`deleteDate`,`couleur`) values (1,'usine_dakar','Dakar','Dakar','usine',NULL,NULL,NULL,'2015-09-20 00:00:00',NULL,NULL,'#68BC31'),(2,'usine_rufisque','Rufisque','Rufisque','usine',NULL,NULL,NULL,NULL,NULL,NULL,'#2091CF');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `utilisateur` */

LOCK TABLES `utilisateur` WRITE;

insert  into `utilisateur`(`id`,`usine_id`,`profil_id`,`login`,`password`,`nomUtilisateur`,`status`,`etatCompte`,`createdDate`,`updatedDate`,`deleteDate`) values (1,1,1,'admin','admin','admin','1','1',NULL,NULL,NULL),(2,2,2,'matar','matar','Matar','1','1',NULL,NULL,NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
