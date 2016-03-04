CREATE TABLE ligne_colis_bonsortie (id INT AUTO_INCREMENT NOT NULL, nombreCarton INT NOT NULL, quantiteParCarton NUMERIC(10, 2) DEFAULT NULL, produit_id INT NOT NULL, bonSortie_id INT NOT NULL, createdDate DATETIME DEFAULT NULL, updatedDate DATETIME DEFAULT NULL, deletedDate DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

Updating database schema...
Database schema updated successfully! "1" queries were executed
