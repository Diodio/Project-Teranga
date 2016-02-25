ALTER TABLE stock_reel DROP FOREIGN KEY FK_EBFA5495F347EFB;
ALTER TABLE stock_reel ADD CONSTRAINT FK_EBFA5495F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE;

Updating database schema...
Database schema updated successfully! "2" queries were executed
