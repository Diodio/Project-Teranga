ALTER TABLE reglement_achat DROP FOREIGN KEY FK_FCD48A98FE95D117;
ALTER TABLE reglement_achat ADD CONSTRAINT FK_FCD48A98FE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id) ON DELETE CASCADE;

Updating database schema...
Database schema updated successfully! "2" queries were executed
