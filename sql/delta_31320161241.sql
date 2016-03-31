CREATE UNIQUE INDEX UNIQ_2843ABC8C1A94FE7 ON bon_sortie (numeroBonSortie);
CREATE UNIQUE INDEX numero_idx ON bon_sortie (numeroBonSortie, codeUsine);
ALTER TABLE colisage CHANGE quantiteParCarton quantiteParCarton NUMERIC(10, 2) DEFAULT NULL;

Updating database schema...
Database schema updated successfully! "3" queries were executed
