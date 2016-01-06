INSERT INTO `client` (`id`, `nom`, `adresse`, `telephone`, `reference`) VALUES
(1, 'Daba', 'Dakar', '', 'CLI1');

INSERT INTO `mareyeur` (`id`, `nom`, `adresse`, `telephone`, `montantFinancement`, `reference`) VALUES
(1, 'Fatou Diouf', 'Dakar', '', '', 'MR1'),
(2, 'MBODJ TANDIAN', 'Dakar', '', '', 'MR2');

INSERT INTO `profil` (`id`, `libelle`, `description`, `createdDate`, `updatedDate`, `deleteDate`) VALUES
(1, 'admin', 'Administrateur', '2015-09-20 00:00:00', NULL, NULL),
(2, 'magasinier', 'Magasinier', NULL, NULL, NULL),
(3, 'comptable', 'Comptable', NULL, NULL, NULL);

INSERT INTO `usine` (`id`, `code`, `nomUsine`, `emplacement`, `typeUsine`, `telephone`, `fax`, `codePostal`, `createdDate`, `updatedDate`, `deleteDate`, `couleur`) VALUES
(1, 'usine_dakar', 'Dakar', 'Dakar', 'usine', NULL, NULL, NULL, '2015-09-20 00:00:00', NULL, NULL, '#68BC31'),
(2, 'usine_rufisque', 'Rufisque', 'Rufisque', 'usine', NULL, NULL, NULL, NULL, NULL, NULL, '#2091CF'),
(3, 'usine_stlouis', 'St Louis', 'St Louis', 'usine', NULL, NULL, NULL, '2015-12-12 00:00:00', NULL, NULL, '#2091CF');


INSERT INTO `utilisateur` (`id`, `usine_id`, `profil_id`, `login`, `password`, `nomUtilisateur`, `status`, `etatCompte`, `createdDate`, `updatedDate`, `deleteDate`) VALUES
(1, 1, 1, 'admin', 'passer', 'admin', '1', '1', NULL, NULL, NULL),
(2, 2, 2, 'matar', 'matar', 'Matar', '1', '1', NULL, NULL, NULL),
(3, 3, 1, 'stlouis', 'stlouis', 'Abdou', '1', '1', NULL, NULL, NULL);
