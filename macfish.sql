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
  `numero` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateAchat` datetime DEFAULT NULL,
  `poidsTotal` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `montantTotal` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `modePaiement` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numCheque` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeUsine` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `mareyeur_id` int(11) DEFAULT NULL,
  `heureReception` time DEFAULT NULL,
  `regle` int(11) NOT NULL DEFAULT '0',
  `reliquat` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_26A98456C071508A` (`mareyeur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `achat` */

LOCK TABLES `achat` WRITE;

UNLOCK TABLES;

/*Table structure for table `bon_sortie` */

CREATE TABLE `bon_sortie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `numeroBonSortie` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateBonSortie` datetime DEFAULT NULL,
  `numeroContainer` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroPlomb` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroCamion` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomChauffeur` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `origine` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `destination` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `codeUsine` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `poidsTotal` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2843ABC819EB6921` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bon_sortie` */

LOCK TABLES `bon_sortie` WRITE;

insert  into `bon_sortie`(`id`,`client_id`,`numeroBonSortie`,`dateBonSortie`,`numeroContainer`,`numeroPlomb`,`numeroCamion`,`nomChauffeur`,`origine`,`destination`,`codeUsine`,`login`,`status`,`createdDate`,`updatedDate`,`deletedDate`,`poidsTotal`) values (1,NULL,'00001','2015-12-02 11:49:34','','','','','','Usine','usine_dakar','admin',1,NULL,NULL,NULL,'');

UNLOCK TABLES;

/*Table structure for table `client` */

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `client` */

LOCK TABLES `client` WRITE;

insert  into `client`(`id`,`nom`,`adresse`,`telephone`,`reference`) values (1,'SeaBlue','France','','');

UNLOCK TABLES;

/*Table structure for table `conteneur` */

CREATE TABLE `conteneur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facture_id` int(11) DEFAULT NULL,
  `numConteneur` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `numPlomb` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E9628FD27F2DEE08` (`facture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `conteneur` */

LOCK TABLES `conteneur` WRITE;

UNLOCK TABLES;

/*Table structure for table `demoulage` */

CREATE TABLE `demoulage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `nombreParCarton` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nombreCarton` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_72FD14D7F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `demoulage` */

LOCK TABLES `demoulage` WRITE;

UNLOCK TABLES;

/*Table structure for table `facture` */

CREATE TABLE `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bonsortie_id` int(11) DEFAULT NULL,
  `numero` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateFacture` datetime DEFAULT NULL,
  `heureFacture` time DEFAULT NULL,
  `devise` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `portDechargement` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `montantHt` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `montantTtc` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `modePaiement` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `numCheque` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `avance` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `reliquat` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeUsine` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `regle` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_FE86641099C5AF38` (`bonsortie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `facture` */

LOCK TABLES `facture` WRITE;

UNLOCK TABLES;

/*Table structure for table `famille_produit` */

CREATE TABLE `famille_produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `famille_produit` */

LOCK TABLES `famille_produit` WRITE;

insert  into `famille_produit`(`id`,`libelle`,`createdDate`,`updatedDate`,`deleteDate`) values (1,'Sole','2015-11-25 17:18:30','2015-11-25 17:18:30',NULL),(2,'Sompate','2015-11-25 17:26:30','2015-11-25 17:26:30',NULL);

UNLOCK TABLES;

/*Table structure for table `fournisseur` */

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `fournisseur` */

LOCK TABLES `fournisseur` WRITE;

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
  `montant` int(11) NOT NULL,
  `poids` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_25056E66F347EFB` (`produit_id`),
  KEY `IDX_25056E66FE95D117` (`achat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ligne_achat` */

LOCK TABLES `ligne_achat` WRITE;

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
  KEY `IDX_4C645FA1B342D9B` (`bonSortie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `ligne_bonsortie` */

LOCK TABLES `ligne_bonsortie` WRITE;

insert  into `ligne_bonsortie`(`id`,`produit_id`,`quantite`,`createdDate`,`updatedDate`,`deletedDate`,`bonSortie_id`) values (1,NULL,0,'2015-12-02 11:49:35','2015-12-02 11:49:35',NULL,1);

UNLOCK TABLES;

/*Table structure for table `mareyeur` */

CREATE TABLE `mareyeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `montantFinancement` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `mareyeur` */

LOCK TABLES `mareyeur` WRITE;

insert  into `mareyeur`(`id`,`nom`,`adresse`,`telephone`,`montantFinancement`,`reference`) values (1,'Fatou','St Louis','','','MR1'),(2,'Diatou','HANN','','','MR2'),(3,'Ndeye Deguene','Rufisque','','100000','MR3');

UNLOCK TABLES;

/*Table structure for table `produit` */

CREATE TABLE `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prixUnitaire` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `familleProduit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC272DDD2720` (`familleProduit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `produit` */

LOCK TABLES `produit` WRITE;

insert  into `produit`(`id`,`libelle`,`prixUnitaire`,`createdDate`,`updatedDate`,`deleteDate`,`familleProduit_id`) values (1,'Sole','2000','2015-11-26 00:00:00',NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `profil` */

CREATE TABLE `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `profil` */

LOCK TABLES `profil` WRITE;

insert  into `profil`(`id`,`libelle`,`description`,`createdDate`,`updatedDate`,`deleteDate`) values (1,'admin','Administrateur','2015-09-20 00:00:00',NULL,NULL),(2,'magasinier','Magasinier',NULL,NULL,NULL),(3,'comptable','Comptable',NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `reglement_achat` */

CREATE TABLE `reglement_achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `achat_id` int(11) DEFAULT NULL,
  `datePaiement` datetime DEFAULT NULL,
  `avance` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FCD48A98FE95D117` (`achat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `reglement_achat` */

LOCK TABLES `reglement_achat` WRITE;

UNLOCK TABLES;

/*Table structure for table `stock` */

CREATE TABLE `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `seuil` int(11) DEFAULT NULL,
  `codeUsine` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B365660F347EFB` (`produit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `stock` */

LOCK TABLES `stock` WRITE;

UNLOCK TABLES;

/*Table structure for table `stock_final` */

CREATE TABLE `stock_final` (
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
  KEY `IDX_70C54037F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stock_final` */

LOCK TABLES `stock_final` WRITE;

UNLOCK TABLES;

/*Table structure for table `stock_initial` */

CREATE TABLE `stock_initial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `codeUsine` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A7810D0CF347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stock_initial` */

LOCK TABLES `stock_initial` WRITE;

UNLOCK TABLES;

/*Table structure for table `usine` */

CREATE TABLE `usine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nomUsine` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `emplacement` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `typeUsine` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `codePostal` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `couleur` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3AB48177153098` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `usine` */

LOCK TABLES `usine` WRITE;

insert  into `usine`(`id`,`code`,`nomUsine`,`emplacement`,`typeUsine`,`telephone`,`fax`,`codePostal`,`createdDate`,`updatedDate`,`deleteDate`,`couleur`) values (1,'usine_dakar','Dakar','Dakar','usine',NULL,NULL,NULL,'2015-09-20 00:00:00',NULL,NULL,'#68BC31'),(2,'usine_rufisque','Rufisque','Rufisque','usine',NULL,NULL,NULL,NULL,NULL,NULL,'#2091CF');

UNLOCK TABLES;

/*Table structure for table `utilisateur` */

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usine_id` int(11) DEFAULT NULL,
  `profil_id` int(11) DEFAULT NULL,
  `login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nomUtilisateur` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `etatCompte` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1D1C63B3C0130686` (`usine_id`),
  KEY `IDX_1D1C63B3275ED078` (`profil_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `utilisateur` */

LOCK TABLES `utilisateur` WRITE;

insert  into `utilisateur`(`id`,`usine_id`,`profil_id`,`login`,`password`,`nomUtilisateur`,`status`,`etatCompte`,`createdDate`,`updatedDate`,`deleteDate`) values (1,1,1,'admin','passer','admin','1','1',NULL,NULL,NULL),(2,2,2,'matar','matar','Matar','1','1',NULL,NULL,NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
