ALTER TABLE carton DROP FOREIGN KEY FK_41511106325BF03;
ALTER TABLE carton ADD CONSTRAINT FK_41511106325BF03 FOREIGN KEY (demoulage_id) REFERENCES demoulage (id) ON DELETE CASCADE;

Updating database schema...
Database schema updated successfully! "2" queries were executed
