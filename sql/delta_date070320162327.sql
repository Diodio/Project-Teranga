ALTER TABLE ligne_colis_bonsortie ADD CONSTRAINT FK_767FF4661B342D9B FOREIGN KEY (bonSortie_id) REFERENCES bon_sortie (id) ON DELETE CASCADE;
CREATE INDEX IDX_767FF4661B342D9B ON ligne_colis_bonsortie (bonSortie_id);

Updating database schema...
Database schema updated successfully! "2" queries were executed
