CREATE TABLE stock_achete (id INT AUTO_INCREMENT NOT NULL, numeroAchat VARCHAR(60) NOT NULL, produitId INT DEFAULT NULL, quantiteAchetee NUMERIC(10, 2) DEFAULT NULL, createdDate DATETIME DEFAULT NULL, updatedDate DATETIME DEFAULT NULL, deleteDate DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE stock_facture (id INT AUTO_INCREMENT NOT NULL, numeroFacture VARCHAR(60) NOT NULL, produitId INT DEFAULT NULL, quantiteFacturee NUMERIC(10, 2) DEFAULT NULL, createdDate DATETIME DEFAULT NULL, updatedDate DATETIME DEFAULT NULL, deleteDate DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE demoulage ADD numero VARCHAR(60) DEFAULT NULL, ADD quantiteAdemouler NUMERIC(10, 2) DEFAULT NULL, ADD quantiteDemoulee NUMERIC(10, 2) DEFAULT NULL;

Updating database schema...
Database schema updated successfully! "3" queries were executed
