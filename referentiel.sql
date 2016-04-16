INSERT INTO `client` (`id`, `nom`, `adresse`, `telephone`, `reference`) VALUES
(1, 'Daba', 'Dakar', '', 'CLI1');

INSERT INTO `mareyeur` (`id`, `nom`, `adresse`, `telephone`, `montantFinancement`, `reference`) VALUES
(1, 'Fatou Diouf', 'Dakar', '', '', 'MR1'),
(2, 'MBODJ TANDIAN', 'Dakar', '', '', 'MR2');

INSERT INTO `profil` (`id`, `libelle`, `description`, `createdDate`, `updatedDate`, `deleteDate`) VALUES
(1, 'admin', 'Administrateur', '2015-09-20 00:00:00', NULL, NULL),
(2, 'magasinier', 'Magasinier', NULL, NULL, NULL),
(3, 'comptable', 'Comptable', NULL, NULL, NULL),
(4, 'gerant', 'Gérant de bon d''achat', '2016-01-29 00:00:00', NULL, NULL),
(5, 'directeur', 'Directeur', NULL, NULL, NULL);

INSERT INTO `usine` (`id`, `code`, `nomUsine`, `emplacement`, `typeUsine`, `telephone`, `fax`, `codePostal`, `createdDate`, `updatedDate`, `deleteDate`, `couleur`) VALUES
(1, 'usine_dakar', 'Dakar', 'Dakar', 'usine', NULL, NULL, NULL, '2015-09-20 00:00:00', NULL, NULL, '#25FDE9'),
(2, 'usine_rufisque', 'Rufisque', 'Rufisque', 'usine', NULL, NULL, NULL, NULL, NULL, NULL, '#f929db'),
(3, 'usine_stlouis', 'St Louis', 'St Louis', 'usine', NULL, NULL, NULL, '2015-12-12 00:00:00', NULL, NULL, '#FFFF00');



INSERT INTO `utilisateur` (`id`, `usine_id`, `profil_id`, `login`, `password`, `nomUtilisateur`, `status`, `etatCompte`, `createdDate`, `updatedDate`, `deleteDate`, `connected`, `connectedDate`, `disconnectedDate`) VALUES
(1, 1, 1, 'admin', 'passer', 'Macoura NIANG', '1', '1', NULL, NULL, NULL, 0, '2016-03-08 09:19:25', '2016-03-08 09:50:27'),
(2, 2, 2, 'rufisque', 'rufisque', 'Macoura NIANG', '1', '1', NULL, NULL, NULL, 0, '2016-03-02 16:05:27', '2016-03-02 16:14:34'),
(3, 3, 5, 'stlouis3', 'mac3', 'Macoura NIANG', '1', '1', NULL, '2016-02-22 14:04:36', NULL, 0, '2016-02-23 09:32:59', '2016-02-23 09:49:18'),
(4, 1, 2, 'fatou', 'fatou', 'Fatou NDIAYE', '1', '1', '2016-01-28 00:00:00', NULL, NULL, 0, '2016-03-08 18:20:59', '2016-03-08 18:51:43'),
(5, 2, 2, 'fatou', 'fatou', 'Fatou NDIAYE', '1', '1', '2016-01-28 00:00:00', NULL, NULL, 0, '2016-03-08 17:56:13', '2016-03-08 18:08:15'),
(6, 3, 2, 'fatou', 'fatou', 'Fatou NDIAYE', '1', '1', '2016-01-28 00:00:00', NULL, NULL, 0, '2016-03-08 17:34:31', '2016-03-08 17:40:52'),
(7, 1, 4, 'marro', 'marro', 'Maro', '1', '1', NULL, '2016-02-22 12:16:43', NULL, 0, '2016-03-08 14:07:22', '2016-03-08 15:59:44'),
(9, 1, 1, 'directeur', 'passer', 'Teste', '1', '1', NULL, '2016-02-15 23:25:25', NULL, NULL, NULL, NULL),
(10, 2, 5, 'macoura', 'passer', 'Macoura NIANG', '1', '1', NULL, NULL, NULL, 0, '2016-03-07 03:14:17', '2016-03-07 03:34:41'),
(11, 1, 5, 'niang1', 'mac2', 'Macoura NIANG', '1', '1', NULL, '2016-02-22 14:03:09', NULL, 0, '2016-03-08 20:11:48', '2016-03-08 20:17:41'),
(16, 2, 4, 'layerufisque', 'LAYE104', 'LAYE NDIONE', '1', '1', NULL, '2016-02-26 08:58:05', NULL, 0, '2016-03-07 17:03:08', '2016-03-07 17:18:29'),
(17, 3, 5, 'DIRECTEUR', 'DIRECTEUR03', 'DIRECTEUR ', '1', '1', '2016-02-26 08:57:30', '2016-02-26 08:57:30', NULL, 0, '2016-03-08 17:34:00', '2016-03-08 17:34:26'),
(18, 1, 5, 'diodio', 'diodio', 'Diodio MBODJ', '1', '1', '2016-02-29 11:15:03', '2016-02-29 11:15:03', NULL, 0, '2016-03-08 12:47:12', '2016-03-08 12:47:34'),
(19, 2, 5, 'jojo', 'jojo', 'Diodio MBODJ', '1', '1', '2016-03-01 10:13:36', '2016-03-01 10:13:36', NULL, 1, '2016-03-08 20:18:04', '2016-03-08 20:11:36'),
(20, 3, 4, 'KADY03', 'KADY03', 'KHADISSATOU', '1', '0', NULL, '2016-03-03 11:34:52', NULL, 0, '2016-03-08 10:26:10', '2016-03-08 10:55:33');

insert into `devise` (`id`, `devise`, `montant`, `createdDate`, `updatedDate`) values('1','€','320.00',NULL,'2016-04-16 09:25:58');
insert into `devise` (`id`, `devise`, `montant`, `createdDate`, `updatedDate`) values('2','‎$','5544.00',NULL,'2016-04-15 23:51:19');

--Unicit� des stocks
ALTER TABLE `colisage` ADD UNIQUE( `produitId`, `quantiteParCarton`, `codeUsine`);
ALTER TABLE `stock_reel` ADD UNIQUE( `produit_id`, `stock`, `codeUsine`);
ALTER TABLE `stock_provisoire` ADD UNIQUE( `produit_id`, `stock`, `codeUsine`);
ALTER TABLE `achat` ADD UNIQUE( `numero`, `codeUsine`);

ALTER TABLE `stock_sortie` ADD UNIQUE( `produitId`, `sortieId`);
ALTER TABLE `stock_facture` ADD UNIQUE( `produitId`, `factureId`);
ALTER TABLE `stock_entree` ADD UNIQUE( `produitId`, `sortieId`);
ALTER TABLE `stock_achete` ADD UNIQUE( `produitId`, `achatId`);

