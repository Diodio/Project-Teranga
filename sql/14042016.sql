DROP INDEX produitId ON colisage;
ALTER TABLE colisage CHANGE quantiteParCarton quantiteParCarton NUMERIC(10, 2) DEFAULT NULL;
ALTER TABLE facture ADD inconterm VARCHAR(60) DEFAULT NULL;
ALTER TABLE ligne_colis_bonsortie ADD CONSTRAINT FK_767FF4661B342D9B FOREIGN KEY (bonSortie_id) REFERENCES bon_sortie (id) ON DELETE CASCADE;
DROP INDEX produitId ON stock_entree;
DROP INDEX produitId ON stock_facture;
DROP INDEX produitId ON stock_sortie;

Updating database schema...
Database schema updated successfully! "7" queries were executed
