ALTER TABLE colisage CHANGE quantiteParCarton quantiteParCarton NUMERIC(10, 2) DEFAULT NULL;
ALTER TABLE demoulage ADD produitCalibre INT DEFAULT NULL;
ALTER TABLE produit ADD produit_id INT DEFAULT 0, DROP state, CHANGE calibre calibre INT DEFAULT 0;

Updating database schema...
Database schema updated successfully! "3" queries were executed
