CREATE TABLE devise (id INT AUTO_INCREMENT NOT NULL, devise VARCHAR(10) NOT NULL, montant NUMERIC(10, 2) NOT NULL, createdDate DATETIME DEFAULT NULL, updatedDate DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_43EDA4DF43EDA4DF (devise), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE colisage CHANGE quantiteParCarton quantiteParCarton NUMERIC(10, 2) DEFAULT NULL;

Updating database schema...
Database schema updated successfully! "2" queries were executed
