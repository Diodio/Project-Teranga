CREATE UNIQUE INDEX UNIQ_26A98456F55AE19E ON achat (numero);
CREATE UNIQUE INDEX UNIQ_2843ABC8C1A94FE7 ON bon_sortie (numeroBonSortie);
CREATE UNIQUE INDEX UNIQ_FE866410F55AE19E ON facture (numero);
ALTER TABLE stock_provisoire CHANGE stock stock NUMERIC(10, 2) DEFAULT NULL;
ALTER TABLE stock_reel CHANGE stock stock NUMERIC(10, 2) DEFAULT NULL;

Updating database schema...
Database schema updated successfully! "5" queries were executed
